<?php
    // & 1 -> create offer, fill in offer information and retrieve offer id
    // & 2 -> add images to the local folder under specified name
    // & 3 -> add each book to products and their information, set their offer-id to corresponding offer created at the beginning, put both file names and their extension into img column split by / separated with 'Greek Question Mark' - [UNICODE CHAR (U+037E)] that looks familiar to ";"
    
require "../conf/config.php";

$abspath = $_SERVER["BASE"];

if (!isset($_SESSION["uid"]) && isset($_POST["standard"])) {
    header("HTTP/1.0 403 Forbidden");
    header("Location: $abspath"."src/access.php?error=session-expired");
    exit(403);
}

if (!isset($_SESSION["uid"])) {
    header("HTTP/1.0 403 Forbidden");
    header("Location: $abspath"."src/access.php?error=access-denied-login-required");
    exit(403);
}

const PRICE_CHECK_REGEX = "/^\d*\.?\d*$/"; // or ^\d*(\.\d{0,2})?$
const CUSTOM_ARRAY_SEPARATOR = "&#x37E;";
const MAX_IMG_PER_ENTRY = 2;
/**
 * defines max file size in megabytes
 * @var int
*/ 
const CUSTOM_MAX_FILE_SIZE = 20;

/**
 * @var string[] $status
 * 
 * "active" - Aktywna
 * 
 * "expired" - Wygasła
 * 
 * "cancelled" - Anulowana
 * 
 * "ended" - Zakończona
 * 
 * "removed" - Usunięta przez administratora
 * 
 * "archived" - [experimental] opcjonalne na wypadek zostawiania ofert w bazie danych po miesiącu od zakończenia/wygasniecia oferty
 * 
 * "hidden" - [experimental] Ukryta, aby sprzedawca nie widział jej na swoim profilu - bardzo podobne do expired/cancelled, tylko roznica taka ze go nie widac na profilu
 */
$status = ["active", "expired", "cancelled", "ended", "removed", "archived", "hidden"];
$offer_errors = [];

$file_folder = $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"]."_users/";

$discord = htmlspecialchars(mysqli_real_escape_string($conn, str_replace(" ", "", $_POST["discord"])), ENT_QUOTES, 'UTF-8');
$email = str_replace(" ", "", $_POST["email"]);
$phone = str_replace(" ", "", $_POST["phone"]);


if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: $path_to_form?error=incorrect-email");
    exit(422);
}

$days = $_POST["exp_days"];
if (empty($days) || $days < 5) {
    $days = 14;
} else if ($days > 91) {
    $days = 91;
}

$hours = $_POST["exp_hours"];
if (empty($hours) || $hours < 0) {
    $hours = 0;
} else if ($hours > 23) {
    $hours = 23;
}

$user_uid = $_SESSION["uid"];

# // * Inserting offer to database

$sql = "INSERT INTO `offers` VALUES('', '$user_uid', NOW(), DATE_ADD(DATE_ADD(NOW(), INTERVAL $days DAY), INTERVAL $hours HOUR), '1', '$phone', '$email', '$discord')";
$query = mysqli_query($conn, $sql);
$offer_id = mysqli_insert_id($conn);

$book_count = count($_POST["book"]);

$file = $_FILES['image'];

if (count($file["name"]) > $book_count * MAX_IMG_PER_ENTRY) {
    header("HTTP/1.0 403 Forbidden");
    header("Location: ". $_SERVER["BASE"] ."src/createoffer.php?error=too-many-files");
    exit(403);
}

$isCustom = false; // change when we add handling for custom creation, in front end

$sql = "INSERT INTO `products` VALUES('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->stmt_init();
$stmt->prepare($sql);

for ($i = 0; $i < $book_count; $i++) {
    if (!$isCustom) {
        $sql = "SELECT * FROM `booklist` WHERE id = ".mysqli_real_escape_string($conn, $_POST["book"][$i]);
        // I know this is slow, BUT - first of all, its easier to find specific entry (row) this way, and if we were to take out everything out of database just once to look for the right entry, then we'd have to loop through all unwanted results
        $query = mysqli_query($conn, $sql);
        if ($result = mysqli_fetch_assoc($query)) {
            $book_name = $result["name"];
            $book_subj = $result["subject"];
            $book_class = $result["class"];
            $book_authors = $result["authors"];
            $book_pub = $result["publisher"];  
        }
    } else {
        $book_name = str_replace(" ", "", $_POST["name"][$i]);
        $book_pub = str_replace(" ", "", $_POST["publisher"][$i]);
        $book_authors = str_replace(" ", "", $_POST["authors"][$i]);
        $book_subj = "";
        $book_class = "";
    }

    $book_price = doubleval(str_replace(" ", "", $_POST["price"][$i]));
    $book_qual = str_replace(" ", "", $_POST["quality"][$i]);
    $book_note = mysqli_real_escape_string($conn, $_POST["note"][$i]);

    // TODO FILES: add mime type check.
    // $fileType = $file['type'];
    $allowed_mimes = ["image/jpeg", "image/png", "image/webp", "image/gif"];
    $allowed_files = array('png', 'jpg', 'jpeg', 'webp', 'gif', 'jif', 'jfif', 'jpe', 'pjp', 'pjpeg'); // the 'jif', 'jpe' and next extensions in array are technicaly for 'jpg' file aswell
    
    $file_names = [];
    for ($j = 0; $j < MAX_IMG_PER_ENTRY; $j++) {
        $pic_index = $i * MAX_IMG_PER_ENTRY + $j;
        echo $pic_index;
        // you can edit it however you want, shit is crazy, so many ways to setup.
        if ($file["name"][$pic_index] == null || $file["error"][$pic_index] !== 0) {
            echo "skipped $pic_index";
            continue;
        }
        if ($file["size"][$pic_index] < (1024 * 1024 * CUSTOM_MAX_FILE_SIZE)) {
            $ext = strtolower(pathinfo($file["name"][$pic_index], PATHINFO_EXTENSION)); // $ext = strtolower(end(explode('.', $fileName)));
            if (in_array($ext, $allowed_files)) {
                $fileName = base_convert(bin2hex(random_bytes(2+9*(cos(M_2_PI)+sin(M_PI_4)*M_E/time()))),16,36) . '.' . $ext;
                array_push($file_names, $fileName);
                move_uploaded_file($file["tmp_name"][$pic_index], $file_folder . $fileName);
            } else {
                array_push($offer_errors, "wrong-file-type&input-nr=".$pic_index);
            }
        } else {
            array_push($offer_errors, "file-too-big&input-nr=".$pic_index);
        }
    }
    $book_images = implode(CUSTOM_ARRAY_SEPARATOR, $file_names);
    echo '<br>';
    print_r(explode(CUSTOM_ARRAY_SEPARATOR, $book_images));
    print_r($offer_errors);

    // $_FILE = array(); # We might want to use this if we were to make this ... advanced, for now it has to work
    // foreach($_FILES as $name => $file) {
    //     foreach($file as $property => $keys) {
    //         foreach($keys as $key => $value) {
    //             $_FILE[$name][$key][$property] = $value;
    //         }
    //     }
    // }
    file_put_contents("files.test.json", json_encode($_FILES, JSON_PRETTY_PRINT));

    // ? Now here's question.. @chopa113 do we store status as a number that represents a status, like a flag, or as a string (word), my guess is number cuz then we can do bitmask operations.. but then, why would we want that?
    // * Currently status numbers are as follows: 0 - zakonczona/ended , 1 - aktywna/active , 2 - anulowana/cancelled, 3- wygasla/expired , 4 - usunieta/removed (by admin) i 5, 6 powyzej w liscie ktore sa experymentalne
    $custom = intval($isCustom);
    
    $stmt->bind_param('issssidsssi', $offer_id, $book_name, $book_authors, $book_pub, $book_subj, $book_class, $book_price, $book_qual, $book_note, $book_images, $custom);
    $stmt->execute();
}

// $Book = array(
//     "name"=>$title,
//     "author"=>$author,
//     "publisher"=>$publisher,
//     "subject"=>$subject,
//     "class"=>$class,
//     "price"=>$price,
//     "quality"=>$quality,
//     "note"=>$desc,
//     "img"=>$book_images,
//     "custom"=>$isCustom
// ); # DIS FOR LATER, WHEN WE ADVANCED
//? json_encode(^^^^^^, JSON_PRETTY_PRINT);
<?php
    // & 1 -> create offer, fill in offer information and retrieve offer id
    // & 2 -> add images to the local folder under specified name
    // & 3 -> add each book to products and their information, set their offer-id to corresponding offer created at the beginning, put both file names and their extension into img column split by / separated with 'Greek Question Mark' - [UNICODE CHAR (U+037E)] that looks familiar to ";"
    
require "../conf/config.php";

$abspath = $_SERVER["BASE"];

if (!isset($_SESSION["uid"])) {
    header("Location: $abspath/src/access.php?error=access-denied-login-required");
    exit(403);
}


const PRICE_CHECK_REGEX = "/^\d*\.?\d*$/"; // or ^\d*(\.\d{0,2})?$

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
 * "hidden" - [experimental] Ukryta, aby sprzedawca nie widział jej na swoim profilu
 */
$status = ["active", "expired", "cancelled", "ended", "removed", "archived", "hidden"];
    
$discord = mysqli_real_escape_string($conn, str_replace(" ", "", $_POST["discord"]));
$email = str_replace(" ", "", $_POST["email"]);
$phone = str_replace(" ", "", $_POST["phone"]);

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

$sql = "INSERT INTO `offers` VALUES('', '$user_uid', NOW(), DATE_ADD(DATE_ADD(NOW(), INTERVAL $days DAY), INTERVAL $hours HOUR), '1', '$phone', '$email', '$discord')";
$query = mysqli_query($conn, $sql);
$offer_id = mysqli_insert_id($conn);

$book_count = count($_POST["book"]);

$isCustom = false; // change when we add handling for custom creation

$sql = "INSERT INTO `products` VALUES('', ?, ?, ?, ?, ?, ?, ?, ?, ?, '', ?)";
    
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);

for ($i = 0; $i < $book_count; $i++) {
    if (!$isCustom) {
        $sql = "SELECT * FROM `booklist` WHERE id = ".$_POST["book"][$i];
        // I know this is slow, BUT - first of all, its easier to find specific entry (row) this way, and if we were to take out everything out of database just once to look for the right entry, then we'd have to loop through all unwanted results
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
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

    // $sql = "INSERT INTO `products` VALUES('', $offer_id, $book_name, $book_authors, $book_pub, $book_subj, $book_class, $book_price'.00', $book_qual, $book_note, '', intval($isCustom))";

    $custom = intval($isCustom);
    
    mysqli_stmt_bind_param($stmt, 'issssidssi', $offer_id, $book_name, $book_authors, $book_pub, $book_subj, $book_class, $book_price, $book_qual,$book_note, $custom);
    // mysqli_query($conn, $sql);
    mysqli_stmt_execute($stmt);

    // TODO below here implement file handling
}
// $search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');

// $file = $_FILES['image'];
// $fileName = $file['name'];
// $fileTempName = $file['tmp_name'];
// $fileSize = $file['size'];
// $fileError = $file['error'];
// $fileType = $file['type'];

// $fileExt = strtolower(end(explode('.', $fileName)));
// // found new, better way to extract file extensions but aint working on file handling now.
// $allowed = array('png', 'jpg', 'jpeg');

// if (in_array($fileExt, $allowed)) {
//     if ($fileError === 0) {
//         if ($fileSize < 1024 * 1024 * 10) {
//             $fileNewName = $bookid . "." . $fileExt;
            
//             array_push($tempSolution, $fileNewName);

//             $fileFolder = $_SERVER["DOCUMENT_ROOT"] . "/_user/";
//             $fileDestination = $fileFolder . $fileNewName;
//             move_uploaded_file($fileTempName, $fileDestination);
//         }
//     }
// }

// $ext = "png";
// foreach (glob("../_user/images/*.$ext") as $file) {

// } 

// $Book = array(
//     "name"=>$title,
//     "author"=>$author,
//     "publisher"=>$publisher,
//     "subject"=>$subject,
//     "class"=>$class,
//     "price"=>$price,
//     "quality"=>$quality,
//     "note"=>$desc,
//     "img"=>[$tempSolution[0],$tempSolution[1]],
//     "custom"=>$isCustom
// ); # DIS FOR LATER, WHEN WE ADVANCED CURRENT HACK
//? json_encode(^^^^^^, JSON_PRETTY_PRINT);
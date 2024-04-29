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

$sql = "INSERT INTO `offers` VALUES('', '$user_uid', NOW(), DATE_ADD(DATE_ADD(NOW(), INTERVAL $days DAY), INTERVAL $hours HOUR), '1', '$phone', '$email', '$discord')";
$query = mysqli_query($conn, $sql);
$offer_id = mysqli_insert_id($conn);

$book_count = count($_POST["book"]);

$sql = "INSERT INTO `products` VALUES('', ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->stmt_init();
$stmt->prepare($sql);

for ($i = 0; $i < $book_count; $i++) {
    $sql = "SELECT * FROM `booklist` WHERE id = ".mysqli_real_escape_string($conn, $_POST["book"][$i]);
   
    //$query = "SELECT * FROM `booklist` WHERE"; for($i = 0; $i < $book_count; $i++) { if ($i == 0) {$query .= ' id = ' . $_POST["book"][$i]; continue; } $query .= ' AND id = ' . $_POST["book"][$i]; }
    $query = mysqli_query($conn, $sql);
    if ($result = mysqli_fetch_assoc($query)) {
        $book_name = $result["name"];
        $book_subj = $result["subject"];
        $book_class = $result["class"];
        $book_authors = $result["authors"];
        $book_pub = $result["publisher"];  
    }

    $book_price = doubleval(str_replace(" ", "", $_POST["price"][$i]));
    $book_qual = str_replace(" ", "", $_POST["quality"][$i]);
    $book_note = mysqli_real_escape_string($conn, $_POST["note"][$i]);
    
    $stmt->bind_param('issssidsssi', $offer_id, $book_name, $book_authors, $book_pub, $book_subj, $book_class, $book_price, $book_qual, $book_note);
    $stmt->execute();
}
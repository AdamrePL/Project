<?php

require "config.php";
$stmt = mysqli_stmt_init($conn);

$title = $_POST["book"];
$quality = $_POST["quality"];
$price = $_POST["price"];
$desc = $_POST["note"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$dc = $_POST["discord"];
$subject = $_POST["subjects"];
$status = array("active","inactive","terminated");

$file = $_FILES['image'];
$fileName = $file['name'];
$fileTempName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];

$fileExt = strtolower(end(explode('.', $fileName)));
$allowed = array('png', 'jpg', 'jpeg');

if (in_array($fileExt, $allowed)) {
    if ($fileError === 0) {
        if ($fileSize < 1024 * 1024 * 50) {
            $fileNewName = $bookid . "." . $fileExt;
            $fileFolder = "book-covers/";
            $fileDestination = $fileFolder . $fileNewName;
            move_uploaded_file($fileTempName, $fileDestination);
        }
    }
}

$ext = "png";
foreach (glob("../assets/img/product-images/*.$ext") as $file) {

} // odczyt plikow
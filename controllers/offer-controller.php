<?php

require "config.php";
$stmt = mysqli_stmt_init($conn);
$sql = "INSERT INTO `offers` VALUES('', '" . $_SESSION["userid"] . "', '', DATE_ADD(NOW(), INTERVAL 14 DAY) + ' 23:59:59') ";
mysqli_stmt_prepare($stmt, $sql);

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

        $FileExtVar = explode('.', $fileName);
        $fileExt = strtolower(end($FileExtVar));
        $allowed = array('png', 'jpg', 'jpeg');

        file handling
        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1024 * 1024 * 50) {
                    $fileNewName = $bookid . "." . $fileExt;
                    $fileFolder = "book-covers/";
                    $fileDestination = $fileFolder . $fileNewName;
                    move_uploaded_file($fileTempName, $fileDestination);

                    foreach (glob("paragraphs/*.txt") as $file) // odczyt plikow
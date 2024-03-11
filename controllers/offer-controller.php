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


// get info about book from booklist.json -> SOMEHOW fetch book depending on SOMETHING from booklist
// -> turn fetched data into $Book encoded json array with said values -> insert it into offers table 
//**god knows how im going to do like half of those steps lol
file_get_contents("../assets/downloads/booklist.json");
json_decode(); //*!THIS IS A RABBIT HOLE I AM VERY SCARED TO DIVE INTO.

//*!encode to json for db insert
//TODO: figure out how to add the img:["",""] encode
$Book = json_encode(array(
    "name"=>$title,
    "author"=>$author,
    "publisher"=>$publisher,
    "subject"=>$subject,
    "class"=>$class,
    "price"=>$price,
    "quality"=>$quality,
    "note"=>$desc
    ), JSON_PRETTY_PRINT);

var_dump($Book);
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
//*?this only handles one file, no?
//*?id say sth like "oh you can just rename file to offer id and everythings gonna be fine" but i'm too inept at backend so what do i know right



//*!remember to add sesh uid, dont be a bozo
//*leaving multiple blanks due to db uncertainty lole, also commented because i am SCARED to insert anything for now
//*! $sql = "INSERT INTO `offers` VALUES('','$_SESSION,'','','NOW()','DATE_ADD(NOW(),INTERVAL 14 DAY)','$status[1]','$phone','$email','$dc')";
//*! mysqli_query($conn,"$sql");
<?php

require "../conf/config.php";
$stmt = mysqli_stmt_init($conn);

$title = $_POST["book"];
$quality = $_POST["quality"];
$price = $_POST["price"];
$desc = $_POST["note"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$dc = $_POST["discord"];
$subject = $_POST["subjects"];


//get author,publisher, and class info from booklist.json(match book by title probably) -> if appears in multiple classes, set class to "multiple" (temp value)
//-> when fetched, assign 

// $json_data = file_get_contents("../assets/downloads/booklist.json");
// json_decode($json_data,true); //*!THIS IS A RABBIT HOLE I AM VERY SCARED TO DIVE INTO.
$status = array("active","inactive","terminated");


$file = $_FILES['image'];
$fileName = $file['name'];
$fileTempName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];

//! --INSERT THE FOLLOWING SOMEWHERE HERE--
//!
//! $tempSolution = [];
//! array_push($tempSolution,fileName);
//!

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
foreach (glob("../_user/images/*.$ext") as $file) {
} // odczyt 

//*!encode to json for db insert
$Book = json_encode(array(
    "name"=>$title,
    "author"=>$author,
    "publisher"=>$publisher,
    "subject"=>$subject,
    "class"=>$class,
    "price"=>$price,
    "quality"=>$quality,
    "note"=>$desc,
    "img"=>[$tempSolution[0],$tempSolution[1]]
    ), JSON_PRETTY_PRINT);

var_dump($Book);


//*!remember to add sesh uid, dont be a bozo
//*leaving multiple blanks due to db uncertainty lole, also commented because i am SCARED to insert anything for now
//*! $sql = "INSERT INTO `offers` VALUES('','$_SESSION,'','','NOW()','DATE_ADD(NOW(),INTERVAL 14 DAY)','$status[0]','$phone','$email','$dc')";
//*! mysqli_query($conn,"$sql");
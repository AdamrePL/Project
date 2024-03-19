<?php
    // & 1 -> add product to products table
    // & 2 -> add images to the local folder
    // & 3 -> add image names to product in table
    // & 4 -> create offer with list of product ids

require "../conf/config.php";
$stmt = mysqli_stmt_init($conn);

$desc = $_POST["note"];
$quality = $_POST["quality"];
$price = $_POST["price"];
// $phone = ;
// $email = ;
// $dc = ;

$isCustom = false;

$status = array("active","inactive","terminated");

$file = $_FILES['image'];
$fileName = $file['name'];
$fileTempName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];

$json_img_data = [];

$fileExt = strtolower(end(explode('.', $fileName)));
$allowed = array('png', 'jpg', 'jpeg');

if (in_array($fileExt, $allowed)) {
    if ($fileError === 0) {
        if ($fileSize < 1024 * 1024 * 50) {
            $fileNewName = $bookid . "." . $fileExt;
            
            array_push($tempSolution,$fileNewName);

            $fileFolder = "book-covers/";
            $fileDestination = $fileFolder . $fileNewName;
            move_uploaded_file($fileTempName, $fileDestination);
        }
    }
}

$ext = "png";
foreach (glob("../_user/images/*.$ext") as $file) {

} // odczyt 

//!before encode, check for type clarity (if int is int etc.)
//& encode to json for `offers` db insert
$Book = array(
    "name"=>$title,
    "author"=>$author,
    "publisher"=>$publisher,
    "subject"=>$subject,
    "class"=>$class,
    "price"=>$price,
    "quality"=>$quality,
    "note"=>$desc,
    "img"=>[$tempSolution[0],$tempSolution[1]],
    "custom"=>$isCustom
);
//? json_encode(^^^^^^, JSON_PRETTY_PRINT);

var_dump($Book);

//*!remember to add user uid, dont be a bozo

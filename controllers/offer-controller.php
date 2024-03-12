<?php

require "../conf/config.php";
$stmt = mysqli_stmt_init($conn);

// $desc = $_POST["note"];
// $phone = $_POST["phone"];
// $email = $_POST["email"];
// $dc = $_POST["discord"];
$isCustom = false;

//*this is `products` table insertion code my bad ^w^
// $json_data = file_get_contents("../assets/downloads/booklist.json");
// $json_data = json_decode($json_data);
// $clarity = 0;
// foreach ($json_data as $klasa => $value) { //Classes
//     echo "Yippe!<br>";
//     foreach($value as $ksiazka => $dane){//OBJECT ITSELF!
//         $dane = json_decode(json_encode($dane), true);
//         echo"<br><br>"; // var_dump($dane);

//*         // if($dane["nazwa"]==$_POST["book"]){
//*        //     $title = $dane["nazwa"];
//*        //     $author = $dane["autorzy"];
//*        //     $publisher = $dane["wydawnictwo"];
//*        //     $subject = $dane["przedmiot"];         
//*        //     break;
//*        // }
    
//     }
// }


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
//*!encode to json for offers db insert
$Book = json_encode(array(
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
    ), JSON_PRETTY_PRINT);

var_dump($Book); //throws null due to lack of data


//*!remember to add sesh uid, dont be a bozo
//*leaving multiple blanks due to db uncertainty lole, also commented because i am SCARED to insert anything for now
//*! $sql = "INSERT INTO `offers` VALUES('','$_SESSION,'','','NOW()','DATE_ADD(NOW(),INTERVAL 14 DAY)','$status[0]','$phone','$email','$dc')";
//*! mysqli_query($conn,"$sql");
<?php
    // & 1 -> add product to products table
    // & 2 -> add images to the local folder
    // & 3 -> add image names to product in table
    // & 4 -> create offer with list of product ids

require "../conf/config.php";


$desc = $_POST["note"];
$quality = $_POST["quality"];
$price = $_POST["price"];
$phone = $_POST[""];
$email = $_POST[""];
$dc = $_POST[""];
$isCustom = false;

const PRICE_CHECK_REGEX = "/^\d*\.?\d*$/";

//*this is `booklist` table insertion code my bad ^w^
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

} 

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

// $sql = "INSERT INTO `offers` VALUES('','$_SESSION,'','','NOW()','DATE_ADD(NOW(),INTERVAL 14 DAY)','$status[0]','$phone','$email','$dc')";
// mysqli_query($conn,"$sql");

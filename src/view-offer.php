<?php 
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once "$abspath\conf\config.php";
if (!isset($_SESSION["uid"])){
    header("Location: access.php");
}
if (!isset($_GET["id"])){
    header("Location: http://localhost/?error-code=404");
    exit(404);
}
$offer_id = $_GET["id"];
$sql = "SELECT * FROM `offers` WHERE `id` = ?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $offer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = $result->fetch_assoc();

$quality = ["Used", "Damaged", "New"];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/view-offer.css">
    
    <title>Document</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function getContact(){
            console.log(grecaptcha.getResponse())
        }
    </script>
</head>
<body>
    <div class="page-container">
    <div class="content-wrap">
    <?php 
    include "navbar.php";
    ?>
    <div class="offer-view">
        <div class="offer-info">
            <div class="offer-contact">
            <div class="g-recaptcha" data-sitekey="6LcCUMMpAAAAAPEcFChST1sLJot04GlBWLlLBgjc" data-callback="getContact()"></div>
                <h3>Dane kontaktowe</h3>
                <p>Telefon: <?php echo $data["phone"]; ?></p>
                <p>Email: <?php echo $data["email"]; ?></p>
                <p>Discord: <?php echo $data["discord"]; ?></p>
            </div>
            <div class="offer-options">
                <h3>Oferta ważna do:</h3>
                <p><?php echo $data["offer-edate"]; ?></p>
            </div>
        </div>
        
        <div class="offer-books">
            <h3>Książki</h3>
            <ul>
                <?php
                $sql = "SELECT * from `products` WHERE `offer-id` = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "s", $offer_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = $result->fetch_assoc()){
                    echo "<li><details><summary>" . $row["name"] . " - ".$row["price"]."zł </summary>
                    <p>Stan: ".$quality[$row["quality"]]."</p>
                    <p>Opis: ".$row["note"]."</p>
                    <img class=\"book-preview\" src=\"..\assets\img\book.webp\">

                    </details></li>";
                }
                ?>
            </ul>
            
    </div>
    </div>
    
    </div>
    <?php include "$abspath/src/footer.php";  ?>


</body>
</html>
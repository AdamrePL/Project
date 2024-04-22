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
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <title>Document</title>
</head>
<body>
    <?php 
    include "navbar.php";
    ?>
    
</body>
</html>
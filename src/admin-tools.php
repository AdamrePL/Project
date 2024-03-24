<?php 
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once $abspath."conf/config.php"; 

if (!isset($_SESSION["isadmin"]) || $_SESSION["isadmin"] < 1) {
    header("Location: $abspath");
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SITENAME - Admin Panel</title>
</head>
<body>
    

    <?php

    ?>
</body>
</html>
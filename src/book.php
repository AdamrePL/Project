<?php
    require_once "../conf/config.php";

    $sql = "SELECT * FROM `booklist` WHERE `name` = '" . $_GET["book"] . "'";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="booklist-new.css">
    <title><?php echo SITENAME," - ",  $_GET["book"]?></title>
</head>
<body>
    
</body>
</html>
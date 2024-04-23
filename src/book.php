<?php
    require_once "../conf/config.php";

    $sql = "SELECT * FROM `booklist` WHERE `name` = '" . $_GET["book"] . "'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = $result->fetch_assoc();
    $quality = ["Used", "Damaged", "New"];
    $quality = $quality[$data["quality"]];
    mysqli_stmt_close($stmt);
    
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
<?php

require "config.php";
$stmt = mysqli_stmt_init($conn);
$sql = "INSERT INTO `offers` VALUES('', '" . $_SESSION["userid"] . "', '', DATE_ADD(NOW(), INTERVAL 14 DAY) + ' 23:59:59') ";
mysqli_stmt_prepare($stmt, $sql);
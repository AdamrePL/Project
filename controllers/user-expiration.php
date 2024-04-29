<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

require_once $abspath . "conf\config.php";

$sql = "DELETE FROM `users` WHERE DATEDIFF(NOW(), `last-login`) >= ? * 30";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_bind_param($stmt,"s", USER_EXPIRY_MONTHS);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
?>
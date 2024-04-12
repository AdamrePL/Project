<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once $abspath . '\controllers\register-account.php';
require_once $abspath . "\conf\config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new Register($conn);
    $controller->registerController();
    exit();
}

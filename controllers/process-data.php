<?php
require_once "../conf/config.php";
include_once "account-controller.php";


if (isset($_SESSION["uuid"])) {
    header("Location: ");
}

if (!isset($_POST["log"]) || !isset($_POST["reg"])) {
    header("Location: ../src/access.php?error=brakdanych");
}










?>
<?php

require_once "../conf/config.php";
require_once "../classes/Offer.php";

$abspath = $_SERVER["BASE"];

$email = $_POST["email"];

if (empty($email) || !isset($_POST["confirm"])) {
    header("HTTP/1.0 403 Forbidden");
    header("Location: $abspath"."src/manage.php?error=submit-error");
    exit(403);
}

$offer_errors = [];

// Contact
$phone = $_POST["phone"];
$discord = $_POST["discord"];

// Settings
$days = $_POST["exp_days"];
$hours = $_POST["exp_hours"];

// Products
$books = $_POST["book"];
$price = $_POST["price"];
$quality = $_POST["quality"];
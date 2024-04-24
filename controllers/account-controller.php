<?php
$abspath = $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"];

if (!isset($_SESSION["uid"])) {
    header("HTTP/1.0 403 Forbidden");
    header("Location: ".$_SERVER["BASE"]."?login-required");
    exit();
}

if (!isset($_POST) || empty($_POST)) {
    header("HTTP/1.0 403 Forbidden");
    header("Location: ".$_SERVER["BASE"]."?incorrect-submit");
    exit();
}

require_once $abspath."conf/config.php";
require_once $abspath."classes/AccountManager.php";

if (isset($_POST("save"))) {
    $discord = $_POST["discord_user"];
    $email = $_POST["email_adress"];
    $phone = $_POST["phone_number"];
    $use_email = $_POST["email_flag"];
}

if (isset($_POST("set-new-password"))) {
    $new_pass = $_POST["new_pass"];
    $confirm_pass = $_POST["repeat_pass"];

    $idk->set_new_password($_SESSION["uid"], $new_pass);
}

if (isset($_POST("remove-account"))) {

}

// PHONE NR REGEX: /\d{3}[-\s]?\d{3}[-\s]?\d{3}/
// EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
// FILE EXT REGEX: ^\w+\.(gif|png|jpg|jpeg)$

// uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$
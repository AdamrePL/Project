<?php

require_once "functions.php";
require_once "../conf/config.php";

$uid = $_POST["user-id"];
$path_to_form = "../src/access.php";

if (!preg_match("/\w{3,30}#+[a-zA-Z0-9]{3}/", $uid)) {
    header("Location: $path_to_form?error=incorrect-uid");
}

$uid = explode("#", $uid);

$username = strtolower($uid[0]);
$id = $uid[1];
$uid = $username . '#' . $id;

if (!user_exists($conn, $uid)) {
    header("Location: $path_to_form?error=no-user-found");
}

if (get_user_password($conn, $uid)) {
    if (!isset($_POST["l_password"])) {
        header("Location: $path_to_form?error=password-required");
    }
}


$_POST["l_password"];



$conn -> close();
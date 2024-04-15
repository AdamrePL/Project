<?php

require_once "../conf/config.php";

$path_to_form = "../src/access.php";

if (isset($_SESSION["uid"])) {
    // throw new Exception("Error Processing Request", 403);
    
    header("Location: / ");
    exit(403);
}

if (!isset($_POST["log"])) {
    // throw new Exception("Error Processing Request", 403);
    
    header("Location: $path_to_form?error=l_submit-error");
    exit(403);
}

include_once "account-controller.php";
include_once "../classes/AccountManager.php";
require_once "../classes/LoginManager.php";

$uid = trim($_POST["user-id"]);

$manager = new LoginManager($conn, $uid);

try {
    $manager->check_uid();
} catch (Exception) {
    header("Location: $path_to_form?error=incorrect-uid");
    exit(422);
}

$res = $manager->validate();

$id = $res["id"];
$uid = $res["uid"];

try {
    $manager->check_len($id);
} catch (Exception) {
    header("Location: $path_to_form?error=incorrect-tag");
    exit(422);
}

$idk = new AccountManager($conn);

try {
    if (!$idk->user_exists($uid)) {
    // throw new Exception("no-user-found", 403);
        header("Location: $path_to_form?error=no-user-found");
        exit(403);
    }
} catch (EXCEPTION) {}

$pwd = $idk->get_user_password($uid);

if (!empty($pwd) && empty($_POST["l_password"])) {
    // throw new Exception("password-required", 403);

    header("Location: $path_to_form?error=password-required");
    exit(403);
}

if (password_verify($_POST["l_password"], $pwd)) {
    // throw new Exception("wrong-password", 403);

    header("Location: $path_to_form?error=wrong-password");
    exit(403);
}

$manager->login();

header("Location: ../src/profile.php?info=success");

$conn->close();
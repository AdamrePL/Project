<?php

require_once "../conf/config.php";

$path_to_form = "../src/access.php";

if (isset($_SESSION["uid"])) {
    header("Location: ". $_SERVER["BASE"]);
    exit(403);
}

if (!isset($_POST["submit"])) {
    header("Location: $path_to_form?error=submit-error");
    exit(403);
}

if (!isset($_POST["email"])) {
    header("HTTP/1.0 403 Forbidden");
    header("Location: $path_to_form?error=no-email-provided");
    exit(403);
}

include_once "../classes/AccountManager.php";
require_once "../classes/LoginManager.php";


$email = str_replace(" ", "", trim($_POST["email"]));

$user_credentials = new LoginManager($conn, $email);
$manager = new AccountManager($conn);

if (!$manager->user_exists($email)) {
    header("Location: $path_to_form?error=no-user-found");
    exit(403);
}

try {
    $pwd = $manager->get_user_password($user_credentials->email);
    if (!empty($pwd) && empty($_POST["password"])) {
        throw new Exception("password-required", 403);
    }
    
    if (password_verify($_POST["password"], $pwd)) {
        throw new Exception("wrong-password", 403);
    }
} catch (Exception $error) {
    $err = $error->getMessage();
    header("Location: $path_to_form?error=$err");
    exit(403);
}

if ($user_credentials->login()) {
    header("Location: ../src/profile.php?info=success");
} else {
    header("Location: $path_to_form?error=unexpected-error");
}

$conn->close();
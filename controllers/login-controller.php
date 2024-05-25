<?php

require_once "../conf/config.php";

$path_to_form = "../src/login.php";

if (isset($_SESSION["email"])) {
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

require_once "../classes/LoginManager.php";

$email = str_replace(" ", "", trim($_POST["email"]));

$user_credentials = new LoginManager($conn, $email);

if ($user_credentials->login()) {
    header("Location: ../src/manage.php");
} else {
    header("Location: $path_to_form?error=unexpected-error");
}

$conn->close();
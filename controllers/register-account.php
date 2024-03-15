<?php
require_once "../conf/config.php";
include_once "account-controller.php";

$path_to_form = "../src/access.php";

if (isset($_SESSION["uuid"])) {
    header("Location: ");
}

if (!isset($_POST["reg"])) {
    header("Location: $path_to_form?error=submit-error");
}

$pass_len = 5;
$name_len = 30;

const USERNAME_PATTERN = "/[a-zA-Z]{1}\w{2,29}/";

$name = $_POST["username"];
$email = $_POST["email"];
$pass = $_POST["r_password"];
$pass_check = $_POST["r_password-repeat"];

if (!preg_match(USERNAME_PATTERN, $name)) {
    header("Location: $path_to_form?error=incorrect-username");
    exit(422);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: $path_to_form?error=incorrect-email");
    exit(422);
}

if (!preg_match("/(?=.*\d)/", $pass)) {
    header("Location: $path_to_form?error=digit-required");
    exit(422);
}

if (!preg_match("/(?=.*[A-Z])/", $pass)) {    
    header("Location: $path_to_form?error=capital-letter-required");
    exit(422);
}

if (!preg_match("/(?=.*[a-z]/", $pass)) {
    header("Location: $path_to_form?error=lowercase-letter-required");
    exit(422);
}

if(strlen($pass) < $pass_len){
    header("Location: $path_to_form?error=shit-too-small-men");
    exit(422);
}

if (user_exists($conn, generate_id($name))) {
    header("Location: $path_to_form?error=user-exists");
    exit(409);
}

if ($pass !== $pass_check) {
    header("Location: $path_to_form?error=passwords-dont-match");
    exit(403);
}

if (!isset($_POST["accept_tos"])) {
    header("Location: $path_to_form?error=tos-rejected");
    exit();
}

$hashemail = convert_uuencode(base64_encode($email));
$hashpass = password_hash($pass, PASSWORD_DEFAULT);
create_user($conn, $name, $hashemail, $hashpass);

header("Location: ../src/profile.php"); 
?>
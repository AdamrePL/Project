<?php
require_once "../conf/config.php";

$path_to_form = "../src/access.php";

if (isset($_SESSION["uid"])) {
    header("Location: / ");
    exit(403);
}

if (!isset($_POST["reg"])) {
    header("Location: $path_to_form?error=r_submit-error");
    exit(403);
}

include_once "account-controller.php";

$pass_len = 5;
$name_len = 30;

const USERNAME_PATTERN = "/[a-zA-Z]{1}\w{2,29}/";

$name = trim($_POST["username"]);
$email = trim($_POST["email"]);
$pass = trim($_POST["r_password"]);
$pass_check = trim($_POST["r_password-repeat"]);

if (!preg_match(USERNAME_PATTERN, $name)) {
    header("Location: $path_to_form?error=incorrect-username");
    exit(422);
}

if (strlen($name) > $name_len) {
    header("Location: $path_to_form?error=name-too-short");
    exit(403);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: $path_to_form?error=incorrect-email");
    exit(422);
}

if (!preg_match("/(?=.*\s)/", $pass)) {
    header("Location: $path_to_form?error=processing-data-failure");
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

if (strlen($pass) < $pass_len){
    header("Location: $path_to_form?error=shit-too-small-men");
    exit(422);
}

if ($pass !== $pass_check) {
    header("Location: $path_to_form?error=passwords-dont-match");
    exit(403);
}

if (!isset($_POST["accept_tos"])) {
    header("Location: $path_to_form?error=agreement-rejected");
    exit(403);
}


create_user($conn, $name, $email, $pass);

header("Location: ../src/profile.php"); 
?>
<?php
require_once "../conf/config.php";
include_once "account-controller.php";


if (isset($_SESSION["uuid"])) {
    header("Location: ");
}

//? whuh? there doesn't even exist a single field named "log" or "reg" . . . ?
// if (!isset($_POST["log"]) || !isset($_POST["reg"])) {
//     header("Location: ../src/access.php?error=brakdanych");
// }

$pass_len = 5;
$name_len = 30;

$path_to_form = "../src/access.php";
const USERNAME_PATTERN = "/[a-zA-Z]{1}\w{2,29}/";

$name = $_POST["username"];
$mail = $_POST["email"];
$pass = $_POST["r_password"];
$pass_check = $_POST["r_password-repeat"];

if (!preg_match(USERNAME_PATTERN, $name)) {
    header("Location: $path_to_form?error=incorrect-username");
    exit(422);
}
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    header("Location: $path_to_form?error=incorrect-username");
    exit(422);
}

// if (!preg_match(USERNAME_PATTERN, $pass)) {
//     header("Location: $path_to_form?error=incorrect-username");
//     exit(422);
// }

if (!preg_match("/\d/", $pass)) {
    header("Location: $path_to_form?error=digit-required");
    exit(422);
}

if (!preg_match("/[A-Z]/", $password)) {    
    header("Location: $path_to_form?error=capital-letter-required");
    exit(422);
}

if (!preg_match("/[a-z]/", $password)) {
    header("Location: $path_to_form?error=lowercase-letter-required");
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
echo "yippee :)";
// $hashed = password_hash($pass, PASSWORD_DEFAULT);
// create_user($conn, $name, $mail, $hashed); //something's wrong with this
// //&todo: FIX!!!! PLEASE!!!
// header("Location: ../src/profile.php"); 
?>
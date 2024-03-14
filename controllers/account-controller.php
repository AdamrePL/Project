<?php
require_once "functions.php";

$pass_len = 5;
$name_len = 30;

const USERNAME_PATTERN = "/[a-zA-Z]{1}\w{2,29}/";


    // if (strlen($name) > $name_len) {
    //     return "Nazwa nie może przekraczać $name_len znaków";
    // }
    // if (!preg_match("/[a-zA-Z0-9]/", $name)) {
    //     return "Nazwa może zawierać jedynie małe, duże litery i cyfry";
    // }
    // if (strlen($password) < $pass_len) {
    //     return "Hasło powinno mieć przynajmniej $pass_len znaków";
    // }
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     return "Niepoprawny email";
    // }
    // if ($password != $password_confirm) {
    //     return "Hasła nie są identyczne";
    // }
    // if (!preg_match("/\d/", $password)) {
    //     return "Hasło powinno zawierać przynajmniej jedna cyfre";
    // }
    // if (!preg_match("/[A-Z]/", $password)) {
    //     return "Hasło powinno zawierać przynajmniej jedna dużą litere";
    // }
    // if (!preg_match("/[a-z]/", $password)) {
    //     return "Hasło powinno zawierać przynajmniej jedna małą litere";
    // }
    // if (!preg_match("/\W/", $password)) {
    //     return "Password should contain at least one special character";
    // }
    // if (preg_match("/\s/", $password)) {
    //     return "Hasło nie powinno zawierać spacji";
    // }


function create_user(mysqli $conn, string $name, string $email, string $password): bool {
    $i = 0;
    $uid = generate_id($name);
    while (user_exists($conn, $uid)) {
        $uid = generate_id($name);
        $i++;
        echo "tried $i times";
    }

    $stmt = mysqli_stmt_init($conn);
    if ($password != "") {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` VALUES(?, $name, $hashed, '', '', $email, '', '', '', '');";
        mysqli_stmt_prepare($stmt, $sql);
    } else {
        $sql = "INSERT INTO `users` VALUES(?, $name, '', '', '', $email, '', '', '', '');";
        mysqli_stmt_prepare($stmt, $sql);
    }
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    return true;
}

function validate_phone(int $number): bool {
    if (!preg_match("\+?[0-9]{0,2}?[0-9]{9}", $number)) {
        return false;
    }
    return true;
}

function set_phone(mysqli $conn, string $uid, int $nr): void {
    $stmt = mysqli_stmt_init($conn);
    $sql = "UPDATE `users` SET `phone`= ? WHERE uuid = $uid;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nr);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function set_discord(mysqli $conn, string $uid, string $discord_id) {
    $stmt = mysqli_stmt_init($conn);
    $sql = "UPDATE `users` SET `discord`= ? WHERE uuid = $uid;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $discord_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// ! Currently disabled as it requires 
// @PiwkoM: enabled for profile-controller.php
function change_email($conn, string $uid, string $email) {
    $stmt = mysqli_stmt_init($conn);
    $sql = "UPDATE `users` SET `phone`= ? WHERE uuid = $uid;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nr);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function generate_id(string $name): string {
    $chars = [];
    for ($i=65; $i < 90; $i++) { 
        array_push($chars, chr($i));
    } 
    for ($i=97; $i < 122; $i++) { 
        array_push($chars, chr($i));
    } 
    for ($i=0; $i < 9; $i++) { 
        array_push($chars, $i);
    }

    return strtolower($name) . "#" . $chars[rand(0, count($chars)-1)] . $chars[rand(0, count($chars)-1)] . $chars[rand(0, count($chars)-1)];
}



// PHONE NR REGEX: /\d{3}[-\s]?\d{3}[-\s]?\d{3}/
// EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
// FILE EXT REGEX: ^\w+\.(gif|png|jpg|jpeg)$

// uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$
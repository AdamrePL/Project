<?php
require_once "functions.php";

function create_user(mysqli $conn, string $name, string $email, string $password): bool {
    $i = 0;
    $uid = generate_id($name);
    while (user_exists($conn, $uid)) {
        $uid = generate_id($name);
        $i++;
        echo "tried $i times";
    }

    $hashemail = convert_uuencode(base64_encode($email));
    $stmt = mysqli_stmt_init($conn);
    if ($password != "") {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` VALUES(?, $name, $hashed, '', '', $hashemail, '', '', '', '');";
        //? $sql = "INSERT INTO `users`.`uuid`,`users`.`username`, `users`.`password` , `users`.`email` VALUES(?, $name, $hashed, $email);";
        mysqli_stmt_prepare($stmt, $sql);
    } else {
        $sql = "INSERT INTO `users` VALUES(?, $name, '', '', '', $hashemail, '', '', '', '');";
        //? $sql = "INSERT INTO `users`.`uuid`,`users`.`username`, `users`.`email` VALUES(?, $name, $email);";
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
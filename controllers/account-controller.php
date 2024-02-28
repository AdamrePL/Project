<?php

require "../config.php";

function check_user_data($name, $surename, $password, $password_confirm): string {
    $x = 8;
    if (strlen($password) < $x) {
        $str = "Hasło powinno mieć przynajmniej " . $x . "znaków";
        return $str;
    }
    if ($password != $password_confirm) {
        return "Hasła nie są identyczne";
    }
    if (!preg_match("/\d/", $password)) {
        return "Hasło powinno zawierać przynajmniej jedna cyfre";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Hasło powinno zawierać przynajmniej jedna dużą litere";
    }
    if (!preg_match("/[a-z]/", $password)) {
        return "Hasło powinno zawierać przynajmniej jedna małą litere";
    }
    if (!preg_match("/\W/", $password)) {
        return "Password should contain at least one special character";
    }
    if (preg_match("/\s/", $password)) {
        return "Hasło nie powinno zawierać spacji";
    }
}

function create_user(mysqli $conn, string $name, string $surename, string $password): void {
    $stmt = mysqli_stmt_init($conn);
    $uid = ord(strtoupper('z')) . rand(0,9) . date("HmYd") . rand(0,9) . $user_count + 1 . rand(0,9);
    $uid_count = 00001;
    mysqli_query($conn, "SELECT COUNT(*) FROM `users` WHERE uuid LIKE $uid_count;");
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` VALUES($uid, ?, ?, " . $hashed . ", '[]', '');";
}

function set_phone(mysqli $conn, string $uid, int $nr): void {
    $stmt = mysqli_stmt_init($conn);
    $sql = "UPDATE `users` SET `phone`= ? WHERE uuid = $uid;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nr);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} 
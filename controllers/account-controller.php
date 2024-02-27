<?php

require "../config.php";

function check_user_data($name, $surename, $password, $password_confirm): bool {
    if (strlen($password) < 8) {
        return FALSE;
    }
    if ($password != $password_confirm) {
        return FALSE;
    }
    if ($password)
}

function create_user(mysqli $conn, string $name, string $surename, string $password): void {
    $stmt = mysqli_stmt_init($conn);
    $uid;
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users VALUES($uid, ?, ?, " . $hashed . ")"
}

function set_phone(mysqli $conn, string $uid, int $nr): void {
    $stmt = mysqli_stmt_init($conn);
    $sql = "UPDATE `users` SET `phone`= ? WHERE uuid = $uid;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nr);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} 
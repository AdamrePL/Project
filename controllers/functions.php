<?php

function user_exists(mysqli $conn, $uid): bool {
    $sql = "SELECT COUNT(*) FROM `users` WHERE uuid = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return mysqli_num_rows($result) > 0;
}

function get_user_password(mysqli $conn, $uid): string|bool {
    $sql = "SELECT `password` FROM `users` WHERE uuid = ? LIMIT 1;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row["password"];
    }

    return false;
}

function update_last_login(mysqli $conn, string $uid) {
    $sql = "UPDATE `users` SET `last-login` = NOW() WHERE uuid = $uid";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    // dodać aby to robilo liste z ostatnimi logowaniami i dodawalo do tej listy ostatnie logowanie
    // maksymalna ilosc ostatnich logowan = 3
    // ostatnie logowanie dodawalo by na poczatek listy
}

function log_out(): bool {
    if (empty($_SESSION)) {
        return false;
    }

    session_unset();
    session_destroy();
    return true;
}

?>
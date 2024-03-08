<?php

function log_out(): bool {
    if (empty($_SESSION)) {
        return false;
    }

    session_unset();
    session_destroy();
    return true;
}

function update_last_login(mysqli $conn, string $username) {
    $sql = "UPDATE `users` SET `last-login` = NOW() WHERE username = ?";
    $stmt = mysqli_stmt_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    // dodać aby to robilo liste z ostatnimi logowaniami i dodawalo do tej listy ostatnie logowanie
    // maksymalna ilosc ostatnich logowan = 3
    // ostatnie logowanie dodawalo by na poczatek listy
}

$conn -> close();
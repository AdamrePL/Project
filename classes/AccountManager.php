<?php
class AccountManager {
    private $conn;
    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }
    public function delete_user(string $uid): void {
        $sql = "DELETE FROM `users` WHERE uuid = ?";
        $stmt = mysqli_stmt_init($this->conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    public function validate_phone(int $number): bool {
        if (!preg_match("/\d{3}[-\s]?\d{3}[-\s]?\d{3}/", $number)) {
            return false;
        }
        return true;
    }
    public function set_phone(string $uid, int $nr): void {
        $stmt = mysqli_stmt_init($this->conn);
        $sql = "UPDATE `users` SET `phone`= ? WHERE uuid = $uid;";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $nr);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    public function set_discord(string $uid, string $discord_id) {
        $stmt = mysqli_stmt_init($this->conn);
        $sql = "UPDATE `users` SET `discord`= ? WHERE uuid = $uid;";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $discord_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    public function change_email(string $uid, string $email) {
        $hashed_email = convert_uuencode(base64_encode($email));
        $stmt = mysqli_stmt_init($this->conn);
        $sql = "UPDATE `users` SET `email`= ? WHERE uuid = $uid;";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $hashed_email);
    }
}
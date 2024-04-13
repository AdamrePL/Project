<?php
class AccountManager {
    private $conn;
    /**
     * @var array Contains digits 0-9, uppercase and lowercase english alphabet letters.
    */
    private $chars;
    private string $split_character = '#';
    private $length = 3;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        $this->chars = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
    }

    public function generate_uid($name): string
    {
        return strtolower($name) . $this->split_character . array_rand($this->chars, $this->length);
    }
    
    public function user_exists($uid): bool {
        $sql = "SELECT * FROM `users` WHERE uuid = ?;";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows > 0;
    }

    public function get_user_password($uid): string {
        $sql = "SELECT `password` FROM `users` WHERE uuid = ? LIMIT 1;";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = mysqli_fetch_assoc($result);
        return $row["password"];
    }

    /**
     * @param string $uid users uuid
     * @return void well the function has nothing to return, so it voids.
    */
    public function delete_user(string $uid): void {
        $sql = "DELETE FROM `users` WHERE uuid = ?";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * @param int $number phone number wheter with spaces or without
     * 
     * @return true returns true if phone number form is correct.
     * @return false returns false if phone number doesn't match format.
    */
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
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
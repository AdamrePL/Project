<?php
class AccountManager {
    private $conn;
    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }
    
    /**
     * @param string $uid users uuid
     * @return void well the function has nothing to return, so it voids.
    */
    public function delete_user(string $uid): void {
        $sql = "DELETE FROM `users` WHERE uuid = ?";
        $stmt = mysqli_stmt_init($this->conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
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
    public function get_user_id_by_email(string $email){
        $hashed_email = convert_uuencode(base64_encode($email));
        // $query = mysqli_query($this->conn, "SELECT * FROM `users` WHERE email = '" . $hashed_email . "'");

        $sql = "SELECT * FROM `users` WHERE email = ?";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bind_param("s", $hashed_email);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $data = $result->fetch_assoc(); // fetch data  
        $row_uid = $data["uuid"];
        return $row_uid;
    }
    public function set_password_by_uid(string $pass, string $uid) : bool {
        $sql = "UPDATE `users` SET `password` = ? WHERE `uuid` = ?";
        $stmt = mysqli_stmt_init($this->conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ss",$pass, $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $affected = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $affected;
    }

    public function get_id_by_password_reset_token(string $token) : string{
        $sql = "SELECT `user-uuid` FROM `password-reset-tokens` WHERE `token` = ?";
        $stmt = mysqli_stmt_init($this->conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        $result = $stmt->get_result(); 
        $data = $result->fetch_assoc(); 
        return $data["user-uuid"];

    }

}
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

    public function generate_uid($name): string {
        $uid = strtolower($name) . $this->split_character;
        $chars_len = count($this->chars);
        for ($i = 0; $i < $this->length; $i++) {
            $uid .= $this->chars[rand(0, $chars_len-1)];
        }
        return $uid;
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
        if (!$stmt->prepare($sql)) {
            throw new mysqli_sql_exception("mysql-stmt-error");
        }
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if (!$row = mysqli_fetch_assoc($result)) {
            throw new mysqli_sql_exception("mysql-error--user-password");
        }
        return $row["password"];
    }

    /**
     * @param string $name
     * Username, not person's name.
     * @param string $email
     * Not yet hashed, verified email adress
     * @param string $password (Optional)
     * Not yet hashed password. Set to an empty string by default.
     * 
     * @return string returns user's uid if user is successfuly added to a database table. You can also say it returns true.
     * @return false on mysql_stmt_prepare() error.
    */
    function create_user(string $name, string $email, string $password = ""): string|false {
        $uid = $this->generate_uid($name);
        while ($this->user_exists($uid)) {
            $uid = $this->generate_uid($name);
        }

        $hashed_email = convert_uuencode(base64_encode($email));

        $stmt = $this->conn->stmt_init();
        if (!empty($password) || $password != "") {
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            
            // $sql = "INSERT INTO `users` VALUES(?, ?, ?, '', '', ?, '', '', '', '');";
            $sql = "INSERT INTO `users`(`uuid`,`username`, `password` , `email`) VALUES(?, ?, ?, ?);";
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return false;
            }
            $stmt->bind_param("ssss", $uid, $name, $hashed_pass, $hashed_email);
        } else {
            // $sql = "INSERT INTO `users` VALUES(?, ?, '', '', '', ?, '', '', '', '');";
            $sql = "INSERT INTO `users`(`uuid`,`username`,`email`) VALUES(?, ?, ?);";
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return false;
            }
            $stmt->bind_param("sss", $uid, $name, $hashed_email);
        }
        
        $stmt->execute();
        $stmt->close();

        return $uid;
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

    public function dehash_email(string $email) {
        return base64_decode(convert_uudecode($email));
    }

    public function set_new_password(string $uid, $new_pass) {
        $password = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE `users` SET `password` = ? WHERE `uuid` = '$uid'";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $password);
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
        $stmt = $this->conn->stmt_init();
        $sql = "UPDATE `users` SET `phone`= ? WHERE uuid = $uid;";
        $stmt->prepare($sql);
        $stmt->bind_param('s', $nr);
        $stmt->execute();
        $stmt->close();
    }
    public function set_discord(string $uid, string $discord_id) {
        $stmt = mysqli_stmt_init($this->conn);
        $sql = "UPDATE `users` SET `discord`= ? WHERE uuid = $uid;";
        $stmt->prepare($sql);
        $stmt->bind_param('s', $discord_id);
        $stmt->execute();
        $stmt->close();
    }
    public function change_email(string $uid, string $email) {
        $hashed_email = convert_uuencode(base64_encode($email));
        $stmt = $this->conn->stmt_init();
        $sql = "UPDATE `users` SET `email`= ? WHERE uuid = $uid;";
        $stmt->prepare($sql);
        $stmt->bind_param('s', $hashed_email);
        $stmt->execute();
        $stmt->close();
    }
}
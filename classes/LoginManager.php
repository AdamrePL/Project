<?php

class LoginManager {
    private $conn;

    public $email;

    private function decrypt_email() {
        return convert_uudecode(base64_decode($this->email));
    }

    public function __construct(mysqli $conn, $email) {
        $this->conn = $conn;
        $this->email = convert_uuencode(base64_encode($email));
    }

    public function login() {
        $sql = "SELECT * FROM `offers` WHERE `offers`.`email` = ?";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $param = self::decrypt_email();
        $stmt->bind_param('s', $param);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            session_regenerate_id(true);
            $_SESSION["email"] = $this->email;
            $_SESSION["isadmin"] = 0;
            return true;
        }
        $stmt->close();

        return false;
    }

}

?>
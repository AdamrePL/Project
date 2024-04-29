<?php

class LoginManager {
    private $conn;

    public $email;

    public function __construct(mysqli $conn, $email) {
        $this->conn = $conn;
        $this->email = convert_uuencode(base64_encode($email));
    }

    private function update_last_login() {
        $sql = "UPDATE `users` SET `last-login` = NOW() WHERE email = ?";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $stmt->close();
    }

    public function login() {
        $sql = "SELECT * FROM `users` WHERE email = ?;";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param('s', $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result = mysqli_fetch_assoc($result)) {
            session_regenerate_id(true);
            $_SESSION["uid"] = $result["uid"];
            $_SESSION["email"] = $result["email"];
            $_SESSION["isadmin"] = $result["admin"];
            $_SESSION["username"] = $result["username"];
            $this->update_last_login();
            return true;
        }
        $stmt->close();

        return false;
    }

}

?>
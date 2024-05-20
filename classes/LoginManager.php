<?php

class LoginManager {
    private $conn;

    public $email;

    public function __construct(mysqli $conn, $email) {
        $this->conn = $conn;
        $this->email = convert_uuencode(base64_encode($email));
    }

    public function login() {
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param('s', $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result = mysqli_fetch_assoc($result)) {
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
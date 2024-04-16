<?php

class LoginManager {
    private $conn;

    public $uid;
    public $username;
    public $tag;
    
    protected const UID_PATTERN = "/\w{3,30}(#[a-zA-Z0-9]{3})/";

    public function __construct(mysqli $conn, $uid) {
        $this->conn = $conn;
        $this->uid = $uid;
    }

    public function check_uid() {
        if (!preg_match(self::UID_PATTERN, $this->uid)) {
            throw new Exception("incorrect-uid", 422);
        }
    }

    public function validate() {
        $uid = explode("#", $this->uid);
        $username = $uid[0];
        $id = $uid[1];
        $uid = strtolower($username) . '#' . $id;

        $this->uid = $uid;
        $this->username = $username;
        $this->tag = $id;
        
        if (strlen($this->tag) > 3) {
            throw new Exception("incorrect-tag", 403);
        }
    }

    private function update_last_login() {
        $sql = "UPDATE `users` SET `last-login` = NOW() WHERE uuid = ?";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $this->uid);
        $stmt->execute();
        $stmt->close();
    }

    public function login() {
        $sql = "SELECT * FROM `users` WHERE uuid = ?;";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param('s', $this->uid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result = mysqli_fetch_assoc($result)) {
            session_regenerate_id(true);
            $_SESSION["uid"] = $result["uuid"];
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
<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

class LoginController {
    private $conn;



    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    const UID_PATTERN = "/\w{3,30}(#[a-zA-Z0-9]{3})/";

    public function loginUser(){
        try{
            require_once 'account-controller.php';
            $accController = new Account($this->conn);

            if (isset($_SESSION["uid"])) {
                header("Location: / ");
                exit(403);
            }
            
            if (!isset($_POST["log"])) {
               throw new Exception('no login');
            }
            
            include_once "account-controller.php";
            
            $uid = trim($_POST["user-id"]);
            
            
            if (!preg_match(self::UID_PATTERN, $uid)) {
                throw new Exception('incorrect uid');
            }
            
            $uid = explode("#", $uid);
            $username = strtolower($uid[0]);
            $id = $uid[1];
            $uid = $username . '#' . $id;
            
            if (strlen($id) > 3) {
                throw new Exception('incorrect tag');
            }
            
            
            if (!$accController->user_exists($uid)) {
                throw new Exception('no user');
            }
            
            $pwd = $accController->get_user_password($uid);
            
            if (!empty($pwd) && empty($_POST["l_password"])) {
                throw new Exception('password required');
            }
            if(!empty($pwd)){
                if (!password_verify($_POST["l_password"], $pwd)) {
                    throw new Exception('wrong password');
                }
            }

            
            $sql = "SELECT * FROM `users` WHERE uuid = ?;";
            $stmt = mysqli_stmt_init($this->conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 's', $uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result = mysqli_fetch_assoc($result)) {
                session_regenerate_id(true);
                $_SESSION["uid"] = $result["uuid"];
                $_SESSION["isadmin"] = $result["admin"];
                $_SESSION["username"] = $result["username"];
            }
            
            $accController->update_last_login($uid);
            header("Location: ../src/profile.php?info=success");
            
            $conn -> close();
        }catch(Exception $e){
            echo $e->getMessage();
            echo ('<script>console.log("' . $e->getMessage() . '");</script>');
        }
        
    }

}

<?php
require_once "../conf/config.php";

class Register
{
    private $conn;

    const USERNAME_PATTERN = "/[a-zA-Z]{1}\w{2,29}/";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function registerController()
    {
        try {
            $abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
            require_once $abspath.'\controllers\account-controller.php';
            $accController = new Account($this->conn);
            if (isset($_SESSION["uid"])) {
                header("Location: / ");
                exit(403);
            }

            if (!isset($_POST["reg"])) {
                throw new Exception('chuj wie');
            }


            $pass_len = 5;
            $name_len = 30;


            $name = str_replace(" ", "", trim($_POST["username"]));
            $email = str_replace(" ", "", trim($_POST["email"]));
            $pass = trim($_POST["r_password"]);
            $pass_check = trim($_POST["r_password-repeat"]);

            if (empty($name) || empty($email)) {
                throw new Exception('empty fields');
            }

            if (!preg_match(self::USERNAME_PATTERN, $name)) {
                throw new Exception('incorrect username');
            }

            if (strlen($name) > $name_len) {
                throw new Exception('name to short');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('incorrect email');
            }

            if (!empty($pass)) {
                if (strlen($pass) < $pass_len) {
                    throw new Exception('password is too small');
                }

                if (empty($pass_check)) {
                    throw new Exception('reapeat required');
                }

                if ($pass !== $pass_check) {
                    throw new Exception('password dont much');
                }

                if (preg_match("/(?=.*\s)/", $pass)) {
                    throw new Exception('processing data failure');
                }

                if (!preg_match("/(?=.*\d)/", $pass)) {
                    throw new Exception('digit required');
                }

                if (!preg_match("/(?=.*[A-Z])/", $pass)) {
                    throw new Exception('capital letters required');
                }

                if (!preg_match("/(?=.*[a-z])/", $pass)) {
                    throw new Exception('lowercase letters required');
                }
            }

            if (!isset($_POST["accept_tos"])) {
                throw new Exception('aggreement rejected');
            }


            if ($uid = $accController->create_user($name, $email, $pass)) {
                // do formularza oraz tutaj dodac wybor czy logowac po zarejestrowaniu czy nie,
                //& it ""works""
                // jezeli nie to:
                // if (!isset($_POST["login_after_register"])) {
                //     header("Location: ../src/profile.php");
                //     exit(200);
                // } else {
                session_regenerate_id(true);
                $_SESSION["uid"] = $uid;
                $_SESSION["isadmin"] = 0;
                $_SESSION["username"] = $name;
                $_SESSION["first-login"] = 2;
                header("Location: ../src/profile.php");
                exit(200);
                // }
            } else {
                throw new Exception('unexcepted error');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            echo ('<script>console.log("' . $e->getMessage() . '");</script>');
        }
    }
}

<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
class Profile
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function deleteUserAfter13(){
        $res = $this->conn->query("SELECT * FROM `offers` LIMIT 1");
        include_once $abspath . '\classes\Offer.php';
        $offer = new Oferty($this->conn);
        if($offer->dateToDays($offer->FormatDate(),$res["last-login"]) >= 395){
            $this->conn->query("DELETE FROM `users` WHERE `uuid` =" . $row["uuid"]);
        }
    }

    public function profileController()
    {
        try {
            require_once $abspath . 'controllers\account-controller.php';
            $accController = new Account($this->conn);

            $if_pass_set = isset($_POST["new_password"]);
            $pass = $_POST["new_password"];
            $passCheck = $_POST["con_password"];

            $mail = $_POST["email_adress"];
            $if_mail_set = isset($mail);
            $phone = $_POST["telephone_number"];
            $if_phone_set = isset($phone);
            $discord = $_POST["discord_user"];
            $if_discord_set = isset($discord);

            $mail_flag = isset($_POST["email_flag"]);

            if ($if_pass_set && ($pass === $passCheck)) {
                $sql = "UPDATE `users` SET `password` = $pass WHERE `uuid` = ?";
                $stmt = mysqli_stmt_init($this->conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "s", $uid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                echo $result;
            }

            if ($if_mail_set) {
                $accController->change_email($this->conn, $_SESSION["uid"], $mail);
            }

            if ($if_phone_set && $accController->validate_phone($phone)) {
                //? is this correct?
                $accController->set_phone($this->conn, $_SESSION["uid"], $phone);
            }

            if ($if_discord_set) {
                $accController->set_discord($this->conn, $_SESSION["uid"], $discord);
            }

            if ($mail_flag) {
                $sql = "UPDATE `users` SET `email-flag` = 1 WHERE `uuid` = ?";
                $stmt = mysqli_stmt_init($this->conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "s", $uid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                echo $result;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            echo ('<script>console.log("' . $e->getMessage() . '");</script>');
        }
    }
}

<?php
require_once "../conf/config.php";
class OfferController
{
    private $conn;

    public $post;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // public function CheckAll($email, $phone, $discord)
    // {
    //     try {
    //         if (isset($email)) {
    //             if (!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email)) {
    //                 throw new ErrorException('invalid email');
    //             }
    //         } elseif (isset($phone)) {
    //             if (!preg_match("^\+48[0-9]{9}$", $phone)) {
    //                 throw new ErrorException('invalid phone number');
    //             }
    //         } elseif (isset($discord)) {
    //             if (strlen($this->post["discord"]) >= 4 || strlen($this->post["discord"]) <= 32) {
    //                 throw new ErrorException('invalid discord nickname');
    //             }
    //         }
    //     } catch (ErrorException $e) {
    //         header('Location: ' . $_SERVER["BASE"] . "\src\createoffer.php?error=" . $e->getMessage());
    //         echo '<script>console.log(' . $e->getMessage() . ')</script>';
    //     }
    // }
    public function FormatDate()
    {
        date_default_timezone_set('Europe/Warsaw');
        $FormatDate = date('Y-m-d H:i:s');
        return $FormatDate;
    }

    public function ExpDay()
    {
        $days = $_POST["exp_days"];
        if (empty($days) || $days < 5) {
            $days = 14;
        } else if ($days > 91) {
            $days = 91;
        }
        return $days;
    }

    public function ExpHours()
    {
        $hours = $_POST["exp_hours"];
        if (empty($hours) || $hours < 0) {
            $hours = 0;
        } else if ($hours > 23) {
            $hours = 23;
        }
        return $hours;
    }


    public function addOffer()
    {
        try {
            // $user = htmlspecialchars(stripslashes(trim($_SESSION["uuid"])));


            $user = $_SESSION['uid'];
            $phone = htmlspecialchars(stripslashes(trim($_POST["phone"])));
            $email = htmlspecialchars(stripslashes(trim($_POST["email"])));
            $discord = htmlentities(stripslashes(trim($_POST["discord"])));
            $days = htmlspecialchars(stripslashes(trim(self::ExpDay())));
            $hours = htmlspecialchars(stripslashes(trim(self::ExpHours())));
            $exp = $_POST["exp_days"];
            if ($exp == NULL) {
                $exp = 30;
            }
            $this->conn->query("INSERT INTO offers VALUES ('', '$user', NOW(), NOW() + INTERVAL $exp DAY, 1, '$phone', '$email', '$discord')");
            $lastid = $this->conn->insert_id;

            $date = self::FormatDate();
            foreach ($_POST['book'] as $key => $book) {
                $query = mysqli_query($this->conn, "SELECT * FROM booklist WHERE id =" . $book);
                $res = mysqli_fetch_assoc($query);
                $list = array($res["name"], $res["authors"], $res["publisher"], $res["subject"], $_POST["note"][$key], $_POST['price'][$key],$_POST["exp_days"], $_POST["quality"][$key]);
                $this->conn->query("INSERT INTO products VALUES ('','$lastid','$list[0]','$list[1]','$list[2]','$list[3]','1','$list[5]','$list[7]','$list[4]','','0')");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            // header('Location: ' . './offer-controller.php?error=' . $e->getMessage());

            echo ('<script>console.log("' . $e->getMessage() . '");</script>');
        }
    }
}
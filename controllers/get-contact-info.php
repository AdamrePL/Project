<?php
    if(isset($_POST["id"])){
        require_once "../conf/config.php";
        require_once "../classes/CaptchaVerify.php";

        $captcha = new CaptchaVerify($_POST["g-recaptcha-response"], $_SERVER["REMOTE_ADDR"]);
        if($captcha->is_success()){
            $sql = "SELECT * FROM `offers` WHERE `id` = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "s", $_POST["id"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $data = $result->fetch_assoc();
            if(isset($data)){
                echo "<p>Telefon: ", $data["phone"], "</p>";
                echo "<p>Email: ", $data["email"], "</p>";
                echo "<p>Discord: ", $data["discord"], "</p>";
            } else {
                echo "failure";
            }
            
        } else {
            echo "failure";
        }
    }
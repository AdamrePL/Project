<?php
    require_once "../conf/config.php";
    require_once "../classes/AccountManager.php";

    if (isset($_POST["set-new-password"])) {
        $pass = $_POST["new_pass"];
        $passCheck = $_POST["repeat_pass"];

        if ($pass === $passCheck) {
            $sql = "UPDATE `users` SET `password` = $pass WHERE `uuid` = ?";
            $stmt = $conn->stmt_init();
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"s",$uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            echo $result;
        }
    }

    if (isset($_POST["save"])) {
        $mail = $_POST["email_adress"];
        $phone = $_POST["phone_number"];
        $discord = $_POST["discord_user"];
        $mail_flag = $_POST["email_flag"];

        $manage = new AccountManager($conn);
        $manage->change_email($_SESSION["uid"], $mail);
        $manage->set_phone($_SESSION["uid"], $phone);
        $manage->set_discord($_SESSION["uid"], $discord);
    
        $sql = "UPDATE `users` SET `email-flag` = 1 WHERE `uuid` = ?";
        $stmt = $conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result($stmt);
        $stmt->close();
        echo $result;
    }
?>
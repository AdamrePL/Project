<?php
    require_once "conf.php";
        
    $pass = $_POST["new_password"];
    $passCheck = $_POST["con_password"];
        $if_pass_set = isset($pass);

    $mail = $_POST["email_adress"];
        $if_mail_set = isset($mail);
    $phone = $_POST["telephone_number"];
        $if_phone_set = isset($phone);
    $discord = $_POST["discord_user"];
        $if_discord_set = isset($discord);

    //7 morbillion variables because im too lazy to type isset($variable) in every statement :skull:

    $mail_flag = isset($_POST["email_flag"]);

    //!!!!!!!!!! HARDCODING EVERY CHANGE YYYYYEEEAAAAAAAAHHHHH WOOOHOOOOO!!!!
    //? check if thing set 
    //? if yes, put into array of vars
    //? don forget to add corresponding column
    //? throw one big update statement at the end
    //? @Piwkom: i can do this, but im just too fucking lazy :D 

    if($if_pass_set && ($pass === $passCheck)){
        $sql = "UPDATE `users` SET `password` = $pass WHERE `uuid` = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        echo $result;
    }
    
    if($if_mail_set) {
        change_email($conn,$_SESSION["uid"],$mail);
    }

    if($if_phone_set && validate_phone($phone)){
        //? is this correct?
        set_phone($conn,$_SESSION["uid"],$phone);
    }

    if($if_discord_set){
        set_discord($conn,$_SESSION["uid"],$discord);     
    }
    
    if($mail_flag){
        $sql = "UPDATE `users` SET `email-flag` = 1 WHERE `uuid` = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        echo $result;
    }


?>
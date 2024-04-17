<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

require_once "$abspath\conf\config.php";
require_once "$abspath\classes\AccountManager.php";
require_once "$abspath\classes\SendMail.php";

$am = new AccountManager($conn);



if(isset($_POST["token"])){
    if(!isset($_POST["password"]) and !isset($_POST["confirm_password"])){
        header("Location: ../src/reset-my-password.php?token=$token&m=pwd-empty");
    }
    if($_POST["password"] != $_POST["confirm_password"]){
        header("Location: ../src/reset-my-password.php?token=$token&m=pwd-diffrent");
    }
    // if(!preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{5,}$", $_POST["password"])){
    //     header("Location: ../src/reset-my-password.php?token=$token&m=pwd-invalid");
    // }
    $tk_uid = $am->get_id_by_password_reset_token($_POST["token"]);
    $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    if ($am->set_password_by_uid($new_password, $tk_uid)) {
        header("Location: ../src/access.php?m=pwd-change-success");
        exit();
    } else {
        header("Location: ../src/access.php?m=pwd-change-failed");
    }
    exit();
}
if(!isset($_POST["email"])){
    header("Location: ..\index.php");
    exit();
}
$sm = new SendMail($_POST["email"]);
$uid = $am->get_user_id_by_email($_POST["email"]);

if(!isset($uid)){
    header("Location: ..\src\access.php?m=pwdreset-notexist");
    exit();
}

$sql = "SELECT `user-uuid` FROM `password-reset-tokens` WHERE `user-uuid` = ?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $uid);
$stmt->execute();
$result = $stmt->get_result(); 
$data = $result->fetch_assoc(); 

if(!isset($data["token"])){
    $token = sha1(mt_rand()); // hashing is used to generate more random looking token, NOT for security
    $sql = "INSERT INTO `password-reset-tokens` (`user-uuid`, `token`) VALUES (?, ?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $uid, $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if ($sm->send_reset_password(PASSWORD_RESET_PAGE_URL . "?token=$token")){
        header("Location:  ../src/reset-my-password.php?m=link-sent");
    } else {
        header("Location:  ../src/reset-my-password.php?m=link-error-occured");
    }
    
} //!not finished yet



?>
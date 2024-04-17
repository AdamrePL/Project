<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
if(!isset($_POST["email"])){
    header("Location: ..\index.php");
}

require_once "$abspath\conf\config.php";
require_once "$abspath\classes\AccountManager.php";
require_once "$abspath\classes\SendMail.php";

$am = new AccountManager($conn);
$sm = new SendMail($_POST["email"]);
echo $sm->remind_user_id($am->get_user_id_by_email($_POST["email"]));
header("Location: ..\index.php?m=remind-sent");
?>

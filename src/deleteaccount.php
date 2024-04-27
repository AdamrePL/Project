<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

require_once $abspath . "conf/config.php";
require_once $abspath . "classes\AccountManager.php";

if(!isset($_POST["uid"]) or !isset($_POST["uid"])){
    header("Location: /?m=error");
    exit(403);
}

if($_SESSION["uid"] != $_POST["uid"]){
    header("Location:/?m=error");
    exit(403);
}

$acm = new AccountManager($conn);
$acm->delete_user($_SESSION["uid"]);
session_destroy();
header("Location: /?m=deletionsuccess");
exit(200);
?>
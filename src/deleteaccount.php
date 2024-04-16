<?php
if(isset($_POST["uid"]));

if($_SESSION["uid"] != $_POST["uid"]){
    header("Location: / ");
    exit(403);
}

$acm = new AccountManager($conn);
$acm->delete_user($uid);
header("Location: index.php?m=deletionsuccess");
exit(200);
?>
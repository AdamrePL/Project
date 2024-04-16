<?php
require_once "../classes/SendMail.php";
$send_mail = new SendMail("dikessdikes@gmail.com");
$send_mail->remind_user_id("superuser#ko2");
?>
<?php

if (isset($_POST["offer-id"])) {
    require_once "conf/config.php"; 

    $query = $conn->query("SELECT `user-uuid` FROM `offers` WHERE id = " . $conn->real_escape_string(htmlentities($_POST["offer-id"])));
    $result = $query->fetch_assoc();
    $uid = $result["user-uuid"];
    $sql = "SELECT `phone`, `email`, `discord` FROM `users` WHERE uuid = '$uid'";
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();

    $arr = array("phone"=>$result["phone"], "email"=>base64_decode(convert_uudecode($result["email"])), "discord"=>$result["discord"]);

    echo json_encode($arr, JSON_PRETTY_PRINT);
}

?>

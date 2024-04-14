<?php

if (isset($_POST["offer-id"])) {
    require_once "../conf/config.php"; 

    $query = $conn->query("SELECT `phone`, `email`, `discord` FROM `offers` WHERE id = " . $conn->real_escape_string(htmlentities($_POST["offer-id"])));
    $result = $query->fetch_assoc();

    $email = is_null($result["email"]) || empty($result["email"]) ? "" : base64_decode(convert_uudecode($result["email"]));
    
    $arr = array("phone"=>$result["phone"], "email"=>$email, "discord"=>$result["discord"]);

    echo json_encode($arr, JSON_PRETTY_PRINT);
}

?>

<?php
if (isset($_POST["offer-id"])) {
    require_once "conf/config.php"; 
    require_once $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"]."classes/Offer.php";

    $query = $conn->query("SELECT `user-uuid` FROM `offers` WHERE id = " . $conn->real_escape_string(htmlentities($_POST["offer-id"])));
    $result = $query->fetch_assoc();
    $uid = $result["user-uuid"];
    $sql = "SELECT `phone`, `email`, `discord` FROM `users` WHERE uuid = '$uid'";
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();

    echo json_encode($result, JSON_PRETTY_PRINT);

    // What's this for? - @AdamrePL
    // if you want to load data dynamicaly using javascript from a database, I recommend checking out XMLHttpRequest() (in other words AJAX) and our code https://github.com/AdamrePL/Project/blob/forms-styling/assets/js/profile-controller.js
}
?>

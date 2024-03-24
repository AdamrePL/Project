<?php 
include "../conf/config.php";

if (!isset($_SESSION["uid"])) {
    header('HTTP/1.1 403 Forbidden');
    exit(403);
}

if (isset($_POST["show-uid"]) && $_POST["show-uid"] == "ok") {
    echo $_SESSION["uid"];
}
?>
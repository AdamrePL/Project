<?php 
include "../conf/config.php";

if (!isset($_SESSION["uid"])) {
    header('HTTP/1.1 403 Forbidden');
    header("Location: " . $_SERVER["BASE"]);
    exit(403);
}
else if (isset($_POST["show-uid"]) && $_POST["show-uid"] == "ok") {
    echo $_SESSION["uid"];
}
?>
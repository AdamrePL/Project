<?php
    require_once "../conf/config.php";

    session_unset();
    session_destroy();

    header("Location: /");
?>
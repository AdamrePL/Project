<?php
    define('SERVER', 'localhost');
    define('USER', 'root');
    define('PWD', '');
    define('DB', 'gielda');

    $conn = mysqli_connect(SERVER, USER, PWD, DB);

    session_start();
?>
<?php
    define('SERVER', 'localhost');
    define('USER', 'root');
    define('PWD', '');
    define('DB', 'gielda');
    
    $conn = mysqli_connect(SERVER, USER, PWD, DB);

    session_set_cookie_params(0);
    session_start();
    
    define("SITENAME", "Giełda");
?>
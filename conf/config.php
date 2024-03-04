<?php
    define('SERVER', 'localhost');
    define('USER', 'root');
    define('PWD', '');
    define('DB', 'gielda');

    // * Użytkownik dla sprzedawcy
    // define('SERVER', 'localhost');
    // define('USER', 'usr_sprzedawca');
    // define('PWD', ']g7m5]6ATT0cA3AK');
    // define('DB', 'gielda');

    // * Użytkownik dla przeglądającego
    // define('SERVER', 'localhost');
    // define('USER', 'usr_gosc');
    // define('PWD', '35LowoAn@nrpf8xu');
    // define('DB', 'gielda');

    // * Użytkownik dla admina
    // define('SERVER', 'localhost');
    // define('USER', 'usr_administrator');
    // define('PWD', 'N.(XocP!r0B*qseB');
    // define('DB', 'gielda');
    
    $conn = mysqli_connect(SERVER, USER, PWD, DB);

    session_start();
?>
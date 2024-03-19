<?php
    #region Database Connection
    define('SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PWD', '');
    define('DB', 'gielda');

    try {
        $conn = mysqli_connect(SERVER, DB_USER, DB_PWD, DB);
    } catch (Exception $err) {
        echo "Error code: " . mysqli_connect_errno() . " - Failed to connect to MySQL: " . mysqli_connect_error();
        echo "<font color='crimson'>\nW przypadku wystąpienia tego błedu, proszę powiadomić administratora strony!</font>";
    }

    #endregion Database Connection
    
    #region Session Settings

    /**
     * Sets session expiration (probably, got to read more about it I guess?) to 1 hour / 5400 is one and a half hour
     * * If you want to change the time, the param takes time in SECONDS
     * & In case you don't know how this timeout works, because I also forgot while im typing this, then check out 
     * @link https://www.php.net/manual/en/ref.session.php
    */
    session_set_cookie_params(3600);
    session_start();
    
    #endregion Session Settings
    
    #region Constants

    define("SITENAME", "Giełda");

    #endregion Constants
    
?>
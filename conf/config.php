<?php
    #region Database Connection
    define('SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PWD', '');
    define('DB', 'gielda');

    /**
     * ! The constants above will be removed when we're done with project
     * ! Database credentials will be taken from a configuration file outside of the project's folder once on a school server
     * ! But we'll still be performing database connection through this file the same way, just with different way of setting information due to security reasons.
     *
     * * Check link below for details
     * @link https://docs.php.earth/security/configuration/#formats
     * 
     * And unfortunately because of that we'll probably also have to change the file structure a bit
     * @link https://docs.php.earth/security/intro/#public-files
    */ 

    try {
        $conn = new mysqli(SERVER, DB_USER, DB_PWD, DB);
    } catch (Exception $err) {
        $conn_err = "Error code: " . mysqli_connect_errno() . " - Failed to connect to MySQL: " . mysqli_connect_error();
        $conn_err .= "<font color='crimson'>\nW przypadku wystąpienia tego błedu, proszę powiadomić administratora strony!</font>";
        header('HTTP/1.1 500 Internal Server Error', true, 500);
        exit($conn_err . " SERVER RESPONDED WITH HTTP STATUS CODE: " . http_response_code());
    }

    #endregion Database Connection
    
    #region General Settings
    
    // & Link for the 2 following settings: https://docs.php.earth/security/intro/#remote-files
    // ini_set("allow_url_fopen", 0); # Ughhh, this has to be set in php.ini that's default one. No, we can not create ours, I tried. - allow_url_fopen = off
    // * There's also ini_set("allow_url_include", 0), but if the one above is set, then this one's not required - still would be coll to be set in case of future changes in PHP versions to avoid errors/incompatibility or sum idk.
    // ini_set("expose_php", 0); # expose_php = off - in php.ini

    // ! Turn this on when we're done with developement - when the site is ready to be published
    // error_reporting(0); # Equal to display_errors = off - in php.ini

    // & Link for the explanation and source of the following if statement - https://docs.php.earth/security/intro/#session-settings
    if (ini_get("session.use_only_cookies") !== 1) {
        ini_set("session.use_only_cookies", 1);
    }
    if (ini_get("session.use_trans_sid") !== 0) {
        ini_set("session.use_trans_sid", 0);
    }
    // & The other settings are set in `Session Settings`.. atleast for now.

    /**
     * We've got what we need, I think so I ain't adding more - @AdamrePL
     * you do you 
     * 
     * & General:
     * https://www.php.net/manual/en/ini.list.php
     * 
     * ! Uhh, and this link may actually contain everything we'd be interested in - I think.. anyway: 
     * https://cheatsheetseries.owasp.org/cheatsheets/PHP_Configuration_Cheat_Sheet.html
     * Todo @AdamrePL Check this, for now im too tired/lazy to do so.
     * 
     * & Session Related:
     * https://www.php.net/manual/en/session.security.ini.php
     * https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-samesite
    */

    #endregion General Settings

    #region Session Settings

    /**
     * Sets session expiration (probably, got to read more about it I guess?) to 1 hour / 5400 is one and a half hour
     * * If you want to change the time, the param takes time in SECONDS
     * & In case you don't know how this timeout works, because I also forgot while im typing this, then check out 
     * @link https://www.php.net/manual/en/ref.session.php
    */
    session_set_cookie_params(3600 / 2, $_SERVER["BASE"], "localhost", true, true); # 1 Godz / 2, zostawcie default na 1 godzine i po prostu matmy używajcie, np 3600 * 1.5 = 1godz 30min
    session_start();

    // print_r( session_get_cookie_params() );
    // print_r( $_SESSION );
    
    #endregion Session Settings
    
    #region Constants

    define("SITENAME", "Giełda");

    //E-mail credentials:
    define("SITE_EMAIL_ADDRESS", "##############");  // !     REPLACE WITH YOUR EMAIL -
    define("SITE_EMAIL_PASSWORD", "##############"); // !     - AND PASSWORD FOR IT TO WORK
    define("SITE_EMAIL_HOST", "smtp.gmail.com");
    define("SITE_EMAIL_PORT", 465);
    define("SITE_EMAIL_NAME", "Giełda Podręczników");

    

    #endregion Constants
    
?>

<?php

function get_user_password(mysqli $conn, $uid): string {
    require_once $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"]."classes/AccountManager.php";
    $idk = new AccountManager($conn);
    return $idk->get_user_password($uid);
}

/**
 * @param mysqli $conn
 * A database connection returned by mysqli_connect() or mysqli_init(). 
 * Połączenie z bazą danych wzrócone przez mysqli_connect() lub mysqli_init().
 * @param string $name
 * Username, not person's name.
 * @param string $email
 * Not yet hashed, verified email adress
 * @param string $password (Optional)
 * Not yet hashed password. Set to an empty string by default.
 * 
 * @return string returns user's uid if user is successfuly added to a database table. You can also say it returns true.
 * @return false on mysql_stmt_prepare() error.
*/
function create_user(mysqli $conn, string $name, string $email, string $password = ""): string|false {
    $uid = generate_id($name);
    $idk = new AccountManager($conn);
    while ($idk->user_exists($conn, $uid)) {
        $uid = generate_id($name);
    }

    $hashed_email = convert_uuencode(base64_encode($email));

    $stmt = $conn->stmt_init();
    if (!empty($password) || $password != "") {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        
        // $sql = "INSERT INTO `users` VALUES(?, ?, ?, '', '', ?, '', '', '', '');";
        $sql = "INSERT INTO `users`(`uuid`,`username`, `password` , `email`) VALUES(?, ?, ?, ?);";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }
        $stmt->bind_param("ssss", $uid, $name, $hashed_pass, $hashed_email);
    } else {
        // $sql = "INSERT INTO `users` VALUES(?, ?, '', '', '', ?, '', '', '', '');";
        $sql = "INSERT INTO `users`(`uuid`,`username`,`email`) VALUES(?, ?, ?);";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }
        $stmt->bind_param("sss", $uid, $name, $hashed_email);
    }
    
    $stmt->execute();
    $stmt->close();

    return $uid;
}

function generate_id(string $name): string {
    require_once $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"]."classes/AccountManager.php";
    $gen = new AccountManager($conn);
    return $gen->generate_uid($name);
}



// PHONE NR REGEX: /\d{3}[-\s]?\d{3}[-\s]?\d{3}/
// EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
// FILE EXT REGEX: ^\w+\.(gif|png|jpg|jpeg)$

// uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$
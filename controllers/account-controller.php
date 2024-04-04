<?php

function user_exists(mysqli $conn, $uid): bool {
    $sql = "SELECT * FROM `users` WHERE uuid = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return mysqli_num_rows($result) > 0;
}

function get_user_password(mysqli $conn, $uid): string {
    $sql = "SELECT `password` FROM `users` WHERE uuid = ? LIMIT 1;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row["password"];
}

function update_last_login(mysqli $conn, string $uid) {
    $sql = "UPDATE `users` SET `last-login` = NOW() WHERE uuid = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
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
function create_user(mysqli $conn, string $name, string $email, string $password = ""): mixed {
    $uid = generate_id($name);
    while (user_exists($conn, $uid)) {
        $uid = generate_id($name);
    }

    $hashed_email = convert_uuencode(base64_encode($email));

    $stmt = mysqli_stmt_init($conn);
    if (!empty($password) || $password != "") {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        
        // $sql = "INSERT INTO `users` VALUES(?, ?, ?, '', '', ?, '', '', '', '');";
        $sql = "INSERT INTO `users`(`uuid`,`username`, `password` , `email`) VALUES(?, ?, ?, ?);";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, "ssss", $uid, $name, $hashed_pass, $hashed_email);
    } else {
        // $sql = "INSERT INTO `users` VALUES(?, ?, '', '', '', ?, '', '', '', '');";
        $sql = "INSERT INTO `users`(`uuid`,`username`,`email`) VALUES(?, ?, ?);";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, "sss", $uid, $name, $hashed_email);
    }
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $uid;
}


/**
 * @param string $name Username, not person's name.
 * 
 * @return string
 * Returns Unique User Identifier.
 * Sets username to lowercase and concatenates with '#' and 3 randomly generated characters.
 * 
 * Characters are taken from defined within a function - list of specific ASCII characters.
 */
// Generates random string of 3 characters from specific ASCII characters.
function generate_id(string $name): string {
    /**
     * @var array Contains digits 0-9, uppercase and lowercase english alphabet.
    */
    
    // $chars = [];
    // for ($i=65; $i < 90; $i++) { 
    //     array_push($chars, chr($i));
    // } 
    // for ($i=97; $i < 122; $i++) { 
    //     array_push($chars, chr($i));
    // } 
    // for ($i=0; $i < 9; $i++) { 
    //     array_push($chars, $i);
    // }

    // return strtolower($name) . "#" . array_rand($chars, 3);
    require_once "../src/classes/IDGenerator.php";
    $idgenerator = new IDGenerator(3, $name);
    return $idgenerator->generate_ID();
}



// PHONE NR REGEX: /\d{3}[-\s]?\d{3}[-\s]?\d{3}/
// EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
// FILE EXT REGEX: ^\w+\.(gif|png|jpg|jpeg)$

// uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$
<?php
class Account
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function user_exists($uid): bool
    {
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE uuid = ?");
        $stmt->bind_param('s',$uid);
        $stmt->execute();
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return mysqli_num_rows($result) > 0;
    }

    public function get_user_password($uid): string
    {
        $sql = "SELECT `password` FROM `users` WHERE uuid = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($this->conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row["password"];
    }

    public function update_last_login(string $uid)
    {
        $sql = "UPDATE `users` SET `last-login` = NOW() WHERE uuid = ?";
        $stmt = mysqli_stmt_init($this->conn);
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
    public function create_user(string $name, string $email, string $password = ""): mixed
    {
        $uid = self::generate_id($name);
        while (self::user_exists($uid)) {
            $uid = self::generate_id($name);
        }

        $hashed_email = convert_uuencode(base64_encode($email));

        $stmt = mysqli_stmt_init($this->conn);
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

    //! call after SOMETHING(???) in profile.php/profile-controller happens
    //probably like a checkbox with confirmation or sth
    /**
     * @param string $uid users uuid
     * @return void well the function has nothing to return, so it voids.
     */
    public function delete_user(string $uid): void
    {
        $sql = "DELETE FROM `users` WHERE uuid = ?";
        $stmt = mysqli_stmt_init($this->conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    /**
     * @param int $number phone number wheter with spaces or without
     * 
     * @return true returns true if phone number form is correct.
     * @return false returns false if phone number doesn't match format.
     */
    public function validate_phone(int $number): bool
    {
        if (!preg_match("/\d{3}[-\s]?\d{3}[-\s]?\d{3}/", $number)) {
            return false;
        }
        return true;
    }

    public function set_phone(string $uid, int $nr): void
    {
        $stmt = mysqli_stmt_init($this->conn);
        $sql = "UPDATE `users` SET `phone`= ? WHERE uuid = $uid;";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $nr);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function set_discord(string $uid, string $discord_id)
    {
        $stmt = mysqli_stmt_init($this->conn);
        $sql = "UPDATE `users` SET `discord`= ? WHERE uuid = $uid;";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $discord_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function change_email(string $uid, string $email)
    {
        $hashed_email = convert_uuencode(base64_encode($email));
        $stmt = mysqli_stmt_init($this->conn);
        $sql = "UPDATE `users` SET `email`= ? WHERE uuid = $uid;";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $hashed_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
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
    public function generate_id(string $name): string
    {
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
        $idgenerator = new IDGenerator(3, true, $name);
        return $idgenerator->generate_ID();
    }



    // PHONE NR REGEX: /\d{3}[-\s]?\d{3}[-\s]?\d{3}/
    // EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
    // FILE EXT REGEX: ^\w+\.(gif|png|jpg|jpeg)$

    // uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$
}

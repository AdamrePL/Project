<?php require_once "../conf/config.php"; ?>
<?php 
if (!isset($_SESSION["uid"])) {
    header("Location: /");
}

?>
<head>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <script src="../assets/js/profile-controller.js" defer></script>
</head>

<body>
<?php
    if (!isset($_GET["page"])) {
        $_GET["page"]="profile";
    }
    
    switch ($_GET["page"]) {
        case "settings":
            echo '<a class="return-btn" href="profile.php">&NestedLessLess; Powrót</a>

            <div class="user-settings-wrapper">
                <h1>User Settings</h1>
            
                <form action="../controllers/profile-controller.php" method="post">
                    <label for="new_password">nowe hasło</label>
                    <input type="text" name="new_password" placeholder="new password" />
                    <input type="submit" value="ustaw nowe hasło" name="set-new-password" />
                </form>

                <form action="../controllers/profile-controller.php">
                    <label for="con_password">potwierdź hasło</label>
                    <input type="text" name="nowe hasło" placeholder="potwierdź hasło" />
            
                    <label for="email_adress">podaj email</label>
                    <input type="email" name="email_adress" placeholder="email" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$"/>
            
                    <label for="phone_number">enter phone number</label>
                    <input type="tel" name="phone_number" placeholder="podaj numer" pattern="\d{3}[-\s]?\d{3}[-\s]?\d{3}" minlength="9"/> <!-- inputmode="numeric" -->
                    
                    <label for="discord_user">podaj nazwe użytkownika discord-a</label>
                    <input type="text" name="discord_user" placeholder="podaj nazwe użytkownika discord-a" />
            
                    <label for="email_flag">Użyć emaila do automatycznego wypełniania formy kontaktu?</label>
                    <input type="checkbox" name="email_flag" />
            
                    <span>
                        <button type="submit" id="confirm" name="save">Zapisz</button>
                        <button type="reset" id="reset" name="remove-all-contacts">Usuń formy kontaktu</button>
                    </span>
                </form>


            </div>';
            echo '<div>
                <form method="post" action="../controllers/profile-controller.php">
                    <input class="" type="submit" name="remove-account" value="Usuń konto" />
                </form>
            </div>';

            //* EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
            //? uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$
        break;

        default:
            echo '<section id="user-details">';
                $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uuid = '" . $_SESSION["uid"] . "'");
                $result = mysqli_fetch_assoc($query);
            echo '
                <div class="user">
                    <h3>'. $result["username"] .'</h3>
                    <div class="user-id">
                        <span class="uid"></span>
                    </div>
                </div>
                ';
                
                echo '<div class="contact">';
                    echo '<p>';
                    echo !empty($result["phone"]) ? $result["phone"] : "Nr tel.";
                    echo '</p>';
                    echo '<p><span>'. base64_decode(convert_uudecode($result["email"])) .'</span><input type="checkbox" name="" id="" /></p>';
                    echo '<p><i class="fa-brands fa-discord"></i>'. !empty($result["discord"]) ? $result["discord"] : "Discord";
                    echo '</p><a href="?page=settings"><button>Edytuj</button></a>';
                echo '</div>';
            echo '</section>';
            
            $selection_sql = "SELECT * FROM `offers` WHERE `user-uuid` = '" . $_SESSION["uid"] . "'";
            $selection_query = mysqli_query($conn,$selection_sql);
            if(empty(mysqli_fetch_assoc($selection_query))){
                echo '<span class="no-offers">Nie stworzyłeś żadnej oferty! Chciałbyś to zmienić? <a href="../src/createoffer.php">Stwórz ofertę</a></span>';
            } else {
                echo '<section class="user-offers">';

                for($i = 0;$i<10;$i++){
                    echo '<div class="offer"></div>';
                }
                    
                    //added a bunch of divs on top for scłolbał
                    $sql = "SELECT * FROM `offers` WHERE `user-uuid` = '" . $_SESSION["uid"] . "'";
                    $query = mysqli_query($conn,$sql);

                    while ($result = mysqli_fetch_assoc($query)) {
                        echo '<div class="offer">'; 

                        //& copied selector from index ( ,,,= w =,,, )
                        // real shit tho gotta align these mfs properly :muscle:

                        $prod = explode(",", $result["products"]); // i've got no idea what this does, but it's working so yippee
                        if (count($prod) > 1) {
                            echo '<p>Pakiet</p>';
                            echo '<details>';
                            echo '<summary>Pakiet zawiera</summary>';
                            for ($i = 0; $i < count($prod); $i++) {
                                $sql2 = "SELECT * FROM `products` WHERE `products`.`id` = $prod[$i]";
                                $query2 = mysqli_query($conn, $sql2);
                                $result2 = mysqli_fetch_assoc($query2);

                                echo $result2["name"] . '<br>';
                            }
                            echo '</details>';

                        } else {
                            $sql2 = "SELECT * FROM `products` WHERE `products`.`id` = $prod[0]";
                            $query2 = mysqli_query($conn, $sql2);
                            $result2 = mysqli_fetch_assoc($query2);

                            echo $result2["name"];
                        }
                        
                        echo '<details>';
                            echo '<summary>Dane kontaktowe</summary>';
                            echo $result["phone"];
                            echo $result["email"];
                            echo $result["discord"];
                        echo '</details>';
                        
                        echo '<span class="offer-date">';
                        echo '<span>Oferta wygasa: ' . $result["offer-edate"] . '</span>';
                        echo '</span>'; 
                        
                        echo '</div>';    
                    }
                    // while($selection_result = $selection_array){ // this CANT be right :sob: //&update: this was, in fact, NOT right
                    //     echo '<div class="offer">' .$selection_result["id"]. '</div>';    
                    // }

                        // $lol = "SELECT COUNT(*) FROM `offers`,`users` WHERE `offers.user-uuid` = `users.uuid`;";
                        // $DisOf = mysqli_query($conn, $lol);
                        // $whynowork = mysqli_query($conn,"SELECT COUNT(*) FROM `users`,`offers` WHERE `users.uuid`=`offers.user-uuid`;");
                        //nah cause why the fuck arent you working lil bro this is just insane at this point
                            // $whynowork = mysqli_query($conn,"SELECT * FROM `users`;");
                            // echo $whynowork;
                        // $sql = mysqli_query($conn,"SELECT `user-offers` FROM `users` WHERE uuid = '". $_SESSION["uid"] ."';");
                        // echo count(explode(",", mysqli_fetch_array($sql)["user-offers"]));
                        // $_SESSION["uid"] = "tester#aA1";
                        // $sql = "SELECT offers.*, users.username, users.uuid FROM `offers`, `users` WHERE 'offers.user-uuid'='users.uuid' AND users.uuid = " . $_SESSION["uid"] . ";";
                        // $query = mysqli_query($conn, $sql);
                        // while ($result = mysqli_fetch_assoc($query)) {
                        //     echo '<div>' . $result["products"] . '<br>' . $result["offer-cdate"] . '</div>';
                        // }
                echo '</section>';
            }

            if (isset($_SESSION["first-login"]) && ($_SESSION["first-login"] > 0)) {
                if ($_SESSION["first-login"] > 2) {
                    $message = 'Ta wiadomość pokaże się jeszcze '. $_SESSION["first-login"] .' razy po odświeżeniu strony lub po ponownym wejsciu na profil';
                } else if ($_SESSION["first-login"] > 1) {
                    $message = 'Ta wiadomość pokaże się po raz ostatni po odświeżeniu strony lub po ponownym wejsciu na profil';
                } else {
                    $message = 'Ta wiadomość się już nie pokaże po odświeżeniu strony lub po ponownym wejsciu na profil';
                }
                $_SESSION["first-login"] = $_SESSION["first-login"] - 1;
                echo '
                    <div class="overlay">
                        <script src="../assets/js/script.js" defer></script>
                        <div class="overlay-wrapper">
                            Twoje uid: '. $_SESSION["uid"] .'. Zapisz, lub zapamiętaj swoje uid ponieważ służy ono do logowania się na konto! ' . $message . '
                        </div>
                        <p class="overlay-msg">Click anywhere outside of the box to close</p>
                    </div>
                ';
            }

        break;
    }
?>
</body>

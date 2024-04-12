<?php 
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once "$abspath\conf\config.php"; ?>

if (!isset($_SESSION["uid"])) {
    header("Location: /");
}
?>

<!-- <h2>Last login: <?php // date("H:i, d.m.Y", strtotime($row['last-login'])); ?></h2>
<h2>Joined: <?php //date("d.m.Y", strtotime($row['join-date'])); ?></h2> -->

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
        // W ustawieniach profilu oraz tworzeniu ofert, zabezpieczyć aby osoba nie mogła podawać linków do stron, np. discord.gg/discord.com, oraz zadnych zaproszen na serwery oraz nieodpowiednich stron
        // ^ może to być zrobione REGEX'em 
        // dodatkowo zabezpieczyc te pola z htmlspecialchars po stronie php'a przy dodawaniu/wyciaganiu z bazy danych (? chyba jak dobrze pamietam), aby zabezpieczyć strone przed XSS i Javascript/html/css injection
        case "settings":
            echo '<a class="return-btn" href="profile.php">&NestedLessLess; Powrót</a>

            <div class="user-settings-wrapper">
                <h1>User Settings</h1>
            
                <form action="../controllers/profile-controller.php" method="post">
                    <label for="new_password">nowe hasło</label>
                    <input type="text" name="new_password" placeholder="new password" />
                    <label for="password">potwierdź hasło</label>
                    <input type="text" name="nowe hasło" placeholder="potwierdź hasło" />
                    <input type="submit" value="ustaw nowe hasło" name="set-new-password" />
                </form>

                <form action="../controllers/profile-controller.php">
                    <label for="email_adress">podaj email</label>
                    <input type="email" name="email_adress" placeholder="email" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$"/>
                    <br>
                    <label for="phone_number">podaj nr. telefonu</label>
                    <input type="tel" name="phone_number" placeholder="podaj numer" pattern="\d{3}[-\s]?\d{3}[-\s]?\d{3}" minlength="9"/> <!-- inputmode="numeric" -->
                    <br>
                    <label for="discord_user">podaj nazwe użytkownika discord-a</label>
                    <input type="text" id="discord_user" name="discord_user" placeholder="podaj nazwe użytkownika discord-a" />
            
                    <label for="email_flag">Użyć emaila do automatycznego wypełniania formy kontaktu?</label>
            
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

            //* EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" ||| slower but more precise: "^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$"
        break;

        default:
            echo '<section id="user-details">';
                $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uuid = '" . $_SESSION["uid"] . "'");
                $result = mysqli_fetch_assoc($query);
            echo '
                <div class="user">
                    <h3>'. $result["username"] .'</h3>
                    <div class="user-id">
                        <span class="uid" data-content="click to show uid"></span>
                    </div>
                </div>
                ';
                
                //& 20.03 sorry for fucking up `contact` layout, will fix !!! (hopefully)
                //! Man you did not ruin it as there was no layout, although you did in fact fuck up how the buttons look, CSS STYLING and NAMING ELEMENTS
                echo '<div class="contact">';
                    echo '<p>'. (!empty($result["phone"]) ? $result["phone"] : "Nr tel.") .'</p>';
                    echo '<p>'. base64_decode(convert_uudecode($result["email"])) .'</p>';
                    echo '<p><i class="fa-brands fa-discord"></i>'. (!empty($result["discord"]) ? $result["discord"] : "Discord") . '</p>';
                echo '</div>';
                
                echo '<span>';
                echo '<a href="?page=settings" name="user_edit">Zmień Ustawienia</a>';
                echo '<a href="../controllers/logout.php" name="logout">Wyloguj</a>';
                echo '<a href="../src/createoffer.php?row=1">Stwórz ofertę</a>';
                echo '</span>';

            echo '</section>';
            
            $selection_sql = "SELECT * FROM `offers` WHERE `user-uuid` = '" . $_SESSION["uid"] . "'";
            $selection_query = mysqli_query($conn,$selection_sql);

            if(empty(mysqli_fetch_assoc($selection_query))){
                echo '<span class="no-offers">Nie stworzyłeś żadnej oferty! Chciałbyś to zmienić? <a href="../src/createoffer.php?row=1">Stwórz ofertę</a></span>';
            } else {
                
                require_once "$abspath\classes\Offer.php";
                $offers = new Oferty($conn);
                $offers->PrintAll(FALSE);
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

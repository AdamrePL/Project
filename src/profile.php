<?php 
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once "$abspath\conf\config.php";
if (!isset($_SESSION["uid"])){
    header("Location: access.php");
}
 ?>


<!-- <h2>Last login: <?php // date("H:i, d.m.Y", strtotime($row['last-login'])); ?></h2>
<h2>Joined: <?php //date("d.m.Y", strtotime($row['join-date'])); ?></h2> -->

<head>
    <title><?php echo SITENAME?> Twój Profil</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="../assets/js/profile-controller.js" defer></script>
</head>

<body>
    <div class="page-wrapper">
    <div class="content-wrap">
    
<?php
    if (!isset($_GET["page"])) {
        $_GET["page"]="profile";
    }
    
    switch ($_GET["page"]) {


        //! W ustawieniach profilu oraz tworzeniu ofert, zabezpieczyć aby osoba nie mogła podawać linków do stron, np. discord.gg/discord.com, oraz zadnych zaproszen na serwery oraz nieodpowiednich stron
        // ^ może to być zrobione REGEX'em 
        // dodatkowo zabezpieczyc te pola z htmlspecialchars po stronie php'a przy dodawaniu/wyciaganiu z bazy danych (? chyba jak dobrze pamietam), aby zabezpieczyć strone przed XSS i Javascript/html/css injection
        
        case "settings":
            include "navbar.php";
            echo '

            <div class="user-settings-wrapper">
                <h3>Ustawienia użytkownika</h3>


            </div>';

            
            echo '<div> 
                    <form method="post" action="deleteaccount.php">
                        <input type="hidden" name="uid" value="'.$_SESSION["uid"].'">
                            <input class="" id = "input-delete-account" type="submit" name="remove-account" value="Usuń konto" />
                        </form>
                    </div>';
                //* EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" ||| slower but more precise: "^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$"
            break;

        default:
        include "navbar.php";
            echo '<section id="user-details">';

                echo '<span id = "setting-link"><a href="?page=settings" name="user_edit">Ustawienia konta </a></span>';
                echo '<span id = "setting-link"><a href="../controllers/logout.php" name="logout">Wyloguj się</a></span>';

                $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uuid = '" . $_SESSION["uid"] . "'");
                $result = mysqli_fetch_assoc($query);
            // echo '
            //     <div class="user">
            //         <h3>'. $result["username"] .'</h3>
            //         <div class="user-id">
            //             <span class="uid" data-content="Kliknij, aby wyśwsietlić ID"></span>
            //         </div>
            //     </div>
            //     ';
                
                //& 20.03 sorry for fucking up `contact` layout, will fix !!! (hopefully)
                //! Man you did not ruin it as there was no layout, although you did in fact fuck up how the buttons look, CSS STYLING and NAMING ELEMENTS
                // echo '<div class="contact">';
                //     echo '<p>'. (!empty($result["phone"]) ? $result["phone"] : "Nr tel.") .'</p>';
                //     echo '<p>'. base64_decode(convert_uudecode($result["email"])) .'</p>';
                //     echo '<p><i class="fa-brands fa-discord"></i>'. (!empty($result["discord"]) ? $result["discord"] : "Discord") . '</p>';
                // echo '</div>';
                
                // echo '<span>';
                // echo '<a href="?page=settings" name="user_edit">Zmień Ustawienia</a>';
                // echo '<a href="../controllers/logout.php" name="logout">Wyloguj</a>';
                // echo '<a href="../src/createoffer.php">Stwórz ofertę</a>';
                // echo '</span>';

            echo '</section>';
            
            $selection_sql = "SELECT * FROM `offers` WHERE `user-uuid` = '" . $_SESSION["uid"] . "'";
            $selection_query = mysqli_query($conn,$selection_sql);


            $count =  "SELECT COUNT(*) as `q` FROM `offers` WHERE `user-uuid` = '" . $_SESSION["uid"] . "'";
            $count_query = mysqli_query($conn, $count);
            $result = mysqli_fetch_assoc($count_query);            


            if(empty(mysqli_fetch_assoc($selection_query))){
                echo '<span class="no-offers">Nie stworzyłeś żadnej oferty! Chciałbyś to zmienić? <a href="../src/createoffer.php">Stwórz ofertę</a></span>';
            } 
            else {
                
                require_once "$abspath\classes\Offer.php";
                echo "<h1>Twoje oferty [<a href=\"../src/createoffer.php\">Dodaj</a>]</h1>";
                $offers = new Offer($conn, "../");
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
                $_SESSION["first-login"] = $_SESSION["first-login"] ; //why?    
                echo '
                    <div class="overlay">
                        <script src="../assets/js/script.js" defer></script>
                        <div class="overlay-id">
                            Twoje ID: <span id = "overlay-uid">'. $_SESSION["uid"] . '</span><button onclick = "copyUID()"><i class="fa-solid fa-copy"></i></button>
                            <div class="tooltip" id ="info-copy">Skopiowano ID</div>
                        </div>
                        <div class = "overlay-msg">'.$message.'</div>
                        <p class="overlay-msg">Kliknij gdziekolwiek poza wiadomość, by ją zamknąć.</p>
                    </div>
                ';
            }

        break;
    }
?>
</div>
<?php
    include_once "footer.php";
?>
</div>
</body>

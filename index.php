<?php require_once "conf/config.php"; ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="author" content="AdamrePL, Brouwar"> -->
    <meta name="keywords" content="giełda książek,giełda">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- <link rel="favicon" type="png/image" href="icon.ico"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <title><?php echo SITENAME; ?> Książkowa</title>

    <noscript>
        <meta http-equiv="refresh" content="0; url=src/noscript.html">
    </noscript>

    <script src="./assets/js/script.js" type="text/javascript" defer></script>
</head>
<body>
    <header>
        <hgroup>
            <h1><?php echo SITENAME; ?> TLiMC</h1>
            <p>wewnątrzszkolna wymiana podręczników</p>
        </hgroup>
        <menu>
            <nav>
                <a href="#przegladaj">przeglądaj oferty</a>
                <a href="./src/booklist.php">lista podręczników</a>
                <?php
                    echo !isset($_SESSION["uid"]) ? '<a href="./src/access.php">Zaloguj</a>' : '<a href="./src/profile.php">moj profil</a>';
                ?>
            </nav>
        </menu>
    </header>

    <nav id="nawigacja">
        <a href="#przegladaj">Przeglądaj Oferty</a>
        <a href="./src/booklist.php">Lista podręczników</a>
        <?php 
            echo isset($_SESSION["uid"]) ? '<a href="./src/profile.php#offers">Moje oferty</a>' : '<a href="./src/access.php">Zaloguj się</a>';
        ?>
        <a href="./src/terms-of-service.html">Polityka Prywatności</a>
    </nav>

    <?php 
        $sql = "SELECT COUNT(*) AS `ilosc-ofert` FROM `offers` WHERE `status` = 1";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query)["ilosc-ofert"];
    ?>

    <main id="przegladaj">
        <h1>Przeglądaj oferty</h1>
        <search>
            <script src="./assets/js/search-controller.js" defer></script>
            <form action="" method="get">
                <!-- //!filters here  -->
                <!-- //*Przedmiot(polski,angielski,etc.), Klasa(1-5[?]), Pakiet(Y/N), Individual item(Y/N) -->
                <!-- //*Search by title/publisher/author-->
                <!-- no! not here, here basic single search, filters avaible after -->
                <!-- stupido zis comment was made like 2 days ago ! ! ! me know !!! -->
                <input type="search" name="search" id="searchbar" placeholder="Znajdz Produkt" />
                <input type="submit" value="&#x1F50D;" />
            </form>
        </search>
        <p>Ilość aktualnych ofert w bazie danych: <?php echo $result; ?></p>
        <div class="browse-wrapper">
            <?php
                $sql = "SELECT * FROM `offers` LIMIT 20";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_assoc($query)) {
                    echo '<div class="offer">';
                    // echo $result["id"];
                        $prod = explode(",", $result["products"]);
                        if (count($prod) > 1) {
                            echo '<div class="offer-title">Pakiet</div>';
                            echo '<details>';
                            echo '<summary>Pakiet zawiera: </summary>';
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

                            echo '<div class="offer-title">'. $result2["name"] .'</div>';

                        }
                        
                        echo '<details>';
                        echo '<summary>Dane kontaktowe</summary>';
                        echo $result["phone"];
                        echo $result["email"];
                        echo $result["discord"];
                        echo '</details>';
                        
                        echo '<span class="offer-date">';
                        echo '<span>oferta utworzona: ' . $result["offer-cdate"] . '</span>';
                        echo '<span>oferta wygasa: ' . $result["offer-edate"] . '</span>';
                        echo '</span>';
                    echo '</div>';
                }
            ?>
        </div>
    </main>

    <?php
        include "./src/footer.php";
    ?>
</body>
</html>
<?php $conn -> close(); ?>

<!-- // ? Do we add:
 // * 1
        https://stackoverflow.com/questions/6534904/how-can-i-remove-file-extension-from-a-website-address
        https://stackoverflow.com/questions/4026021/remove-php-extension-with-htaccess
        https://stackoverflow.com/questions/1992183/how-to-hide-the-html-extension-with-apache-mod-rewrite/1992191#1992191
        https://stackoverflow.com/questions/1992183/how-to-hide-the-html-extension-with-apache-mod-rewrite/1992191#1992191
            https://httpd.apache.org/docs/current/mod/mod_rewrite.html
 // * 2
        etc
-->
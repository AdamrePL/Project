<?php require_once "conf/config.php"; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="tlimc,Technikum Szkół Łączności i Multimediów Cyfrowych,giełda książek,giełda">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="favicon" type="png/image" href="icon.ico"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <title><?php echo SITENAME; ?> Książkowa</title>

    <noscript>
        <meta http-equiv="refresh" content="0; url=src/noscript.html">
    </noscript>
</head>
<body>
    <header>
        <hgroup>
            <h1><?php echo SITENAME; ?> TLiMC</h1>
            <p>wewnątrzszkolna wymiana podręcznikós</p>
        </hgroup>
        <menu>
            <nav>
                <a href="#przegladaj">przeglądaj oferty</a>
                <a href="src/booklist.php">lista podręczników</a>
                <?php
                    echo !isset($_SESSION["uid"]) ? '<a href="src/access.php">Zaloguj</a>' : '<a href="src/profile.php">moj profil</a>';
                ?>
            </nav>
        </menu>
    </header>
    
    <nav id="nawigacja">
        <?php
            if (isset($_SESSION["uid"])) {
                echo '<a href="controllers/logout.php">Wyloguj</a>';
                echo '<a href="src/profile.php#offers">Moje oferty</a>';
            } else {
                echo '<a href="src/access.php">Zaloguj się</a>';
            }
        ?>
        <a href="#przegladaj">Przeglądaj Oferty</a>
        <a href="src/booklist.php">Lista podręczników</a>
        <a href="src/terms-of-service.html">Polityka Prywatności</a>
    </nav>

    <main id="przegladaj">
        <h1>Przeglądaj oferty</h1>
        <search>
            <fieldset class="filters">
                <legend>&nbsp;Typ oferty&nbsp;</legend>
                <label>Wszystkie <input type="radio" name="offer_type" value="all" /></label>
                <label>Pakiet <input type="radio" name="offer_type" value="bundle" /></label>
                <label>Pojedyńcze <input type="radio" name="offer_type" value="singlular" /></label>
            </fieldset>
            <fieldset class="filters">
                <legend>&nbsp;Klasa&nbsp;</legend>
                <?php
                $sql = "SELECT DISTINCT `class` FROM `booklist`;";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_assoc($query)) {
                    echo sprintf('<label>%1$d <input type="checkbox" name="klasa" value="%1$d" /></label> ', $result["class"]);
                }
                ?>
            </fieldset>
            <fieldset class="filters">
                <legend>&nbsp;Przedmiot&nbsp;</legend>
                <select name="klasa"> <!-- multiple -->
                <!-- <optgroup><option disabled>Wybierz klase</option></optgroup> -->
                
                <?php
                    $sql = "SELECT DISTINCT `subject` FROM `booklist`;";
                    $query = mysqli_query($conn, $sql);
                    while ($result = mysqli_fetch_assoc($query)) {
                        echo sprintf('<option value="%1$s">%1$s</option> ', $result["subject"]);
                    }
                ?>
                </select>
            </fieldset>
            <!-- <fieldset class="filters">
                <legend>&nbsp;Sortuj przez&nbsp;</legend>
                <label>Cene - rosnąco <input type="radio" name="sort_price" value="desc" /></label>
                <label>Cene - malejąco <input type="radio" name="sort_price" value="desc" /></label>

            </fieldset> -->
            <form method="get">
                <input type="search" list="books-search-list" name="search" id="searchbar" placeholder="Znajdź Produkt" />
                <input type="submit" value="&#x1F50D;" />
                <datalist id="books-search-list">
                    <?php 
                        // $sql = "SELECT DISTINCT `name` FROM `booklist`"; /* Wszystkie */
                        $sql = "SELECT DISTINCT `id`, `name` FROM `products`"; /* Dostępne */
                        $query = mysqli_query($conn,$sql);
                        while ($result = mysqli_fetch_array($query)) {
                            echo '<option value="' . $result["name"] . '">' . $result["name"] . '</option>';
                        }
                    ?>
                </datalist>
            </form>
        </search>
<<<<<<< Updated upstream
        <?php 
            $sql = "SELECT COUNT(*) AS `ilosc-ofert` FROM `offers` WHERE `status` = 1";
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($query)["ilosc-ofert"];
        ?>
        <p>Ilość aktualnych ofert w bazie danych: <?php echo $result; ?></p>
        <div class="browse-wrapper">
            <?php
                // $search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
                $sql = "SELECT * FROM `offers` WHERE `status` = '1' LIMIT 20"; //finalne zapytanie
                // $sql = "SELECT * FROM `offers` LIMIT 20";
=======


        <p>Liczba dostępnych ofert: 
            <?php 
                $sql = "SELECT COUNT(*) AS active_offers FROM `offers` WHERE `status` = 1";
                $query  = mysqli_query($conn, $sql);
                $result =  mysqli_fetch_assoc($query);
                echo $result['active_offers'];
             ?>
        </p>

            <?php
                $sql = "SELECT * FROM `offers`WHERE `status` = 1 " ;
>>>>>>> Stashed changes
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_assoc($query)) {
                    // echo '<a href="?offer='.$result["id"].'">';
                    echo '<div class="offer">';
                        $sql2 = "SELECT * FROM `products` WHERE `offer-id` =" . $result["id"];
                        $query2 = mysqli_query($conn, $sql2);
                        $prod = mysqli_num_rows($query2);
                        
                        if ($prod > 1) {
                            echo '<h4 class="offer-title">Pakiet</h4>';
                            echo '<details>';
                            echo '<summary>Pakiet zawiera: </summary>';
                            for ($i = 0; $i < $prod; $i++) {
                                
                            }
                            while ($result2 = mysqli_fetch_assoc($query2)) {
                                echo $result2["name"] . '<br>';
                            }
                            echo '</details>';

                        } else {
                            $result2 = mysqli_fetch_assoc($query2);
                            echo '<h4 class="offer-title">'. $result2["name"] .'</h4>';
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
                    // echo '</a>';
                }
<<<<<<< Updated upstream
=======
              
>>>>>>> Stashed changes
            ?>
        </div>
    </main>

    <?php
        include "src/footer.php";
    ?>

    <?php 
    if (isset($_GET["offer-id"]) && $_GET["offer-id"] != null) {
        $sql = "SELECT * FROM `offers` WHERE `offers`.`id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $_GET["offer-id"]);
        mysqli_stmt_execute($stmt);
        $query = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        $result = mysqli_fetch_assoc($query);

        echo '<div class="overlay">';
            echo '<script src="../assets/js/script.js" defer></script>';
            echo '<div class="overlay-wrapper">';
                print_r( $result );
            echo '</div>';
            echo '<p class="overlay-msg">Click anywhere outside of the box to close</p>';
        echo '</div>';
    }
    ?>
</body>
</html>
<?php $conn -> close(); ?>
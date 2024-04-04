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
    
<<<<<<< Updated upstream
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

=======
 


>>>>>>> Stashed changes
    <main id="przegladaj">
        <h1>Dostępne oferty</h1>
        <search>
<<<<<<< Updated upstream
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
=======
            <form action="" method="get">
                <!-- //!filters here  -->
                <!-- //*Przedmiot(polski,angielski,etc.), Klasa(1-5[?]), Pakiet(Y/N), Individual item(Y/N) -->
                <!-- //*Search by title/publisher/author-->
>>>>>>> Stashed changes
                <input type="search" list="books-search-list" name="search" id="searchbar" placeholder="Znajdź Produkt" />
                <input type="submit" value="&#x1F50D;" />
                <datalist id="books-search-list">
                    <?php 
                        // $sql = "SELECT DISTINCT `name` FROM `booklist`"; Wszystkie */
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
            require_once "classes\offer.php";

            $offers = new Oferty($conn);
            $offers->PrintAll()
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
                $query = mysqli_query($conn, $sql);


                while ($result = mysqli_fetch_assoc($query)) {
                    echo '<div class="offer">';
                    echo $result["id"];
                    echo '<div class = "offer-seller"> Sprzedający: ' . $result["user-uuid"] . '</div>';
                    echo '<div class = "offer-date"> Data utworzenia: ' . date('d.m.Y', strtotime($result["offer-cdate"])) . '</div>'; //format dat na standard europejski dd-mm-yyyy
                    echo '<div class = "offer-date"> Data wygaśnięcia: ' . date('d.m.Y', strtotime($result["offer-edate"])) . '</div>'; //format dat na standard europejski dd-mm-yyyy
                    echo '<span onClick = "contact_data()"> Pokaż dane kontaktowe </span>';
                    echo '</div>';
                }
              
>>>>>>> Stashed changes
            ?>
    </main>

<<<<<<< Updated upstream
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
=======
    <?php include "./src/footer.php"; ?>    

    
</body>
</html>
<?php $conn -> close(); ?>

>>>>>>> Stashed changes

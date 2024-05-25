<?php 
require_once "conf/config.php"; 
$abspath = $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="tlimc,Technikum Szkół Łączności i Multimediów Cyfrowych,giełda książek,giełda">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    
    <title><?php echo SITENAME; ?> Książkowa</title>

    <noscript>
        <meta http-equiv="refresh" content="0; url=src/noscript.html">
    </noscript>
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
                <a href="src/booklist.php">lista podręczników</a>
                <a href="src/manage.php">Moje oferty</a>
            </nav>
        </menu>
    </header>
    
    <nav id="nawigacja">
        <?php
            if (isset($_SESSION["isadmin"]) && $_SESSION["isadmin"] > 0) {
                echo '<a href="src/admin-tools.php"><b>Panel Sterowania</b></a>';
            }
        ?>
        <a href="src/manage.php">Moje oferty</a>
        <a href="src/create.php">Stwórz Ofertę</a>
        <a href="#przegladaj">Przeglądaj Oferty</a>
        <a href="src/booklist.php">Lista Podręczników</a>
        <a href="src/terms-of-service.html">Polityka Prywatności</a>
    </nav>
    
    <main id="przegladaj">
        <h1>Przeglądaj oferty</h1>
        <search>
            <fieldset class="filters">
                <legend>&ThinSpace;Typ oferty&ThinSpace;</legend>
                <label>Wszystkie <input type="radio" name="offer_type" value="all" /></label>
                <label>Pakiet <input type="radio" name="offer_type" value="bundle" /></label>
                <label>Pojedyncze <input type="radio" name="offer_type" value="singlular" /></label>
            </fieldset>
            <fieldset class="filters">
                <legend>&ThinSpace;Klasa&ThinSpace;</legend>
                <?php
                $sql = "SELECT DISTINCT `class` FROM `booklist`;";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_assoc($query)) {
                    echo sprintf('<label>%1$d <input type="checkbox" name="klasa" value="%1$d" /></label> ', $result["class"]);
                }
                ?>
            </fieldset>
            <fieldset class="filters">
                <legend>&ThinSpace;Przedmiot&ThinSpace;</legend>
                <select name="klasa"> <!-- multiple -->
                <!-- <optgroup><option disabled>Wybierz klase</option></optgroup> -->
                
                <?php
                    $sql = "SELECT DISTINCT `subject` FROM `booklist` ORDER by name;";
                    $query = mysqli_query($conn, $sql);
                    while ($result = mysqli_fetch_assoc($query)) {
                        echo sprintf('<option value="%1$s">%1$s</option> ', $result["subject"]);
                    }
                ?>
                </select>
            </fieldset>
            <!-- <fieldset class="filters">
                <legend>&ThinSpace;Sortuj przez&ThinSpace;</legend>
                <label>Cene - rosnąco <input type="radio" name="sort_price" value="desc" /></label>
                <label>Cene - malejąco <input type="radio" name="sort_price" value="desc" /></label>

            </fieldset> -->
            <form method="get">
                <input type="search" pattern="[^'\x22]+" list="books-search-list" name="search" id="searchbar" autocomplete="off" placeholder="Znajdź Produkt" />
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
        <?php 
            $sql = "SELECT COUNT(*) AS `ilosc-ofert` FROM `offers` WHERE `status` = 1";
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($query)["ilosc-ofert"];
        ?>
        <p>Ilość <b>aktualnych</b> ofert w bazie danych: <?php echo $result; ?></p>
        <div class="browse-wrapper">
            <script src="assets/js/antiscraping.js" defer></script>
            <?php
            require_once "classes/OfferManager.php";
            
            $offers = new OffersDisplay($conn);
            $offers->display_offers(20);
            ?>
    </main>

    <?php include "./src/footer.php"; ?>
    
</body>
</html>
<?php $conn -> close(); ?>

<!-- https://www.w3schools.com/icons/fontawesome5_icons_writing.asp -->
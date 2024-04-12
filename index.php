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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
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
            <p>wewnątrzszkolna wymiana podręczników</p>
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
                echo '<a href="src/createoffer.php">Stwórz ofertę</a>';
            } else {
                echo '<a href="src/access.php">Zaloguj się</a>';
            }
        ?>
        <a href="#przegladaj">Przeglądaj Oferty</a>
        <a href="src/booklist-new.php">New lista podręczników</a>
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
                <input type="search" pattern="[^'\x22]+" list="books-search-list" name="search" id="searchbar" placeholder="Znajdź Produkt" />
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
        <p>Ilość aktualnych ofert w bazie danych: <?php echo $result; ?></p>
        <div class="browse-wrapper">
            <script src="assets/js/antiscraping.js"></script>
            <?php
            require_once "classes/Offer.php";

            $offers = new Oferty($conn);
            $offers->PrintAll();
            ?>
    </main>

    <?php include "./src/footer.php"; ?>
    
</body>
</html>
<<<<<<< Updated upstream
<?php $conn -> close(); ?>
=======
<?php $conn->close(); ?>    
>>>>>>> Stashed changes

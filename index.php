<?php require_once "conf/config.php"; ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="AdamrePL, Brouwar">
    <meta name="keywords" content="giełda książek,giełda">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- <link rel="favicon" type="png/image" href="icon.ico"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <title><?php echo SITENAME; ?> Książkowa</title>

    <script src="./assets/js/script.js" type="text/javascript" defer></script>
</head>
<body>
    <header>
        <h1>Giełda</h1>
        <?php print_r($_SESSION); ?>
        <p>Wewnątrzszkolna wymiana podręczników<p>
        <search>
            <script src="./assets/js/search-controller.js" defer></script>
            <form action="" method="get">
                <!-- //!filters here  -->
                <!-- //*Przedmiot(polski,angielski,etc.), Klasa(1-5[?]), Pakiet(Y/N), Individual purchase(Y/N) -->
                <!-- //*Search by title/publisher/author-->
                <!-- no! not here, here basic single search, filters avaible after -->
                <!-- stupido zis comment was made like 2 days ago ! ! ! me know !!! -->
                <input type="search" name="search" id="searchbar" placeholder="Znajdz Produkt" />
                <input type="submit" value="&#x1F50D;">
            </form>
        </search>

        <menu>
            <nav>
                <a href="#przegladaj">Przeglądaj Oferty</a>
                <a href="">Lista Podręczników</a>
                <a href="./src/terms-of-service.html">Polityka Prywatności</a>
            </nav>
        </menu>
        
    </header>

    <nav id="nawigacja">
        <a href="#przegladaj">Przeglądaj Oferty</a>
        <a href="">Lista podręczników</a>
        <a href="./src/access.php">Zaloguj się</a>
        <?php 
            if (isset($_SESSION["uid"])) {
                echo '<a href="./src/profile.php#offers">Moje oferty</a>';
            } 
        ?>
        <a>Placeholder Button</a>
        <a href="./src/terms-of-service.html">Polityka Prywatności</a>
    </nav>

    <section id="przegladaj">
        <h1>Przeglądaj oferty</h1>
        <div class="browse-wrapper">
            <?php
                echo "thingamajigs and maybe some hijinks go here";
            ?>
        </div>
    </section>
    <!-- <i class="fa-brands fa-discord"></i> -->


    <div id="offerOfUser">
        <h1><?php echo !isset($_SESSION["uid"])? "Zaloguj się aby zobaczyć swoje oferty!" : "Twoje oferty"; ?></h1>

        <p> You've created <?php echo "zero" ?> offers so far. </p>
         <!--yeah no ive got no idea why this doesnt work-->
    </div>

    <footer>&copy;Made by Adam, Marcin, TLiMC&reg; <?php echo date("Y");?>
    <Div class="footer">
    <span title="Username: AdamrePL&#013;UID: 317347265398308864"><i class="fa-brands fa-discord"></i> AdamrePL</span>
    <span title="Username: Adamre[PL]&#013;UID: adamre"><i class="fa-brands fa-steam"></i> <a target="_blank" href="https://steamcommunity.com/id/adamre">Adamre[PL]</a></span>
    <P>&copy; Made by AdamrePL - <?php echo date("Y");?></P>
</Div></footer>

    <noscript>
        <meta http-equiv="refresh" content="0; url=src/noscript.html">
    </noscript>


    <?php // ! TESTING ENV
    // $lol = "SELECT COUNT(*) FROM `offers`,`users` WHERE `offers.user-uuid` = `users.uuid`;";
    // $DisOf = mysqli_query($conn, $lol);
    // $whynowork = mysqli_query($conn,"SELECT COUNT(*) FROM `users`,`offers` WHERE `users.uuid`=`offers.user-uuid`;");
    //nah cause why the fuck arent you working lil bro this is just insane at this point
        // $whynowork = mysqli_query($conn,"SELECT * FROM `users`;");
        // echo $whynowork;
    $sql = mysqli_query($conn,"SELECT SUM(`user-offers`) FROM `users`;");
    echo $sql;
    //logically, this should work, but, of course, it doesn't . . .
    // no shit it doesn't work.. you used COUNT() function instead of SUM() @PiwkoM
    ?>

</body>
</html>
<?php $conn -> close(); ?>
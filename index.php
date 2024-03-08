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
        <p>Wewnątrzszkolna wymiana podręczników<p>
        <search>
            <form action="" method="get">
                <!-- //!filters here  -->
                <!-- //*Przedmiot(polski,angielski,etc.), Klasa(1-5[?]), Pakiet(Y/N), Individual purchase(Y/N) -->
                <!-- //*Search by title/publisher/author-->
                <!-- no! not here, here basic single search, filters avaible after -->
                <!-- stupido zis comment was made like 2 days ago ! ! ! me know !!! -->
                <input type="search" name="szukaj" id="" placeholder="Znajdz Produkt" />
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
        <!--//*? is this necessary?-->
        <a href="#przegladaj">Przeglądaj Oferty</a>
        <a href="">Lista podręczników</a>
        <a href="./src/access.php">Zaloguj się</a>
        <a href="./src/profile.php#offers"><?php echo !isset($_SESSION["uid"]) ? "placeholder" : "Moje oferty"; ?></a>
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

    <div id="offerOfUser">
        <h1><?php echo !isset($_SESSION["uid"])? "Zaloguj się aby zobaczyć swoje oferty!" : "Twoje oferty"; ?></h1>

        <p> You've created <?php echo "zero" ?> offers so far. </p>
         <!--yeah no ive got no idea why this doesnt work-->
    </div>

    <footer>&copy;Made by Adam, Marcin, TLiMC&reg; <?php echo date("Y");?></footer>

    <noscript>
        <meta http-equiv="refresh" content="0; url=src/noscript.html">
    </noscript>


    <?php // ! TESTING ENV
    // $lol = "SELECT COUNT(*) FROM `offers`,`users` WHERE `offers.user-uuid` = `users.uuid`;";
    // $DisOf = mysqli_query($conn, $lol);
    // $whynowork = mysqli_query($conn,"SELECT COUNT(*) FROM `users`,`offers` WHERE `users.uuid`=`offers.user-uuid`;");
    //nah cause why the fuck arent you working lil bro this is just insane at this point
        $whynowork = mysqli_query($conn,"SELECT * FROM `users`;");
        echo $whynowork;

    //logically, this should work, but, of course, it doesn't . . .
    ?>

</body>
</html>
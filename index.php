<?php require_once "config.php"; ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="favicon" href="icon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <title>Giełda Książkowa</title>

    <script src="script.js" type="text/javascript" defer></script>
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
                <a href="#przegladaj">Przeglądaj</a>
                <a href="">Lista podręczników</a>
                <a href="/terms-of-service.html">Polityka Prywatności</a>
            </nav>
        </menu>
        
    </header>

    <nav>
        <p>Przeglądaj</p>
        <p>Lista podręczników</p>
        <p>Zaloguj się</p>
        <p>moje oferty</p>
        <p></p>
        <a href="/terms-of-service.html">Polityka Prywatności</a>
    </nav>

    <section id="przegladaj">
        <h1>Przeglądaj oferty</h1>
        <div class="browse-wrapper"></div>
    <?php
        echo 'Latest stuff/search result goes here ( i think )';
        //*! Throws fatal error due to lack of data un-comment when database has stuff
        //$res= mysqli_query("SELECT * FROM offers LIMIT 3");
        //echo $res;
    ?>
    </section>

    <div id="offerOfUser">
    <?php
        echo "You've created (variable) offers so far.";
        //un-comment when database has stuff
        //$result = mysqli_query("SELECT * FROM offers, users WHERE offers.user-uuid==users.useruuid LIMIT 3");
        //$count = mysqli_query("SELECT COUNT(user-offers) FROM offers, users WHERE offers.user-uuid==users.useruuid");
    ?>
    </div>

    <footer>&copy;Made by Adam, Marcin, TLiMC&reg; <?php echo date("Y");?></footer>

    <noscript>
        Please turn on script handling!!!
    </noscript>

</body>
</html>
<?php require_once "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
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
        <p>immediately weight separate lay wall view pupil report classroom especially smooth cage shoot structure fort hall bus blow note atom vertical fall cow cup<p>
        <search>
            <form action="" method="get">
                <!-- //!filters here  -->
                <!-- //*Przedmiot(polski,angielski,etc.), Klasa(1-5[?]), Pakiet(Y/N), Individual purchase(Y/N) -->
                <!-- //*Search by title/publisher/author-->
                <input type="search" name="szukaj" id="" placeholder="Znajdz Produkt" />
            </form>
        </search>    
    </header>
       
        <menu> 
            <!-- //TODO: refer to corresponding divs on page using JS -->
            <p>Giełda</p>
            <p>Lista podręczników </p>
            <p>offesr_browse</p>
            <p>offer_create</p>
            <p>my_offer</p>
        </menu>

    <div id="offerBrowse">
    <?php
        echo 'Latest stuff/search result goes here ( i think )';
        //*! Throws fatal error due to lack of data un-comment when database has stuff
        //$res= mysqli_query("SELECT * FROM offers LIMIT 3");
        //echo $res;
    ?>
    </div>

    <div id="offerCreate">
        <form>
            <h1>Testing</h1>
            <input type="text" placeholder="Name Of Book"/>

            <select name="przedmioty">
                <option value="polish">J.Polski</option>
                <option value="english">J.Angielski</option>
                <option value="german">J.Niemiecki</option>
                <option value="math">Matematyka</option>
                <option value="phyiscs">Fizyka</option>
                <option value="chemistry">Chemia</option>
                <option value="geography">Geografia</option>
                <option value="biology">Biologia</option>
                <option value="history">Historia</option>
            </select>

            <!-- <input type="text" placeholder="Stan Książki"/> -->
            <input type="submit" value="Create Offer"/>
            <input type="reset" value="Reset"/>
        </form>
    </div>

    <div id="offerOfUser">
    <?php
        echo "You've created (variable) offers so far.";
        //un-comment when database has stuff
        //$result = mysqli_query("SELECT * FROM offers, users WHERE offers.user-uuid==users.useruuid LIMIT 3");
        //$count = mysqli_query("SELECT COUNT(user-offers) FROM offers, users WHERE offers.user-uuid==users.useruuid");
    ?>
    </div>

    <footer></footer>

    <noscript>
        Please turn on script handling!!!
    </noscript>

</body>
</html>
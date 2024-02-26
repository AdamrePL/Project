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
                <input type="search" name="szukaj" id="" placeholder="Znajdz Produkt" />
            </form>
        </search>    
    </header>
       
        <menu> 
            <p>Main</p>
            <p>offesr_browse</p>
            <p>offer_create</p>
            <p>my_offer</p>
        </menu>

    <div id="offer_browse">
    <?php


    ?>
    </div>

    <div id="offer_create">
    <form>
        <input type="text" placeholder="book status"/><br>
        <input type="date"/>
    </form>
    </div>

    <div id="offer_ofUser">
    <?php
        // ** get number of listings created by user from previous form and display 2-3.
        echo "<p>You've created offers</p>";
        echo "<p>Recent offers</p>";
    ?>
    </div>

    <footer>blah blah blah blah lorem ipsum blah blah blah blah.</footer>

    <noscript>
        Please turn on scripts or your pc go kaput
    </noscript>

</body>
</html>
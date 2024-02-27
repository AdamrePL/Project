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
            <!-- //TODO: refer to corresponding divs on page using JS -->
            <p>Main</p>
            <p>offesr_browse</p>
            <p>offer_create</p>
            <p>my_offer</p>
        </menu>

    <div id="offer_browse">
    <?php
        //*! Throws fatal error due to lack of data
        $res= mysqli_query("SELECT * FROM offers LIMIT 3");
        echo $result;
    ?>
    </div>

    <div id="offer_create">
        <form>
            <input type="text" placeholder="book status"/><br>
            <!-- //TODO: Add fields to offers table, form very empty! -->
        </form>
    </div>

    <div id="offer_ofUser">
    <?php
        $result = mysqli_query("SELECT * FROM offers, users WHERE offers.user-uuid==users.useruuid LIMIT 3");
        $count = mysqli_query("SELECT COUNT(user-offers) FROM offers, users WHERE offers.user-uuid==users.useruuid");
        //*? Is $count needed? cleanup later (i have no idea what im doing)
        
        echo "<p>You've created".[$count]."offers</p>";
        echo "<p>Recent offers</p>";
    ?>
    </div>

    <!-- // *? put owner info in footer?-->
    <footer>blah blah blah blah lorem ipsum blah blah blah blah.</footer>

    <noscript>
        Please turn on scripts or your pc go kaput
    </noscript>

</body>
</html>
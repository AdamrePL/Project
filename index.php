<?php // require_once "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="favicon" href="icon.ico">

    <title>Giełda Książkowa</title>

    <script src="script.js" type="text/javascript" defer></script>
</head>
<body>
    
    <header>    

        <nav id="menu">
            <p class="menu_item">Main</p>
            <p class="menu_item">offer_browse</p>
            <p class="menu_item">offer_create</p>
            <p class="menu_item">my_offer</p>
        </nav>
    
        <img id="logo"> <!-- OPTIONAL -->
        
        <span id="search"></span> <!-- search listings by book offered -->
        <span id="theme_toggle"></span>
        <span id="user_menu"></span>

    </header>

    <div id="main"></div>
        <?php
            echo "heyo :D";
            //TODO @AdamrePL: implement :3
        ?>
    <footer>blah blah blah blah lorem ipsum blah blah blah blah.</footer>

    <noscript>
        Please turn on scripts or your pc go kaput
    </noscript>
</body>
</html>
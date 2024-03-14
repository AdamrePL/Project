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

    <noscript>
        <meta http-equiv="refresh" content="0; url=src/noscript.html">
    </noscript>

    <script src="./assets/js/script.js" type="text/javascript" defer></script>
</head>
<body>
    <header>
        <h1>Giełda</h1>
        <p>Wewnątrzszkolna wymiana podręczników</p>
        <search>
            <script src="./assets/js/search-controller.js" defer></script>
            <form action="" method="get">
                <!-- //!filters here  -->
                <!-- //*Przedmiot(polski,angielski,etc.), Klasa(1-5[?]), Pakiet(Y/N), Individual purchase(Y/N) -->
                <!-- //*Search by title/publisher/author-->
                <!-- no! not here, here basic single search, filters avaible after -->
                <!-- stupido zis comment was made like 2 days ago ! ! ! me know !!! -->
                <input type="search" name="search" id="searchbar" placeholder="Znajdz Produkt" />
                <input type="submit" value="&#x1F50D;" />
            </form>
        </search>

        <menu>
            <nav>
                <a href="#przegladaj">Przeglądaj Oferty</a>
                <a href="./src/booklist.php">Lista Podręczników</a>
                <a href="./src/terms-of-service.html">Polityka Prywatności</a>
            </nav>
        </menu>
    </header>

    <nav id="nawigacja">
        <a href="#przegladaj">Przeglądaj Oferty</a>
        <a href="./src/booklist.php">Lista podręczników</a>
        <?php 
            echo isset($_SESSION["uid"]) ? '<a href="./src/profile.php#offers">Moje oferty</a>' :'<a href="./src/access.php">Zaloguj się</a>';
        ?>
        <a href="./src/terms-of-service.html">Polityka Prywatności</a>
    </nav>

    <?php 
        $sql = "SELECT COUNT(*) AS `ilosc-ofert` FROM `offers` WHERE `status` = 1";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query)["ilosc-ofert"];
    ?>

    <section id="przegladaj">
        <h1>Przeglądaj oferty</h1>
        <p>Ilość aktualnych ofert w bazie danych: <?php echo $result; ?></p>
        <div class="browse-wrapper">
            <?php
                $sql = "SELECT * FROM `offers` LIMIT 5";
                $res = mysqli_query($conn,$sql);
                $organized = mysqli_fetch_assoc($res); //fetch everything else from here
                $bucher = json_decode($organized["products"]); //get product info from here

            // //*? `products` column in `offers` needs revising?

            // //!DISPLAY CHECK PURPOSES, DONT GET TRIGGERED
                echo $organized["id"]."<br>";
                echo $organized["user-uuid"]."<br>";
                echo $organized["offer-cdate"]."<br>";
                echo $organized["offer-edate"]."<br>";
                echo $organized["status"]."<br>";
                echo (!$organized["phone"] ? "not set" : $organized["phone"])."<br>";
                echo (!$organized["email"] ? "not set" : $organized["email"])."<br>";
                echo (!$organized["discord"] ? "not set" : $organized["discord"]);

            ?>
        </div>
    </section>

    <section id="offerOfUser">
        <h1><?php echo !isset($_SESSION["uid"])? "Zaloguj się aby zobaczyć swoje oferty!" : "Twoje oferty"; ?></h1>

        <p> You've created <?php echo "zero" ?> offers so far. </p>
         <!--yeah no ive got no idea why this doesnt work-->
    </section>

    <?php // ! TESTING ENV
    include "./src/footer.php";
    // $lol = "SELECT COUNT(*) FROM `offers`,`users` WHERE `offers.user-uuid` = `users.uuid`;";
    // $DisOf = mysqli_query($conn, $lol);
    // $whynowork = mysqli_query($conn,"SELECT COUNT(*) FROM `users`,`offers` WHERE `users.uuid`=`offers.user-uuid`;");
    //nah cause why the fuck arent you working lil bro this is just insane at this point
        // $whynowork = mysqli_query($conn,"SELECT * FROM `users`;");
        // echo $whynowork;
    // $sql = mysqli_query($conn,"SELECT `user-offers` FROM `users` WHERE uuid = '". $_SESSION["uid"] ."';");
    // echo count(explode(",", mysqli_fetch_array($sql)["user-offers"]));
    //logically, this should work, but, of course, it doesn't . . .
    // no shit it doesn't work.. you used COUNT() function instead of SUM() @PiwkoM
    ?>

</body>
</html>
<?php $conn -> close(); ?>
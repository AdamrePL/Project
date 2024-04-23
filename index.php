<?php require_once "conf/config.php"; 
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="tlimc,Technikum Szkół Łączności i Multimediów Cyfrowych,giełda książek,giełda">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/antiscraping.css">
<link rel="stylesheet" href="/assets/css/booklist.css">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <title><?php echo SITENAME; ?> Książkowa</title>

    <noscript>
        <meta http-equiv="refresh" content="0; url=src/noscript.html">
    </noscript>
</head>

<body>
<div class="page-wrapper">
    <div class="content-wrap">
    <header>
        <?php include "src/navbar.php";?>

        <hgroup>
            <h1><?php echo SITENAME; ?> TLiMC</h1>
            <p>wewnątrzszkolna wymiana podręczników</p>
        <?php include "src/sbar.php";?>

        </hgroup>
        <menu>
           
        </menu>
    </header>
        

    <main id="przegladaj">
        <h1>Przeglądaj oferty</h1>
       
        <?php
        $sql = "SELECT COUNT(*) AS `ilosc-ofert` FROM `offers` WHERE `status` = 1";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query)["ilosc-ofert"];
        ?>
        <p>Ilość aktualnych ofert w bazie danych: <?php echo $result; ?></p>
        <div class="browse-wrapper">
            <script src="assets/js/antiscraping.js"></script>
            <?php
              

            require_once $abspath  . "\classes\Offer.php";

            $offers = new Offer($conn);
            $offers->PrintAll();
            ?>
            
    </main>
    </div>
    <?php include "src/footer.php";  ?>
</div>
</body>

</html>
<?php $conn->close(); ?>
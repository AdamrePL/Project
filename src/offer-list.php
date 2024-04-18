<?php require_once "../conf/config.php";
include "navbar.php";
?>

<head>
    <title><?php echo SITENAME . " - "; ?>Oferty</title>
    <link href="/assets/css/style.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/antiscraping.css" type="text/css" rel="stylesheet">

    <script src="/assets/js/booklist.js"></script>

</head>
<body>
    <div class="container">
        <?php
            require_once "..\classes\Offer.php";
            $offers = new Oferty($conn);
            $offers->PrintAll();
        ?>
    </div>
</body>

<?php include "footer.php"?>
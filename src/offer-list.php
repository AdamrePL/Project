<?php require_once "../conf/config.php";
include_once "navbar.php";
if(isset($_POST["book"])){
    $sql = "SELECT `products`.`offer-id` FROM `products` WHERE `products`.`name` = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_POST["book"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = $result->fetch_assoc();
    if(isset($data)){
        
    } else {
        echo "<h1>Brak oferty</h1>";
    
}
}
?>

<head>
    <title><?php echo SITENAME . " - "; ?>Oferty</title>
    <link href="/assets/css/style.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/antiscraping.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/antiscraping.css">
<link rel="stylesheet" href="/assets/css/booklist.css">

    <script src="/assets/js/booklist.js"></script>

</head>
<body>
    <div class="container">
        <?php
            require_once "..\classes\Offer.php";
            $offers = new Offer($conn, "../");
            $offers->PrintAll();
        ?>
    </div>
</body>

<?php include_once "footer.php"?>
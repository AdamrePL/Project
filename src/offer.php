<?php 
if (!isset($_GET) || empty($_GET) || !isset($_GET["id"]) || $_GET["id"] == "") {
    header("HTTP/1.0 403 Forbidden");
    header("Location: ". $_SERVER["BASE"]);
}
?>
<?php require_once $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"]."/conf/config.php"; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME . " - Oferta " . $_GET["id"]; ?></title>

    <link rel="stylesheet" href="../assets/css/offer.css">
</head>
<body>
<main>
<?php
    $quality = ["Używana", "Zniszczona", "Nowa"];

    $id = $_GET["id"];
    $sql = "SELECT * FROM `offers` WHERE `offers`.`id` = $id";
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    if (!$query->num_rows) {
        http_response_code(404);
        header("HTTP/1.0 403 Forbidden");
        header("Location: ". $_SERVER["BASE"]. "?error=not-found");
        exit();
    }
    $sql = "SELECT SUM(`price`) AS 'totalcost' FROM `products` WHERE `products`.`offer-id` = ". $result["id"];
    $query = $conn->query($sql);
    $totalcost = $query->fetch_column();
    echo '<h1>Informacje oferty</h1>';
    echo '<h2>Oferta utworzona: '. $result["offer-cdate"] .'</h2>';
    echo '<h2>Oferta kończy się: '. $result["offer-edate"] .'</h2>';
    echo '<h2>Status oferty: '. $result["status"] .'</h2>';
    echo '<h2>Kontakt:</h2>';
    
    echo '<p>Numer telefonu: '. substr($result["phone"], 0, 3) . '-' . substr($result["phone"], 3, 3) . '-' . substr($result["phone"], 6, 3) .'</p>';
    echo '<p>Email: '. base64_decode(convert_uudecode($result["email"])) .'</p>';
    echo '<p>Discord: '. $result["discord"] .'</p>';
    echo '<h3>Łączna cena za wszystkie książki: '. $totalcost .'zł</p>';
    echo '<h1>Oferta zawiera: </h1>';
    echo '<ol>';
    $sql = "SELECT * FROM `products` WHERE `products`.`offer-id` = ". $result["id"];
    $query = $conn->query($sql);
    while ($result2 = $query->fetch_assoc()) {
        echo '<li>';
        echo '<h3>tyt: ' . $result2["name"] . '</h3>';
        echo '<p>przedmiot: ' . $result2["subject"] . '</p>';
        echo '<p>klasa: ' . $result2["class"] . '</p>';
        echo 'jakość: ' . $quality[$result2["quality"]];
        echo '<h4> cena: ' . $result2["price"] . '</h4>'; 
        echo '</li>';
    }
    echo '</ol>';
?>
</main>
<?php include "footer.php" ?>
</body>
</html>
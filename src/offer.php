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
</head>
<body>
<?php
    $id = $_GET["id"];
    $sql = "SELECT * FROM `offers` WHERE `offers`.`id` = $id";
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();

    echo 'Sprzedaje: ' . $seller_name;

    $sql = "SELECT * FROM `products` WHERE `products`.`offer-id` = ". $result["id"];
    $query = $conn->query($sql);

    while ($result2 = $query->fetch_assoc()) {
        echo '<br>';
        echo $result["offer-cdate"] . $result["offer-edate"] . $result["phone"] . $result["email"] . $result["discord"];
        echo '<br>';
        echo 'tyt:' . $result2["name"] . 'autor:' . $result2["author"] . $result2["publisher"] . 'przed: ' . $result2["subject"] . $result2["class"] . $result2["price"] . $result2["quality"] . $result2["note"] . $result2["img"];
    }
?>

</body>
</html>
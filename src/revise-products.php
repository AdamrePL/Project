<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

require_once "$abspath\conf\config.php";

if (!isset($_GET["offer_id"])){
    header("Location /");
    exit(403);
}
$offer_id = $_GET["offer_id"];
$inv_message = "";
if(isset($_POST["edit"])){
    $product_id = $_POST["product_id"];
    $product = $_POST["product"];
    $price = $_POST["price"];
    $quality = $_POST["quality"];
    $description = $_POST["description"];


    for ($i = 0; $i < count($product); $i++){
        if (empty($product[$i])){
            $inv_message .= "Nazwa produktu nie może być pusta. \n";
        }
        if (empty($price[$i]) || $price[$i] < 0){
            $inv_message .= "Cena produktu nie może być pusta ani ujemna. \n";
        }
        if (empty($quality[$i]) || $quality[$i] < 0 || $quality[$i] > 2){
            $inv_message .= "Niepoprawny stan produktu. \n";
        }
    }

    if (empty($inv_message)){
        require_once "offer-controller.php";
        $offer = new OfferController($conn);
        for ($i = 0; $i < count($product_id); $i++){
            $resp = $offer->editProducts($product_id[$i], $product[$i],  $price[$i], $quality[$i], $description[$i]);
            if (!$resp){
                $inv_message .= "Nie udało się zaktualizować produktów. \n";
                break;
            } else {
                echo "<script>window.close();</script>";
            
            }
        }
    } 
}


$sql = "SELECT p.*
FROM products p
JOIN offers o ON p.`offer-id` = o.id
WHERE o.`user-uuid` = ? AND o.id = ?;";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt,"ss", $_SESSION["uid"], $offer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$quality = ["Used", "Damaged", "New"];

$sql_booklist = "SELECT * FROM booklist";
$stmt_booklist = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt_booklist, $sql_booklist);
mysqli_stmt_execute($stmt_booklist);
$result_booklist = mysqli_stmt_get_result($stmt_booklist);
mysqli_stmt_close($stmt_booklist);

$booklist = [];
while ($row = $result_booklist->fetch_assoc()){
    $booklist[$row["id"]] = $row["name"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
 
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/editproducts.css">
    <title>Popraw produkty</title>
</head>
<body>
    <div class="page-container">
    <div class="content-wrap">
    <?php
    require_once "navbar.php";
    ?>
    <form action="revise-products.php?offer_id=<?php echo $_GET["offer_id"]?>" method="post">
        <input type="hidden" name="offer_id" value="<?php echo $offer_id; ?>">
        <input type="hidden" name="edit" value="1">
        <table>
            <tr>
                <th>Podręcznik</th>
                <th>Cena</th>
                <th>Stan</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()){
                echo "<input type='hidden' name='product_id[]' value='" . $row["id"] . "'>";
                echo "<tr>";
                echo "<td>";
                echo "<select name='product[]'>";

                foreach ($booklist as $id => $name) {
                    if($name == $row["name"])
                        echo "<option value='$id' selected>$name</option>";
                    else
                        echo "<option value='$id'>$name</option>";
                    
                }
                echo "</select>";
                echo "</td>";
                
                echo "<td><input type='number' name='price[]' value='" . $row["price"] . "'></td>";
                echo "<td><select name='quality[]'>";
                for($i = 0; $i < count($quality); $i++){
                    echo "<option value='$i'";
                    if ($i == $row["quality"])
                        echo " selected";
                    echo ">" . $quality[$i] . "</option>";
                }
                echo "</select></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td colspan='4'><textarea name='description[]'>" . $row["note"] . "</textarea></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <p><?php echo $inv_message; ?></p>
        <input type="submit" value="Zapisz zmiany">
    </form>
</body>
</html>
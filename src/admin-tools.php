<?php 
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once $abspath."conf/config.php"; 

// if (!isset($_SESSION["isadmin"]) || $_SESSION["isadmin"] < 1) {
//     header("Location: ". $_SERVER["BASE"]);
// }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> - Admin Panel</title>
</head>
<body>

<form>
    <h2>Wstaw listę książek</h2>
    <input type="file" accept=".json" name="booklist">
    <input type="submit" name="del" value="Wykonaj" />
</form>

<form>
    <h2>Usuń wszystkie książki z listy</h2>
    <input type="submit" name="clear_booklist" value="Wykonaj" />
</form>

<form>
    <h2>Usuń wszystkie oferty</h2>
    <input type="submit" name="del_all_offers" value="Wykonaj" />
</form>

<form>
    <h2>Usuń oferte</h2>
    <input type="number" inputmode="numeric" min="0" />
    <input type="submit" name="del_offer" value="Wykonaj" />
</form>

<form>
    <h2>Usuń produkt w ofercie</h2>
    <input type="number" name="offer" inputmode="numeric" min="0" />
    <input type="number" name="product_id" inputmode="numeric" min="0" />
    <input type="submit" name="del_product" value="Wykonaj" />
</form>

<form>
    <h2>Usuń oferty użytkownika poprzez Email</h2>
    <input type="email" inputmode="email" />
    <input type="submit" name="del_user" value="Wykonaj" />
</form>

</body>
</html>
<?php 
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once $abspath."conf/config.php"; 
if (isset($_SESSION["admin_count"]) && $_SESSION["admin_count"] > 5) { 
    http_response_code(403);
    header("HTTP/1.0 403 Forbidden");
    header("Location: ". $_SERVER["BASE"] ."error=access-blocked");
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> - Admin Panel</title>

    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["signIN"])) {
        $login = $_POST["login"];
        $password = $_POST["password"];

        $json = "../conf/accounts.json";
        $admins = json_decode(file_get_contents($json), true);

        function login(array $users, string $login, string $password): bool {
            foreach ($users["Admins"] as $admin => $info) {
                if ($info["login"] == $login && password_verify($password, $info["password"])) {
                    $_SESSION["isadmin"] = $info["permission-level"];
                    $_SESSION["admin_count"] = 0;
                    return true;
                }
            }
            return false;
        }

        if (login($admins, $login, $password)) {
            echo "<h1>Witamy, $login!</h1>";
        } else {
            if (!isset($_SESSION["admin_count"])) {
                $_SESSION["admin_count"] = 0;
            }
            $_SESSION["admin_count"] = $_SESSION["admin_count"]++;
            http_response_code(403);
            header("HTTP/1.0 403 Forbidden");
            header("Location: ?error=incorrect-credentials");
        }
    }

    if (!isset($_SESSION["isadmin"]) || $_SESSION["isadmin"] < 1) {
        echo '<main class="access-wrapper">
        <picture class="logo">
            <img src="../assets/img/logo.png" />
        </picture>

        <div class="line"></div>
        
        <div class="form-wrapper">
        <h1 class="access-heading">Panel Admina</h1>
        <form method="post" class="user-form">
            <input type="password" name="login" placeholder="Login" autocomplete="username" autofocus required />
            <input type="password" name="password" placeholder="Hasło" required />
            <input type="submit" name="signIN" value="Zatwierdź">
            <span class="error-msg">';
                if (isset($_GET["error"]) && $_GET["error"] == "submit-error") echo "formularz nie został prawidłowo wysłany";
                if (isset($_GET["error"]) && $_GET["error"] == "incorrect-credentials") echo "nieprawidłowe dane logowania";
            echo '</span>
        </form></div></main></body></html>';

        exit();
    }
?>

<main>
    <form>
        <h2>Wstaw listę książek</h2>
        <input type="file" accept=".json" title="Wybierz plik" name="booklist">
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

    <a href="../controllers/logout.php">Wyloguj</a>
    <a href="<?php echo $_SERVER["BASE"]; ?>">Strona Główna</a>

</main>

</body>
</html>
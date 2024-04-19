<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once "$abspath\conf\config.php"; ?>

<?php
if (isset($_SESSION["uid"])) {
    header("Location: / ");
    exit(403);
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo SITENAME . " - "; ?>
        <?php echo isset($_GET["page"]) && $_GET["page"] == "register" ? "Zarejestuj" : "Zaloguj"; ?>
    </title>
    <link rel="stylesheet" href="../assets/css/access.css">
</head>

<body id ="body-access">
    <div class="access-wrapper">
        <div id="login-wrapper" aria-selected="true">
            <h1>zaloguj się</h1>
            <div class="container-login">
            <?php
            require_once $abspath . '\controllers\login-controller.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $controller = new LoginController($conn);
                $controller->loginUser();
                exit();
            }
            ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="user-form">
                <input type="text" name="user-id" minlength="7" maxlength="34" pattern="\w{3,30}(#[a-zA-Z0-9]{3})" placeholder="ID użytkownika" autocomplete="off" autofocus />
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "incorrect-uid") echo "niepoprawne uid"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "incorrect-tag") echo "niepoprawny tag"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "no-user-found") echo "użytkownik nie istnieje"; ?>
                </span>
                <input type="password" name="l_password" placeholder="Hasło" />
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "wrong-password") echo "błędne hasło"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "password-required") echo "wymagane hasło"; ?>
                </span>
                <input type="submit" name="log" value="Zaloguj">
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "l_submit-error") echo "formularz nie został prawidłowo wysłany"; ?>
                </span>
                <span>Nie posiadasz konta? <a href="?register">Zarejestruj się</a></span>
                <div>Nie pamiętasz User ID? <a href="remind-me.php">Przypomnij User ID</a></div>
                <div>Nie pamiętasz hasła? <a href="reset-my-password.php">Zresetuj hasło</a></div>
            </form>
            </div>
        </div>


         <div id="register-wrapper" aria-selected="false">
            <h1>Rejestracja</h1>
            <div class="container-register">
            <form method="post" action=<?php $abspath ?>"\controllers\test.php" class="user-form">
                <input type="text" name="username" title="Nazwa musi zaczynać się od litery&#013;jedyny dozwolony znak specjalny to _&#013;Maksymalnie 30 znaków" pattern="[a-zA-Z]{1}\w{2,29}" minlength="3" maxlength="30" placeholder="Nazwa użytkownika" autocomplete="username" <?php if (isset($_GET["username"])) echo 'value="' . $_GET["username"] . '"'; ?> required />
                <span class="error-msg"> 
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "incorrect-username") echo "nieprawidłowa nazwa użytkownika"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "name-too-short") echo "Nazwa musi składać się z minimum 3 znaków"; ?>
                </span>
                <input type="email" name="email" maxlength="320" placeholder="Adres e-mail" autocomplete="email" <?php if (isset($_GET["email"])) echo 'value="' . $_GET["email"] . '"'; ?> required />
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "incorrect-email") echo "nieprawidłowy adres e-mail"; ?>
                </span>
                <input type="password" title="Wymagane są:&#013;1 duża litera&#013;1 mała litera&#013;1 cyfra&#013;minimum 5 znaków" name="r_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" placeholder="Hasło (Opcjonalne)" minlength="5" />
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "shit-too-small-men") echo "hasło musi mieć długość minimum 5 znaków"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "processing-data-failure") echo "hasło nie może zawierać spacji"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "digit-required") echo "hasło musi zawierać przynajmniej 1 cyfrę"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "capital-letter-required") echo "hasło musi zawierać przynajmniej 1 dużą literę"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "lowercase-letter-required") echo "hasło musi zawierać przynajmniej 1 małą literę"; ?>
                </span>
                <input type="password" name="r_password-repeat" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" placeholder="Potwierdzenie hasła" minlength="5" />
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "reapeat-required") echo "wymagane powtórzenie hasła"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "passwords-dont-match") echo "hasła się nie zgadzają"; ?>
                </span>
                <span>Akceptuję Regulamin oraz <a href="terms-of-service.html">Politykę Prywatności</a><input type="checkbox" name="accept_tos" required /></span>
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "agreement-rejected") echo "wymagana akceptacja tos-u"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "empty-fields") echo "pole nazwy lub email nie zostało wypełnione"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "r_submit-error") echo "formularz nie został prawidłowo wysłany"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "unexpected-error") echo "wystąpił niespodziewany błąd :("; ?>
                </span>
               
                <span>Chcę zostać zalogowany po rejestracji konta<input type="checkbox" name="login_after_register"/></span>
                <input type="submit" name="reg" value="Zarejestruj">
                <span>Posiadasz już konto? <a href="?register">Zaloguj się</a></span>
                </div> 
            </form>
        </div>
    </div>
</body>
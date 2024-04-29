<?php require_once "../conf/config.php"; ?>

<?php
    if (isset($_SESSION["uid"])) {
        header("HTTP/1.0 403 Forbidden", true, 403);
        header("Location: ". $_SERVER["BASE"]);
        exit();
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

<body>
    <main class="access-wrapper">
        <picture class="logo">
            <img src="../assets/img/logo.png" />
        </picture>

        <div class="line"></div>

        <?php 
            if (!isset($_GET["page"])) {
                $_GET["page"] = "login";
            }
            switch ($_GET["page"]) {
                case 'register':
                    echo '<div class="form-wrapper">';
                    echo '<h1>rejestracja</h1>';
                    echo '<form method="post" action="../controllers/register-account.php">';
                        echo '<input type="email" name="email" placeholder="Adres e-mail" autocomplete="email" value="'; echo isset($_GET["email"]) ? $_GET["email"] : ""; echo '" required />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "incorrect-email") echo "nieprawidłowy adres e-mail";
                        echo '</span>';
                        echo '<input type="password" title="Wymagane są:&#013;1 duża litera&#013;1 mała litera&#013;1 cyfra&#013;minimum 8 znaków" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" placeholder="Hasło" minlength="8" required />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "shit-too-small-men") echo "hasło musi mieć długość minimum 8 znaków";
                            if (isset($_GET["error"]) && $_GET["error"] == "processing-data-failure") echo "hasło nie może zawierać spacji";
                            if (isset($_GET["error"]) && $_GET["error"] == "digit-required") echo "hasło musi zawierać przynajmniej 1 cyfrę";
                            if (isset($_GET["error"]) && $_GET["error"] == "capital-letter-required") echo "hasło musi zawierać przynajmniej 1 dużą literę";
                            if (isset($_GET["error"]) && $_GET["error"] == "lowercase-letter-required") echo "hasło musi zawierać przynajmniej 1 małą literę";
                        echo '</span>';
                        echo '<input type="password" name="password-repeat" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" placeholder="Potwierdzenie hasła" minlength="5" required />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "reapeat-required") echo "wymagane powtórzenie hasła";
                            if (isset($_GET["error"]) && $_GET["error"] == "passwords-dont-match") echo "hasła się nie zgadzają";
                        echo '</span>';
                        echo '<label><input type="checkbox" name="accept_tos" required />Akceptuję Regulamin oraz <a href="terms-of-service.html">Politykę Prywatności</a></label>';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "agreement-rejected") echo "wymagana akceptacja tos-u";
                            if (isset($_GET["error"]) && $_GET["error"] == "empty-fields") echo "pole nazwy lub email nie zostało wypełnione";
                            if (isset($_GET["error"]) && $_GET["error"] == "submit-error") echo "formularz nie został prawidłowo wysłany";
                            if (isset($_GET["error"]) && $_GET["error"] == "unexpected-error") echo "wystąpił niespodziewany błąd :(";
                        echo '</span>';
                        //<span>Chcę zostać zalogowany po rejestracji konta</span><input type="checkbox" name="login_after_register"/>-->
                        echo '<input type="submit" name="submit" value="Zarejestruj">';
                        echo '<span>Posiadasz już konto? <a href="?page=login">Zaloguj się</a>.</span>';
                        echo '</form>';
                        echo '</div>';
                    break;
                
                default:
                    echo '<div class="form-wrapper">';
                    // echo '<a class="return-btn" href="'.$_SERVER["BASE"].'">&NestedLessLess;&nbsp;Powrót</a>';
                    echo '<h1>logowanie</h1>';
                    echo '<form method="post" action="../controllers/login-controller.php" class="user-form">';
                        echo '<input type="email" placeholder="Adres e-mail" autocomplete="email" value="'; echo isset($_GET["email"]) ? $_GET["email"] : ""; echo '" autofocus required />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "no-uid-provided") echo "nie podano uid";
                            if (isset($_GET["error"]) && $_GET["error"] == "incorrect-uid") echo "niepoprawne uid";
                            if (isset($_GET["error"]) && $_GET["error"] == "incorrect-tag") echo "niepoprawny tag";
                            if (isset($_GET["error"]) && $_GET["error"] == "no-user-found") echo "użytkownik nie istnieje";
                        echo '</span>';
                        echo '<input type="password" name="password" minlenght="8" placeholder="Hasło" required />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "wrong-password") echo "błędne hasło";
                            if (isset($_GET["error"]) && $_GET["error"] == "password-required") echo "wymagane hasło";
                        echo '</span>';
                        echo '<input type="submit" name="submit" value="Zaloguj">';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "submit-error") echo "formularz nie został prawidłowo wysłany";
                        echo '</span>';
                        echo '<span>Nie posiadasz konta? <a href="?page=register">Zarejestruj się</a>.</span>';
                    echo '</form>';
                    echo '</div>';
                    break;
            }
        ?>
    </main>
    <?php // include_once "footer.php" ?>
</body>

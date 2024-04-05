<?php require_once "../conf/config.php"; ?>

<?php
    if (isset($_SESSION["uid"])) {
        header("Location: / ");
        exit(403);
    }
?>

<head>
    <link rel="stylesheet" href="../assets/css/access.css">
    <title><?php echo SITENAME; ?> - Zaloguj / Zarejestruj</title>
</head>

<body>
    <div class="access-wrapper">
        <div class="logo">
            <img src="../assets/img/logo.png" />
        </div>

        <div class="line"></div>

        <?php 
            if (!isset($_GET["page"])) {
                $_GET["page"]="";
            }
            switch ($_GET["page"]) {
                case 'register':
                    echo '<div id="form-wrapper">';
                    echo '<h1>Rejestracja</h1>';
                    echo '<form method="post" action="../controllers/register-account.php" class="user-form">';
                        echo '<input type="text" name="username" title="Nazwa musi zaczynać się od litery&#013;jedyny dozwolony znak specjalny to _&#013;Maksymalnie 30 znaków" pattern="[a-zA-Z]{1}\w{2,29}" minlength="3" maxlength="30" placeholder="Nazwa użytkownika" autocomplete="username" value="'; echo isset($_GET["username"]) ? $_GET["username"] : ""; echo '" required />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "incorrect-username") echo "nieprawidłowa nazwa użytkownika";
                            if (isset($_GET["error"]) && $_GET["error"] == "name-too-short") echo "Nazwa musi składać się z minimum 3 znaków";
                        echo '</span>';
                        echo '<input type="email" name="email"  maxlength="320" placeholder="Adres e-mail" autocomplete="email" value="'; echo isset($_GET["email"]) ? $_GET["email"] : ""; echo '" required />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "incorrect-email") echo "nieprawidłowy adres e-mail";
                        echo '</span>';
                        echo '<input type="password" title="Wymagane są:&#013;1 duża litera&#013;1 mała litera&#013;1 cyfra&#013;minimum 5 znaków" name="r_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" placeholder="Hasło (Opcjonalne)" minlength="5" />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "shit-too-small-men") echo "hasło musi mieć długość minimum 5 znaków";
                            if (isset($_GET["error"]) && $_GET["error"] == "processing-data-failure") echo "hasło nie może zawierać spacji";
                            if (isset($_GET["error"]) && $_GET["error"] == "digit-required") echo "hasło musi zawierać przynajmniej 1 cyfrę";
                            if (isset($_GET["error"]) && $_GET["error"] == "capital-letter-required") echo "hasło musi zawierać przynajmniej 1 dużą literę";
                            if (isset($_GET["error"]) && $_GET["error"] == "lowercase-letter-required") echo "hasło musi zawierać przynajmniej 1 małą literę";
                        echo '</span>';
                        echo '<input type="password" name="r_password-repeat" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" placeholder="Potwierdzenie hasła" minlength="5" />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "reapeat-required") echo "wymagane powtórzenie hasła";
                            if (isset($_GET["error"]) && $_GET["error"] == "passwords-dont-match") echo "hasła się nie zgadzają";
                        echo '</span>';
                        echo '<span>Akceptuję Regulamin oraz <a href="terms-of-service.html">Politykę Prywatności</a><input type="checkbox" name="accept_tos" required /> </span>';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "agreement-rejected") echo "wymagana akceptacja tos-u";
                            if (isset($_GET["error"]) && $_GET["error"] == "empty-fields") echo "pole nazwy lub email nie zostało wypełnione";
                            if (isset($_GET["error"]) && $_GET["error"] == "r_submit-error") echo "formularz nie został prawidłowo wysłany";
                            if (isset($_GET["error"]) && $_GET["error"] == "unexpected-error") echo "wystąpił niespodziewany błąd :(";
                        echo '</span>';
                        //!hello yes please tell user UID after creation *WITHOUT* pressing this f&$*@!g button-->
                        //<span>Chcę zostać zalogowany po rejestracji konta</span><input type="checkbox" name="login_after_register"/>-->
                        echo '<input type="submit" name="reg" value="Zarejestruj">';
                        echo '<span>Posiadasz już konto? <a href="?page=login">Zaloguj się</a></span>';
                        echo '</form>';
                        echo '</div>';
                    break;
                
                default:
                    echo '<div class="form-wrapper">';
                    echo '<h1>Logowanie</h1>';
                    echo '<form method="post" action="../controllers/login-controller.php" class="user-form">';
                        echo '<input type="text" name="user-id" minlength="7" maxlength="34" pattern="\w{3,30}(#[a-zA-Z0-9]{3})" placeholder="ID użytkownika; ala#xxx" autocomplete="off" autofocus />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "incorrect-uid") echo "niepoprawne uid";
                            if (isset($_GET["error"]) && $_GET["error"] == "incorrect-tag") echo "niepoprawny tag";
                            if (isset($_GET["error"]) && $_GET["error"] == "no-user-found") echo "użytkownik nie istnieje";
                        echo '</span>';
                        echo '<input type="password" name="l_password" placeholder="Hasło (Jeżeli jest)" />';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "wrong-password") echo "błędne hasło";
                            if (isset($_GET["error"]) && $_GET["error"] == "password-required") echo "wymagane hasło";
                        echo '</span>';
                        echo '<input type="submit" name="log" value="Zaloguj">';
                        echo '<span class="error-msg">';
                            if (isset($_GET["error"]) && $_GET["error"] == "l_submit-error") echo "formularz nie został prawidłowo wysłany";
                        echo '</span>';
                        echo '<span>Nie posiadasz konta? <a href="?page=register">Zarejestruj się</a></span>';
                    echo '</form>';
                    echo '</div>';
                    break;
            }
        ?>
    </div>
</body>

<?php require_once "../conf/config.php"; ?>

<head>
    <link rel="stylesheet" href="../assets/css/access.css">
    <title><?php echo SITENAME; ?> - Zaloguj / Zarejestruj</title>
</head>

<body>
    <div class="access-wrapper">
        <div id="login-wrapper" aria-selected="true">
            <h1>Logowanie</h1>
            <form method="post" action="../controllers/login-controller.php" class="user-form">
                <input type="text" name="user-id"  minlength="7" maxlength="34" placeholder="ID użytkownika" autocomplete="off" autofocus />
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "incorrect-uid") echo "niepoprawne uid"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "incorrect-tag") echo "niepoprawny tag"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "no-user-found") echo "użytkownik nie istnieje"; ?>
                </span>
                <input type="password" name="l_password" placeholder="Hasło (Jeżeli jest)" />
                <span class="error-msg">
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "wrong-password") echo "błędne hasło"; ?>
                    <?php if (isset($_GET["error"]) && $_GET["error"] == "password-required") echo "wymagane hasło"; ?>
                </span>
                <input type="submit" name="logowanie" value="Zaloguj">
            </form>
        </div>
        <div class="line"></div>
        <div id="register-wrapper" aria-selected="false">
            <h1>Rejestracja</h1>
            <form method="post" action="../controllers/process-data.php" class="user-form">
                <input type="text" name="username"  minlength="3" maxlength="30" placeholder="Nazwa użytkownika" autocomplete="username" <?php if (isset($_GET["username"])) echo 'value="'. $_GET["username"] .'"'; ?> required />
                <input type="email" name="email"  maxlength="320" placeholder="Adres e-mail" autocomplete="email" <?php if (isset($_GET["email"])) echo 'value="'. $_GET["email"] .'"'; ?> required />
                <input type="password" name="r_password" placeholder="Hasło (Opcjonalne)" />
                <input type="password" name="r_password-repeat" placeholder="Potwierdzenie hasła" />
                <span class="error-msg"><?php if (isset($_GET["error"]) && $_GET["error"] == "password-does-not-match") echo "hasła się nie zgadzają"; ?></span>
                <label for="accept_TOS">Akceptuję Regulamin oraz Politykę Prywatności</label><input type="checkbox" name="accept_TOS" required/> 
                <input type="submit" value="Zarejestruj">
            </form>
        </div>
    </div>
</body>


<!--//*! @AdamrePL current regex patterns dont work as intended!!!!-->
<!--patterns:
log userid: pattern="\w{3,30}#[a-zA-Z0-9]{3}"

reg username: pattern="/\w{3,30}/g"
reg email: blank param




-->
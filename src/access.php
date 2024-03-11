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
                <input type="text" name="user-id" pattern="/\w{3,30}\#[a-zA-Z0-9]{3}/g" minlength="7" maxlength="34" placeholder="ID użytkownika" autocomplete="off" autofocus />
                <span class="error-msg"><?php if (isset($_GET["error"]) && in_array("incorrect-uid", explode(",", $_GET["error"]))) echo "niepoprawne uid"; ?></span>
                <input type="password" name="l_password" placeholder="Hasło (Jeżeli jest)" />
                <span class="error-msg"><?php if (isset($_GET["error"]) && in_array("wrong-password", explode(",", $_GET["error"]))) echo "błędne hasło"; ?></span>
                <input type="submit" name="logowanie" value="Zaloguj">
            </form>
        </div>
        <div class="line"></div>
        <div id="register-wrapper" aria-selected="false">
            <h1>Rejestracja</h1>
            <form method="post" action="../controllers/process-data.php" class="user-form">
                <input type="text" name="username" pattern="/\w{3,30}/g" minlength="3" maxlength="30" placeholder="Nazwa użytkownika" autocomplete="username" <?php if (isset($_GET["username"])) echo 'value="'. $_GET["username"] .'"'; ?> />
                <input type="email" name="email" pattern="" maxlength="320" placeholder="Adres e-mail" autocomplete="email" <?php if (isset($_GET["email"])) echo 'value="'. $_GET["email"] .'"'; ?> />
                <input type="password" name="r_password" placeholder="Hasło (Opcjonalne)" />
                <input type="password" name="r_password-repeat" placeholder="Potwierdzenie hasła" />
                <span class="error-msg"><?php if (isset($_GET["error"]) && in_array("password-does-not-match", explode(",", $_GET["error"]))) echo "hasła się nie zgadzają"; ?></span>
                <input type="submit" value="Zarejestruj">
            </form>
        </div>
    </div>
</body>
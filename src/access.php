<?php require_once "../conf/config.php"; ?>

<head>
    <link rel="stylesheet" href="../assets/css/access.css">
    <title><?php echo SITENAME; ?> - Zaloguj / Zarejestruj</title>
</head>

<body>
    <div class="access-wrapper">
        <div id="login-wrapper" aria-selected="true">
            <h1>Logowanie</h1>
            <form method="post" action="../controllers/process-data.php" class="user-form">
                <input type="text" name="user-id" placeholder="ID użytkownika" />
                <input type="password" name="password" placeholder="Hasło (Jeżeli jest)" />
                <input type="submit" name="logowanie" value="Zaloguj">
            </form>
        </div>
        <div class="line"></div>
        <div id="register-wrapper" aria-selected="false">
            <h1>Rejestracja</h1>
            <form method="post" action="../controllers/process-data.php" class="user-form">
                <input type="text" name="username" placeholder="Nazwa użytkownika"/>
                <input type="email" name="email" placeholder="Adres e-mail"/>
                <input type="password" name="password" placeholder="Hasło (Opcjonalne)"/>
                <input type="password" name="password-repeat" placeholder="Potwierdzenie hasła"/>
                <input type="submit" value="Zarejestruj">
            </form>
        </div>
    </div>
</body>




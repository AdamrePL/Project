<?php require_once "../conf/config.php"; ?>

<head>
    <link rel="stylesheet" href="../assets/css/access.css">
    <title><?php echo SITENAME; ?> - Zaloguj / Zarejestruj</title>
</head>

<body>
    <div class="access-wrapper">
        <div>
            <h1>Logowanie</h1>
            <form method="post" action="" class="user-form">
                <input type="text" placeholder="ID użytkownika"/>
                <input type="password" placeholder="Hasło (Jeżeli jest)"/>
                <input type="submit" value="Zaloguj">
            </form>
        </div>
        <div class="line"></div>
        <div>
            <h1>Rejestracja</h1>
            <form method="post" class="user-form">
                <input type="text" placeholder="Nazwa użytkownika"/>
                <input type="email" placeholder="Adres e-mail"/>
                <input type="password" placeholder="Hasło (Opcjonalne)"/>
                <input type="password" placeholder="Potwierdzenie hasła"/>
                <input type="submit" value="Zarejestruj">
            </form>
        </div>
    </div>
</body>




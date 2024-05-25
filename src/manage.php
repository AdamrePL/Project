<?php 
require_once "../conf/config.php"; 
$abspath = $_SERVER["BASE"];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITENAME; ?> - Zarządzaj Ofertami</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    
    <script src="<?php echo $abspath; ?>assets/js/validator.js" defer></script>
</head>

<body>
    <main class="access-wrapper">
        <picture class="logo">
            <img src="../assets/img/logo.png" />
        </picture>

        <div class="line"></div>

        <div class="form-wrapper">
            <h1>logowanie</h1>
            <form method="post" action="../controllers/login-controller.php" class="user-form">
                <input type="email" placeholder="Adres e-mail" autocomplete="email" autofocus required />
                <span class="error-msg"></span>
                <input type="password" name="password" minlenght="8" placeholder="Hasło" required />
                <span class="error-msg"></span>
                <input type="submit" name="submit" value="Zaloguj">
                <span class="error-msg"><?php if (isset($_GET["error"]) && $_GET["error"] == "submit-error") echo "formularz nie został prawidłowo wysłany"; ?></span>
                <span>Problemy z logowaniem? <a href="<?php echo $abspath; ?>src/terms-of-service.php#faq";">Faq</a></span>
            </form>
        </div>
    </main>
</body>

<?php
    require_once "../conf/config.php";
?>
<!-- //TODO: UI -->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/remind-reset-form.css">
    <title>Reset Password</title>
</head>
<body>
    <div class="page-container">
            <div class="content-wrap">
            <?php include_once "navbar.php" ?>
            <?php if(!isset ($_GET["token"])){?>
                <form action="../controllers/reset-password.php" method="post">
                    <h1>Resetuj hasło</h1>
                    <input type="email" name="email" id="" placeholder="adres e-mail">
                    <button type="submit">Wyślij link do resetowania</button>
                </form>
            <?php } else {?>
                <form action="../controllers/reset-password.php" method="post">
                    <h1>Ustaw nowe hasło</h1>
                    <input type="hidden" name="token" value="<?php echo $_GET["token"]?>">
                    <input type="password" name="password" placeholder="nowe hasło"> <br>
                    <input type="password" name="confirm_password" placeholder="podtwierdź nowe hasło"> <br>
                    <button type="submit">Ustaw nowe hasło</button>
                </form>
            <?php } ?>
        </div>
        <?php require_once "footer.php" ?>
    </div>
</body>
</html>
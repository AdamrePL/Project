<!-- //TODO: UI -->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <?php if(!isset ($_GET["token"])){?>
        <form action="../controllers/reset-password.php" method="post">
            <input type="email" name="email" id="">
            <button type="submit">Send reset link</button>
        </form>
    <?php } else {?>
        <form action="../controllers/reset-password.php" method="post">
            <input type="hidden" name="token" value="<?php echo $_GET["token"]?>">
            <label for="">New password: </label>
            <input type="password" name="password"> <br>
            <label for="">Confirm password: </label>
            <input type="password" name="confirm_password"> <br>
            <button type="submit">YES!!! Reset my password</button>
        </form>
    <?php } ?>
</body>
</html>
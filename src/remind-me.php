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
    <title>Przypomnij ID</title>
</head>

<body id="body-remind">
    <div class="page-container">
        <div class="content-wrap">
            <?php include_once "navbar.php" ?>
                <form action="../controllers/remind-user-id.php" method="post">
                    <h1>Przypomnij User ID</h1>
                    <input type="email" name="email" id="" required placeholder="adres e-mail">
                    <button type="submit">Przypomnij moje ID</button>
                </form>
        </div>
        <?php require_once "footer.php" ?>
    </div>
</body>

</html>
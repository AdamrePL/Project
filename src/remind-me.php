<!-- //TODO: UI -->
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/access.css">
    <title>Przypomnij ID</title>
</head>

<body id="body-remind">
    <?php include "navbar.php" ?>
        <form action="../controllers/remind-user-id.php" method="post">
            <input type="email" name="email" id="" placeholder="adres e-mail">
            <button type="submit">Przypomnij moje ID</button>
        </form>
</body>

</html>
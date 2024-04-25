<?php
require_once("../conf/config.php");
if (empty($_GET["search"])){
    header("Location: index.php");
    exit(403);
}
$q = $_GET["search"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <title><?php echo $q?></title>
</head>
<body>
    <div class="page-container">
        <div class="content-wrap">
            <?php include "navbar.php" ?>
            <div class="search-results">
                <h1>Wyniki wyszukiwania dla: <?php echo $q?></h1>
                <div class="results">
                    <?php

                    ?>
                </div>
            </div>
        </div>
        <?php require_once "footer.php" ?>
    </div>
</body>
</html>
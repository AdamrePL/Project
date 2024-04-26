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
                    $query = "SELECT products.*, offers.id FROM products JOIN offers ON products.id = offers.id WHERE products.name LIKE '%$q%'";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='product'>";
                            echo "<h2>" . $row['name'] . "</h2>";
                            echo "<p>Offer ID: " . $row['id'] . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo  mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
        <?php require_once "footer.php" ?>
    </div>
</body>
</html>
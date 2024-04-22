<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

require_once "$abspath\conf\config.php";

if (isset($_SESSION["uid"]) and isset($_GET["offer_id"])){
    $uid = $_SESSION["uid"];
    $offer_id = $_GET["offer_id"];

    $sql = "SELECT `offers`.* FROM `offers` WHERE `offers`.`id` = ? AND `offers`.`user-uuid` = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt,"ss", $offer_id, $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = $result->fetch_assoc();
    mysqli_stmt_close($stmt);
    if (isset($data)){
        //nuthing
    } else {
        header("Location: ../src/profile.php");
        exit(403);
    }
} else {
    header("Location: ../src/profile.php");
    exit(403);
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popraw ofertę</title>
    <link rel="stylesheet" href="../assets/css/editoffer.css">
</head>
<body>
<?php
$quality = ["Used", "Damaged", "New"];
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="offer-info">
                <div class="offer-contact">
                    <h3>Dane kontaktowe</h3>

                    <input type="number" name="phone" placeholder="numer telefonu" value="<?php echo $data["phone"];?>">
                    <input type="text" name="email" placeholder="e-mail" value="<?php echo $data["email"];?>">
                    <input type="text" name="discord" placeholder="discord tag" value="<?php echo $data["discord"];?>"> <!-- Discord user right here, used discord for past ... 7 years and yet I don't remember how this is now called.-->
                </div>
                <div class="offer-options">
                    <h3>Oferta ma wygasnąć po:</h3>
                    <input type="number" name="exp_days" inputmode="numeric" placeholder="Dni - min 5, max 91, puste = 14" min="5" max="91" value="<?php 
                    $earlier = new DateTime($data["offer-cdate"]);
                    $later = new DateTime($data["offer-edate"]);
                    
                    $abs_diff = $later->diff($earlier)->format("%a"); //3
                    echo $abs_diff;
                    ?>"/>
                </div>
            </div>
            <div class="">
            <input type="checkbox" id="publish-data-agreement" name="personal-data-agreement" required>
            <label for="publish-data-agreement">Wyrażam zgodę na opublikowanie moich danych osobowych.</label>
            </div>
            
            <input type="submit" value="Popraw Ofertę" name="standard" />
          
            <details>
                <summary>Edytuj produkty ()</summary>
                <ul>
                <?php
                $sql = "SELECT `products`.* FROM `products` WHERE `products`.`offer-id` = ?;";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt,"s", $offer_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $data = $result->fetch_assoc();
                mysqli_stmt_close($stmt);
                if (isset($data)){
                    echo '<li><a href="" target="_blank">'.$data["name"].' - '.$data["price"].' zł</a></li>';
                } else {
                    echo "Brak produktów w ofercie";
                }
                ?>
                </ul>
            </details>
        </form>
        
</body>
</html>
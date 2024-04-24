<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

require_once "$abspath\conf\config.php";

if(isset($_POST["edit"])){
    $offer_id = $_POST["offer_id"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $discord = $_POST["discord"];
    $exp_days = $_POST["exp_days"];
    $personal_data_agreement = $_POST["personal-data-agreement"];
    
    $inv_message = "";

    if (empty($exp_days) || $exp_days < 5 || $exp_days > 91){
        $inv_message .= "Niepoprawna ilość dni. \n";
    }
    if (!empty($phone) and strlen($phone) < 9){
        $inv_message .= "Niepoprawny numer telefonu. \n";
    }
    if (!empty($email) and !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $inv_message .= "Niepoprawny adres e-mail. \n";
    }
    if (!empty($discord) and strlen($discord) < 3){
        $inv_message .= "Niepoprawny tag discord. \n";
    }
    if (empty($discord) and empty($phone) and empty($email)){
        $inv_message .= "Musisz podać przynajmniej jeden sposób kontaktu. \n";
    }
    if (empty($personal_data_agreement)){
        $inv_message .= "Musisz wyrazić zgodę na publikację danych osobowych. \n";
    }

    if (empty($inv_message)){
        require_once "offer-controller.php";
        $offer = new OfferController($conn);
        $resp_id = $offer->editOffer($offer_id, $phone, $email, $discord, $exp_days);
        if (isset($resp_id)){
            header("Location: ../src/profile.php?offer_id=$resp_id?allok=1");
        }
        exit(200);
    } 

    
}

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
    if (!isset($data)){
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
    <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body>
    <div class="page-container">
    <div class="content-wrap">


    <?php 
    require_once "navbar.php";
    ?>
<?php
$quality = ["Used", "Damaged", "New"];
?>
<form action="?offer_id=<?php echo $_GET["offer_id"] ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit" value="1">
            <input type="hidden" name="offer_id" value="<?php echo $data["id"];?>">
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
            <p><?php if (isset($inv_message)) {echo nl2br($inv_message);}?></p>
            <input type="checkbox" id="publish-data-agreement" name="personal-data-agreement" required>
            <label for="publish-data-agreement">Wyrażam zgodę na opublikowanie moich danych osobowych.</label>
            </div>
            
            <input type="submit" value="Popraw Ofertę" name="standard" />
          
            <a href="revise-products.php?offer_id=<?php echo $data["id"];?>" class="edit-products-link" target="_blank">Popraw produkty</a>
        </form>
        
    </div>
    <?php
    require_once "footer.php";
    ?>

    </div>
</body>
</html>
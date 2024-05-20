<?php
require_once "../conf/config.php"; 
$abspath = $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"];

if (!isset($_SESSION["uid"])) {
    header("HTTP/1.0 403 Forbidden", true, 403);
    header("Location: ". $_SERVER["BASE"]);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?> - Utwórz oferte</title>

    <noscript>
        <meta http-equiv="refresh" content="0; url=<?php echo $_SERVER["BASE"] . "src/noscript.html" ?>">
    </noscript>

    <link rel="stylesheet" href="../assets/css/createoffer.css">
    <script src="../assets/js/offer-form-controller.js" type="text/javascript" defer></script>
</head>

<a class="return-btn" href="<?php echo $_SERVER["BASE"]; ?>">&NestedLessLess;&nbsp;Powrót</a>

<?php 
    $quality = ["Used", "Damaged", "New"];
?>

<section id="offer-creation">
    <h1>Stwórz ofertę</h1>
    <div class="offer-wrapper">
        <form action="../controllers/offer-controller.php" method="post">
            <div class="offer-info">
                <div class="offer-contact">
                    <!-- <p>Wypełniając powyższe pola danych kontaktowych niniejszym wyrażasz zgodę na udostępnianie podanych danych kontaktowych innym osobom korzystającym z serwisu (przeglądającym oferty).</p> -->
                    <h3>Dane kontaktowe</h3>
                    <?php 
                        $sql = "SELECT `phone`, `email`, `discord`, `email-flag` FROM `users` WHERE email = '".$_SESSION["email"]."';";
                        $query = $conn->query($sql);
                        $result = $query->fetch_assoc();
                        $query->close();
                        ?>
                    <input type="text" name="phone" placeholder="numer telefonu" <?php echo 'value="' . $result["phone"] . '"'; ?> />
                    <input type="text" name="email" placeholder="e-mail" <?php if ($result["email-flag"] != 0) echo 'value="'. base64_decode(convert_uudecode($result["email"])) .'"';?> />
                    <input type="text" name="discord" placeholder="discord tag" <?php echo 'value="' . $result["discord"].'"'; ?> /> <!-- Discord user right here, used discord for past ... 7 years and yet I don't remember how this is now called.-->
                </div>
                <div class="offer-options">
                    <h3>Oferta ma wygasnąć po:</h3>
                    <input type="number" name="exp_days" inputmode="numeric" placeholder="Dni - min 5, max 91, puste = 14" min="5" max="91" />
                    <input type="number" name="exp_hours" inputmode="numeric" placeholder="Godziny - max 23" min="0" max="23" />
                </div>
            </div>
            
            <div class="product-list">
                <h3>Produkty</h3>
                <div class="product">
                    <select name="book[]">
                        <?php
                            $sql = "SELECT `id`, `name` FROM `booklist`";
                            $query = $conn->query($sql);
                            while ($result = $query->fetch_assoc()) {
                                echo '<option value="' . $result["id"] . '">' . $result["name"] . '</option>';
                            }
                        ?>
                    </select>
                    
                    <input type="number" name="price[]" placeholder="przewidywana cena" min="0" max="999.99" step="0.01" required /> <!-- or pattern ^\d*(\.\d{0,2})?$ -->
                    
                    <select name="quality[]">
                        <?php
                            $quality_count = count($quality);
                            for ($q = 0; $q < $quality_count; $q++){
                                echo '<option value="' . $q . '">' . $quality[$q] . '</option>';
                            }
                        ?>
                    </select>
                </div>
                
                <button type="button">Dodaj pole</button>
            </div>
            
            <label><input type="checkbox"  name="personal-data-agreement" required /> Wyrażam zgodę na opublikowanie moich danych osobowych.</label>
            <input type="submit" value="Stwórz ofertę" name="standard" />
            <input type="reset" value="Resetuj" />    
        </form>

    </div>
<!-- <label for="phone email discord">Test</label> -->
<!-- <input type="checkbox" name="phone">Numer telefonu</input>
<input type="checkbox" name="email">E-mail</input>
<input type="checkbox" name="discord">Discord</input> -->
</section>

<?php include_once $abspath."src/footer.php"; ?>

</body>
</html>
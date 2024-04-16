<?php
require_once "../conf/config.php";
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
?>

<!-- /**
* ! PROBLEM FOUND!!!! - USER SESSION MAY EXPIRE WHILST CREATING THE OFFER! 
    * ! IF USER WAS TO CREATE OFFER AFTER IT EXPIRED, DATABASE WONT SAVE THE UID UNDER THE CREATED OFFER
*/ -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="..\assets\js\offer-form-controller.js"></script>
    <noscript>
        <meta http-equiv="refresh" content="0; url=<?php echo $_SERVER["BASE"] . "src/noscript.html" ?>">
    </noscript>

    <link rel="stylesheet" href="../assets/css/createoffer.css">
    <!-- <script src="../assets/js/offer-form-controller.js" type="text/javascript" defer></script> -->
</head>


<?php
$quality = ["Used", "Damaged", "New"];
?>

<section id="offer-creation">
    <h1>Stwórz ofertę</h1>
    <div class="offer-wrapper">
        <!-- <?php
        require_once 'offer-controller.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new OfferController($conn, $_SESSION["uid"]);
            $controller->addOffer();
            exit();
        }
        ?> -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="offer-info">
                <div class="offer-contact">
                    <h3>Dane kontaktowe</h3>

                    <input type="number" name="phone" placeholder="numer telefonu">
                    <input type="text" name="email" placeholder="e-mail">
                    <input type="text" name="discord" placeholder="discord tag"> <!-- Discord user right here, used discord for past ... 7 years and yet I don't remember how this is now called.-->
                </div>
                <div class="offer-options">
                    <h3>Oferta ma wygasnąć po:</h3>
                    <input type="number" name="exp_days" inputmode="numeric" placeholder="Dni - min 5, max 91, puste = 14" min="5" max="91" />
                    <input type="number" name="exp_hours" inputmode="numeric" placeholder="Godziny - max 23" min="0" max="23" />
                </div>
            </div>

            <div id="product-list">
                <h3>Produkty</h3>
                <button type="button" onclick="newField()">Nowe pole</button>

                <div id="product">
                    <select name="book[]">
                        <?php
                        $sql = "SELECT `id`, `name` FROM `booklist`";
                        $query = $conn->query($sql);
                        while ($result = $query->fetch_assoc()) {
                            echo '<option value="' . $result["id"] . '">' . $result["name"] . '</option>';
                        }
                        ?>
                    </select>

                    <input type="number" name="price[]" min="0" max="999.99" step="0.01" required /> <!-- or pattern ^\d*(\.\d{0,2})?$ -->

                    <select name="quality[]">
                        <?php
                        $quality_count = count($quality);
                        for ($q = 0; $q < $quality_count; $q++) {
                            echo '<option value="' . $q . '">' . $quality[$q] . '</option>';
                        }
                        ?>
                    </select>

                    <input type="text" name="note[]" placeholder="opis" maxlength="80" multiline="true" />
                    <input type="file" name="image[]" accept="image/png, image/jpeg, image/gif, image/webp" />
                    <input type="file" name="image[]" accept="image/png, image/jpeg, image/gif, image/webp" />
                </div>

            </div>



            <input type="checkbox" id="publish-data-agreement" name="personal-data-agreement" required>
            <label for="publish-data-agreement">Wyrażam zgodę na opublikowanie moich danych osobowych.</label>
            <p><input type="submit" value="Stwórz Ofertę" name="standard" />
                <input type="reset" value="Wyczyść" />
            </p>
        </form>



</section>
</body>

</html>

</section>

<?php include_once $abspath . "src/footer.php"; ?>

</body>

</html>
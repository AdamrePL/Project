<?php
require_once "../conf/config.php";
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

$quality = ["Used", "Damaged", "New"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'offer-controller.php';
    $controller = new OfferController($conn, $_SESSION["uid"]);
    $controller->addOffer();
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../assets/js/offer-form-controller.js"></script>
    <noscript>
        <meta http-equiv="refresh" content="0; url=<?php echo $_SERVER["BASE"] . "src/noscript.html" ?>">
    </noscript>

    <link rel="stylesheet" href="../assets/css/createoffer.css">
    <link rel="stylesheet" href="../assets/css/global.css">
</head>

<body>
<div class="page-wrapper">
    <div class="content-wrap">
    <?php include "navbar.php";?>
    <section id="offer-creation">
        <h1>Stwórz ofertę</h1>
        <div class="offer-wrapper">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="offer-info">
                    <div class="offer-contact">
                        <h3>Dane kontaktowe</h3>
                        <input type="number" name="phone" placeholder="numer telefonu">
                        <input type="text" name="email" placeholder="e-mail">
                        <input type="text" name="discord" placeholder="discord tag">
                    </div>
                    <div class="offer-options">
                        <h3>Oferta ma wygasnąć po:</h3>
                        <input type="hidden" name="exp_hours" value="0">
                        <input type="number" name="exp_days" inputmode="numeric" placeholder="Dni - min 5, max 91, puste = 14" min="5" max="91" />
                    </div>
                </div>

                <div id="product-list">
                    <h3>Produkty</h3>
                    <button type="button" onclick="newField()">Nowe pole</button>

                    <div id="product"><!-- when user presses new field button, this div is duplicated exactly as it is -->
                        <table>
                            <tr>
                                <td>
                                    <select name="book[]">
                                        <?php
                                        $sql = "SELECT `id`, `name` FROM `booklist`";
                                        $query = $conn->query($sql);
                                        while ($result = $query->fetch_assoc()) {
                                            echo '<option value="' . $result["id"] . '">' . $result["name"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="price[]" min="0" max="999.99" step="0.01" required placeholder="cena"/>
                                </td>
                                <td>
                                    <select name="quality[]">
                                        <?php
                                        $quality_count = count($quality);
                                        for ($q = 0; $q < $quality_count; $q++) {
                                            echo '<option value="' . $q . '">' . $quality[$q] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <textarea name="note[]" id="" cols="30" rows="3"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <input type="file" name="image[]" accept="image/png, image/jpeg, image/gif, image/webp" multiple/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div id="accept">
                <input type="checkbox" id="publish-data-agreement" name="personal-data-agreement" required>
                <label for="publish-data-agreement">Wyrażam zgodę na opublikowanie moich danych osobowych.</label>
                </div>
                
                <p>
                    <input type="submit" value="Stwórz Ofertę" name="standard" />
                    <input type="reset" value="Wyczyść" />
                </p>
            </form>
        </div>
    </section>
    </div>
    <?php include_once $abspath . "src/footer.php"; ?>
</div>
</body>

</html>

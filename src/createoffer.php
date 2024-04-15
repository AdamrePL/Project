<?php
require_once "../conf/config.php"; 
$abspath = $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"];
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
    <title><?php echo SITENAME; ?> - Utwórz oferte</title>
    <script src = "..\assets\js\offer-form-controller.js"></script>
    <noscript>
        <meta http-equiv="refresh" content="0; url=<?php echo $_SERVER["BASE"] . "src/noscript.html" ?>">
    </noscript>

    <link rel="stylesheet" href="../assets/css/createoffer.css">
    <!-- <script src="../assets/js/offer-form-controller.js" type="text/javascript" defer></script> -->
</head>

<a class="return-btn" href="<?php echo $_SERVER["BASE"]; ?>">&NestedLessLess;&nbsp;Powrót</a>

<?php 
    $quality = ["Used", "Damaged", "New"];
?>

<section id="offer-creation">
    <h1>Stwórz ofertę</h1>
    <div class="offer-wrapper">
        <?php
        require_once 'offer-controller.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $controller = new OfferController($conn,$_SESSION["uid"]);
            $controller->addOffer();
            exit();
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <div class="offer-info">
                <div class="offer-contact">
                    <p>Wypełniając powyższe pola danych kontaktowych niniejszym wyrażasz zgodę na udostępnianie podanych danych kontaktowych innym osobom korzystającym z serwisu (przeglądającym oferty).</p>
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
                <button type="button" onclick = "newField()">Nowe pole</button>

                <div id="product">
                    <select name="book[]">
                        <?php
                            $sql = "SELECT `id`, `name` FROM `booklist`";
                            $query = $conn->query( $sql);
                            while ($result = $query->fetch_assoc()) {
                                echo '<option value="' . $result["id"] . '">' . $result["name"] . '</option>';
                            }
                        ?>
                    </select>
                    
                    <input type="number" name="price[]" min="0" max="999.99" step="0.01" required /> <!-- or pattern ^\d*(\.\d{0,2})?$ -->
                    
                    <select name="quality[]">
                        <?php
                            $quality_count = count($quality);
                            for ($q = 0; $q < $quality_count; $q++){
                                echo '<option value="' . $q . '">' . $quality[$q] . '</option>';
                            }
                        ?>
                    </select>
                    
                    <input type="text" name="note[]" placeholder = "opis" maxlength="80" multiline="true" />
                    <input type="file" name="image[]" accept="image/png, image/jpeg, image/gif, image/webp" />
                    <input type="file" name="image[]" accept="image/png, image/jpeg, image/gif, image/webp" />
                </div>
                
            </div>
          
          

            <input type="checkbox" id = "publish-data-agreement" name = "personal-data-agreement" required>
            <label for="publish-data-agreement">Wyrażam zgodę na opublikowanie moich danych osobowych.</label>
            <p><input type="submit" value="Create Offer" name="standard" />
            <input type="reset" value="Reset" /></p>    
        </form>


        <!-- <form action="../controllers/offer-controller.php"> // ! Zrobimy obsługę tworzenia customowych ofert po zrobieniu standardowego
                <div class="products-list">
                    <div class="product">
                        <input type="text" name="" id="">
                        <input type="text" name="" id="">
                        <input type="text" name="" id="">

                        <input type="number" name="price" pattern="^\d*\.?\d*$" min="0" max="999.99" />
                        
                        <select name="quality">
                            <?php
                                // for ($q = 0; $q < count($quality); $q++){
                                //     echo '<option value="' . $q . '">' . $quality[$q] . '</option>';
                                // }
                                ?>
                        </select>
                        
                        <input type="text" name="note" maxlength="80" multiline="true" />
                        
                                    
                        
                        <input type="image" name="image"/>
                        <input type="image" name="image1"/>
                    </div>
                    <button>Dodaj pole</button>

                    <input type="submit" value="Create Offer" name="custom" />
                    <input type="reset" value="Reset" />
                </div>
        </form> -->
    </div>


    <!-- <form>
        <label for="book">Tytuł książki</label>
        <input type="text" name="book" maxlength="" placeholder="Tytuł książki"/>

        <label for="class">Klasa</label>
        <select name="class">
            <?php 
                // $sql = "SELECT DISTINCT `class` FROM booklist;";
                // $query = mysqli_query($conn, $sql);
                // while ($result = mysqli_fetch_array($query)) {
                //     echo '<option value="' . $result["class"] . '">' . $result["class"] . '</option>';
                // }
                
            ?>
        </select>
        
        <label for="authors">Autorzy</label>
        <input type="text" name="authors"/>

        <label for="publisher">Wydawnictwo</label>
        <select name="publisher">
            <?php 
                // $sql = "SELECT DISTINCT `publisher` FROM booklist;";
                // $query = mysqli_query($conn, $sql);
                // while ($result = mysqli_fetch_array($query)) {
                //     echo '<option value="' . $result["publisher"] . '">' . $result["publisher"] . '</option>';
                // }
                
            ?>
        </select>


        <label for="subjects">Przedmiot</label>
        <select name="subjects">
            <?php 
                // $sql = "SELECT DISTINCT `subject` FROM booklist;";
                // $query = mysqli_query($conn, $sql);
                // while ($result = mysqli_fetch_array($query)) {
                //     echo '<option value="' . $result["subject"] . '">' . $result["subject"] . '</option>';
                // }
                
                // if($result["name"]!=$_GET["book"]){
                //     code above goes here
                // } else{
                //     $sql = "SELECT DISTINCT `subject` FROM booklist WHERE `name`=?;";
                //     $res = mysqli_fetch_array(mysqli_query($conn,$sql));
                //     echo '<option value="'. $res["subject"] . '">' . $res["subject"] . '</option>';
                // }
            ?>
        </select>
        
        <label for="quality">Stan książki</label>
        <select name="quality">
            <?php
                // $quality = ["Używana","Uszkodzona","Nowa"];
                // foreach($quality as $A){
                //     echo '<option value="' . $A . '">' . $A . '</option>'; 
                // }
            ?>
        </select>

        <label for="price">Cena</label>
        <input type="number" name="price" minlength="1" maxlength="2" aria-multiline="false"/>

        <label for="note">Krótki opis</label>
        <input type="text" name="note" maxlength="125" aria-multiline="true"/>
            
        <label for="phone email discord">Test</label>
        <input type="checkbox" name="phone">Numer telefonu</input>
        <input type="checkbox" name="email">E-mail</input>
        <input type="checkbox" name="discord">Discord</input>

        <input type="file" name="image"/>
        <input type="file" name="image1"/>

        <input type="submit" value="Create Offer" />
        <input type="reset" value="Reset" />
    </form>
</div>
                -->

                </section>
                <?php include_once $abspath."src/footer.php"; ?>
                </body>
                </html>

</section>

<?php include_once $abspath."src/footer.php"; ?>

</body>
</html>
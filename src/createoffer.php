<?php require_once "../conf/config.php"; ?>

<!-- /**
* ! PROBLEM FOUND!!!! - USER SESSION MAY EXPIRE WHILST CREATING THE OFFER! 
    * ! IF USER WAS TO CREATE OFFER AFTER IT EXPIRED, DATABASE WONT SAVE THE UID UNDER THE CREATED OFFER

* ! PROBLEM FOUND!!!! - USER SESSION MAY EXPIRE WHILST CREATING THE OFFER! 
    * ! IF USER WAS TO CREATE OFFER AFTER IT EXPIRED, DATABASE WONT SAVE THE UID UNDER THE CREATED OFFER

* ! PROBLEM FOUND!!!! - USER SESSION MAY EXPIRE WHILST CREATING THE OFFER! 
    * ! IF USER WAS TO CREATE OFFER AFTER IT EXPIRED, DATABASE WONT SAVE THE UID UNDER THE CREATED OFFER
*/ -->

<head>

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
        <form action="../controllers/offer-controller.php" method="post" enctype="multipart/form-data">
            <div class="offer-info">
                <div class="offer-contact">
                    <h3>Dane kontaktowe</h3>
                    <input type="text" name="phone" placeholder="numer telefonu" />
                    <input type="text" name="email" placeholder="e-mail" />
                    <input type="text" name="discord" placeholder="discord tag" /> <!-- Discord user right here, used discord for past ... 7 years and yet I don't remember how this is now called.-->
                </div>
                <div class="offer-options">
                    <h3>Oferta ma wygasnąć po:</h3>
                    <input type="number" name="exp_days" inputmode="numeric" placeholder="Dni" min="5" max="91" />
                    <input type="number" name="exp_hours" inputmode="numeric" placeholder="Godziny" min="0" max="23" />
                </div>
            </div>
            
            <div class="product-list">
                <h3>Produkty</h3>
                <div class="product">
                    <select name="book[]">
                        <?php
                            $sql = "SELECT `id`, `name` FROM `booklist`";
                            $query = mysqli_query($conn,$sql);
                            while ($result = mysqli_fetch_array($query)) {
                                echo '<option value="' . $result["id"] . '">' . $result["name"] . '</option>';
                            }
                        ?>
                    </select>
                    
                    <input type="number" name="price[]" min="0" max="999.99" step="0.01" required /> <!-- or pattern ^\d*(\.\d{0,2})?$ -->
                    
                    <select name="quality[]">
                        <?php
                            for ($q = 0; $q < count($quality); $q++){
                                echo '<option value="' . $q . '">' . $quality[$q] . '</option>';
                            }
                        ?>
                    </select>
                    
                    <input type="text" name="note[]" maxlength="80" multiline="true" />
                    <input type="file" name="first_img[]" accept="image/png, image/jpg, image/jpeg" />
                    <input type="file" name="first_img[]" accept="image/png, image/jpg, image/jpeg" />
                </div>
                
                <button type="button">Dodaj pole</button>
            </div>
            <!-- Tutaj opcjonalnie dodać opis oferty? max 120 znaków -->
            <input type="submit" value="Create Offer" name="standard" />
            <input type="reset" value="Reset" />
        </form>

        <!-- <form action="../controllers/offer-controller.php"> // ! Zrobimy obsługę tworzenia customowych ofert po zrobieniu standardowego
                <div class="products-list" data-selected="0">
                    <div class="product">
                        <input type="text" name="" id="">
                        <input type="text" name="" id="">
                        <input type="text" name="" id="">

                        <input type="number" name="price" pattern="^\d*\.?\d*$" min="0" max="999.99" />
                        
                        <select name="quality">
                            <?php
                                for ($q = 0; $q < count($quality); $q++){
                                    echo '<option value="' . $q . '">' . $quality[$q] . '</option>';
                                }
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
</section>



<!-- <div class="custom_offerCreate" style="padding-top: 5rem;" id="formCustom">
    <form>
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
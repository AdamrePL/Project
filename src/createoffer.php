<?php require_once "../conf/config.php"; ?>

<head>
    <link rel="stylesheet" href="../assets/css/createoffer.css">
</head>

<a href="../"> << Powrót</a>

<section id="offer-creation">
    <h1>Stwórz ofertę</h1>

    <div class="create-offer-wrapper">
        <div class="create-list" data-selected="1">
            <form action="../controllers/offer-controller.php" method="post">
                <div class="offer-info">
                    <input type="text" name="phone">Numer telefonu</input>
                    <input type="text" name="email">E-mail</input>
                    <input type="text" name="discord">Discord</input>
                </div>

                <div class="books">
                    
                </div>
                <select name="book">
                    <?php
                        $sql = "SELECT DISTINCT `name` FROM booklist";
                        $query = mysqli_query($conn,$sql);
                        while ($result = mysqli_fetch_array($query)) {
                            echo '<option value="' . $result["name"] . '">' . $result["name"] . '</option>';
                        }
                    ?>
                </select>
                
                <input type="number" name="price" maxlength="5" max="999.99" />

                <select name="quality">
                    <?php
                        $quality = ["Used", "Damaged", "New"];
                        for ($q = 0; $q < count($quality) - 1; $q++){
                            echo '<option value="' . $q . '">' . $quality[$q] . '</option>';
                        }
                    ?>
                </select>
                
                <input type="text" name="note" maxlength="80" multiline="true" />

                
            </form>
        </div>
        <div class="create-custom" data-selected="0">

        </div>
    </div>


</section>


        <input type="file" name="image"/>
        <input type="file" name="image1"/>

        <input type="submit" value="Create Offer" />
        <input type="reset" value="Reset" />
    </form>
</div>



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
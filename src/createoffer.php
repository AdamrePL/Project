<?php require_once "../conf/config.php"; ?>

<head>
    <link rel="stylesheet" href="../assets/css/createoffer.css">
</head>

<a href="../"> << Powrót</a>
<h1>Stwórz ofertę</h1>

<div class="offerCreateFromDB">
    <form action="../controllers/offer-controller.php" method="post" id="formDB">

        <label for="book">Tytuł książki</label>
        <select name="book">
            <?php
                $sql = "SELECT DISTINCT `name` FROM booklist";
                $query = mysqli_query($conn,$sql);
                while ($result = mysqli_fetch_array($query)) {
                    echo '<option value="' . $result["name"] . '">' . $result["name"] . '</option>';
                }
            ?>
        </select>

        <label for="quality">Stan książki</label>
        <select name="quality">
            <?php
                $quality = ["Używana","Uszkodzona","Nowa"];
                foreach($quality as $A){
                    echo '<option value="' . $A . '">' . $A . '</option>'; //trying to format html embedded in php is a pain lmao
                }
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
</div> -->

<h2>Last login: <?php date("H:i, d.m.Y", strtotime($row['last-login'])); ?></h2>
<h2>Joined: <?php date("d.m.Y", strtotime($row['join-date'])); ?></h2>
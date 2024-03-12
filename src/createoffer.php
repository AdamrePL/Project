<?php require_once "../conf/config.php"; ?>

<div class="offerCreate">

    <a href="../"> << Powrót</a>
    <h1>Stwórz ofertę</h1>
    <form action="../controllers/offer-controller.php" method="post">

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
            
        <label for="subjects">Przedmiot</label>
        <select name="subjects">
            <?php //? TODO:maybe try matching subject to title automatically i.e Polish book is automatically set to polish subject? 
                $sql = "SELECT DISTINCT `subject` FROM booklist;";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_array($query)) {
                    echo '<option value="' . $result["subject"] . '">' . $result["subject"] . '</option>';
                }
            ?>
        </select>

        <input type="file" name="image"/>
        <input type="file" name="image1"/>

        <input type="submit" value="Create Offer" />
        <input type="reset" value="Reset" />
    </form>
</div>

<?php 
// $titles = [];
// $subjects = [];
// $json_data = file_get_contents("../assets/downloads/booklist.json");
// $json_data = json_decode($json_data);
// $clarity = 0;
// foreach ($json_data as $klasa => $value) { //Classes
//     echo "Yippe!<br>";
//     foreach($value as $ksiazka => $dane){//OBJECT ITSELF!
//         $dane = json_decode(json_encode($dane), true);
//         array_push($titles,$dane["nazwa"]);
//         array_push($subjects,$dane["przedmiot"]);
//     }
// }
// print_r($titles);
// echo '<br>';
// print_r($subjects);
?>
<h2>Last login: <?php date("H:i, d.m.Y", strtotime($row['last-login'])); ?></h2>
<h2>Joined: <?php date("d.m.Y", strtotime($row['join-date'])); ?></h2>
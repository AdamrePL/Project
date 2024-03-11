<?php require_once "../conf/config.php"; ?>

<div class="offerCreate">
    <h1>Testing</h1>
    <form action="../controllers/offer-controller.php" method="post">
        <input type="file" name="image"/>
        <input type="file" name="image1"/>
        <select name="book">
        <?php
            $sql = "SELECT DISTINCT `name` FROM booklist";
            $query = mysqli_query($conn,$sql);
            while ($result = mysqli_fetch_array($query)) {
                echo '<option value="' . $result["name"] . '">' . $result["name"] . '</option>';
            }
        ?>
        </select>
        <select name="quality">
            <?php
            $quality = ["Używana","Uszkodzona","Nowa"];
            foreach($quality as $A){
                echo '<option value="' . $A . '">' . $A . '</option>'; //trying to format html embedded in php is a pain lmao
            }
            ?>
        </select>
        <input type="number" name="price"/>
        <input type="text" name="note"/>
        <input type="checkbox" name="phone">fone</input>
        <input type="checkbox" name="email">mail</input>
        <input type="checkbox" name="discord">the cord</input>
        <select name="subjects">
            <?php $sql = "SELECT DISTINCT `subject` FROM booklist;";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_array($query)) {
                    echo '<option value="' . $result["subject"] . '">' . $result["subject"] . '</option>';
                }
            ?>
        </select>
        <input type="submit" value="Create Offer" />
        <input type="reset" value="Reset" />
    </form>
</div>


<h2>Last login: <?php date("H:i, d.m.Y", strtotime($row['last-login'])); ?></h2>
<h2>Joined: <?php date("d.m.Y", strtotime($row['join-date'])); ?></h2>
<?php require_once "../conf/config.php"; ?>

<head>
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>

<section id="user-details">
<?php
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uuid = 'tester#aA1'");
    $result = mysqli_fetch_assoc($query);
?>
    <div class="user">
        <h3 class="username"><?php echo $result["username"] ?></h3>
        <div clas="user-id">
            <span class="uid"><?php echo $result["uuid"]; ?></span>
            <!-- <template> -->
                <span>Are you sure you want to display sensitive information?</span>
                <button type="button" class="agree">Pokaż</button>
                <button type="button" class="disagree">Anuluj</button>
            <!-- </template> -->
        </div>
    </div>

    <div class="contact">
        <p><?php echo !empty($result["phone"]) ? $result["phone"] : "Nr tel."; ?></p>
        <p><span><?php echo $result["email"]; ?></span><input type="checkbox" name="" id="" /></p>
        <p><?php echo !empty($result["discord"]) ? $result["discord"] : "Discord"; ?></p>
        <a href="?page=user-settings"><button>Edytuj</button></a>
    </div>
</section>

<section class="user-offers">
    <div>
    </div>
    <?php
        // $_SESSION["uid"] = "tester#aA1";
        // $sql = "SELECT offers.*, users.username, users.uuid FROM `offers`, `users` WHERE 'offers.user-uuid'='users.uuid' AND users.uuid = " . $_SESSION["uid"] . ";";
        // $query = mysqli_query($conn, $sql);
        // while ($result = mysqli_fetch_assoc($query)) {
        //     echo '<div>' . $result["products"] . '<br>' . $result["offer-cdate"] . '</div>';
        // }
    ?>
</section>

<?php if (isset($_GET["page"]) && $_GET["page"] == "user-settings") {
    include_once "user-settings.php";
} ?>

<div class="overlay">
    <script src="../assets/js/script.js" defer></script>
    <div class="overlay-wrapper"></div>
    <p class="overlay-msg">Click anywhere outside of the box to close</p>
</div>
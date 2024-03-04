<?php require_once "config.php"; ?>

<head>
    <link rel="stylesheet" href="assets/css/profile.css">
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
                <button type="button">tak</button>
                <button type="button">Anuluj</button>
            <!-- </template> -->
        </div>
    </div>

    <div class="contact">
        <p><?php echo !empty($result["phone"]) ? $result["phone"] : "Nr tel."; ?></p>
        <p><span><?php echo $result["email"]; ?></span><input type="checkbox" name="" id="" /></p>
        <p><?php echo !empty($result["discord"]) ? $result["discord"] : "Discord"; ?></p>
    </div>
</section>

<section class="user-offers">
    <div>

    </div>
    <?php
        $sql = "SELECT * FROM `offers`,`users`,`products` WHERE 'users.uuid' = 'offers.user-uuid' AND 'offers.product-id' == 'products.id';";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query))
    ?>
</section>
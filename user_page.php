<?php require_once "config.php"; ?>
<!--user page-->
    <?php
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uuid = 'tester#aA1'");
        while ($result = mysqli_fetch_assoc($query)) {
            print_r( $result );
        }
    ?>

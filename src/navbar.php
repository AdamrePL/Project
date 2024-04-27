<link rel="stylesheet" href="../assets/css/navbar.css">
<div class="navbar">
    <ul>
        <div class="navbar-left">
            <li><a href="<?php echo $_SERVER["BASE"] . "index.php"?>">główna</a></li>
            <li><a href="<?php echo $_SERVER["BASE"] . "src/offer-list.php"?>">oferty</a></li>
            <li><a href="<?php echo $_SERVER["BASE"] . "src/booklist.php"?>" id="list">lista podręczników</a></li>
        </div>
        <div class="navbar-right">
            <li>
                <?php echo !isset($_SESSION["uid"]) ?  '<a href="'. $_SERVER["BASE"] .'src/access.php">zaloguj się</a>' : '<a href="'.$_SERVER["BASE"].'src/profile.php">mój profil</a>'; ?>
            </li>
        </div>
    </ul>
</div>
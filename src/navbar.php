<link rel="stylesheet" href="assets/css/navbar.css">
<div class="navbar">
    <ul>
        <div class="navbar-left">
            <li><a href="index.php">główna</a></li>
            <li><a href="#">oferty</a></li>
            <li><a href="src/booklist.php" id="list">lista podręczników</a></li>
        </div>
        <div class="navbar-right">
            <li>
                <?php echo !isset($_SESSION["uid"]) ? '<a href="src/access.php">zaloguj się</a>' : '<a href="src/profile.php">mój profil</a>'; ?>
            </li>
        </div>
    </ul>
</div>
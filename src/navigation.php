<head>
    <title>yipee</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/navigation.css">
</head>

<body>
    <menu>
        <a href="../#nawigacja">Navigate</a>
        <a href="../">Main</a>
        <a href="booklist.php">Book List </a>
        <a href="../#przegladaj"> Browse </a>
        <span>
            <!--//*!if session with "uid" is not set then do shit-->
            <a href="access.php" id="log"><?php  echo !isset($_SESSION["uid"]) ? "Log In" : "Log Out"; ?></a>
            <a href="profile.php" id="prof">Profile</a>
        </span>
    </menu>
</body>
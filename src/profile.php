<?php require_once "../conf/config.php"; ?>
<?php 
if (!isset($_SESSION["uid"])) {
    header("Location: /");
}

?>
<head>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <script src="../assets/js/profile-controller.js" defer></script>
</head>

<body>
<?php
    if (!isset($_GET["page"])) {
        $_GET["page"]="profile";
    }
    switch ($_GET["page"]) {
        case "settings":
            echo '<a class="return-btn" href="profile.php">&NestedLessLess; Powrót</a>

            <div class="user-settings-wrapper">
                <h1>User Settings</h1>
            
                <form action="../controllers/profile-controller.php" method="post" type="">
                    <label for="new_password">change password</label>
                    <input type="text" name="new_password" placeholder="new password" />
                    
                    <label for="con_password">confirm password</label>
                    <input type="text" name="con_password" placeholder="confirm new password" />
            
                    <label for="email_adress">enter email:</label>
                    <input type="email" name="email_adress" placeholder="email" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$"/>
            
                    <label for="telephone_number">enter phone number</label>
                    <input type="tel" name="telephone_number" placeholder="phone number" pattern="\d{3}[-\s]?\d{3}[-\s]?\d{3}" minlength="9"/> <!-- inputmode="numeric" -->
                    
                    <label for="discord_user">enter discord username</label>
                    <input type="text" name="discord_user" placeholder="discord username" />
            
                    <label for="email_flag">Autocomplete email as contact form?</label>
                    <input type="checkbox" name="email_flag" />
            
                    <span>
                        <button type="submit" id="confirm">confirm</button>
                        <button type="button" id="cancel">cancel</button>
                    </span>
                <form>
            </div>';
            
            //* EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
            //? uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$
        break;

        default:
            echo '<section id="user-details">';
                $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uuid = '" . $_SESSION["uid"] . "'");
                $result = mysqli_fetch_assoc($query);
            echo '
                <div class="user">
                    <h3>'. $result["username"] .'</h3>
                    <div class="user-id">
                        <span class="uid"></span>
                    </div>
                </div>
                ';
                
                echo '<div class="contact">';
                    echo '<p>';
                    echo !empty($result["phone"]) ? $result["phone"] : "Nr tel.";
                    echo '</p>';
                    echo '<p><span>'. base64_decode(convert_uudecode($result["email"])) .'</span><input type="checkbox" name="" id="" /></p>';
                    echo '<p><i class="fa-brands fa-discord"></i>'. !empty($result["discord"]) ? $result["discord"] : "Discord";
                    echo '</p><a href="?page=settings"><button>Edytuj</button></a>';
                echo '</div>';
            echo '</section>';
            
            echo '<section class="user-offers">';
                echo '<div class="offer"></div>';
                    // $_SESSION["uid"] = "tester#aA1";
                    // $sql = "SELECT offers.*, users.username, users.uuid FROM `offers`, `users` WHERE 'offers.user-uuid'='users.uuid' AND users.uuid = " . $_SESSION["uid"] . ";";
                    // $query = mysqli_query($conn, $sql);
                    // while ($result = mysqli_fetch_assoc($query)) {
                    //     echo '<div>' . $result["products"] . '<br>' . $result["offer-cdate"] . '</div>';
                    // }
            echo '</section>';
        break;
    }
?>
</body>
<!-- <div class="overlay">
    <script src="../assets/js/script.js" defer></script>
    <div class="overlay-wrapper"></div>
    <p class="overlay-msg">Click anywhere outside of the box to close</p>
</div> -->
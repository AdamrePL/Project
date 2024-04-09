<?php
//&almost done
function showData(){
    // require_once "conf/config.php"; 
    require_once $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"]."clases/Offer.php";
    // $sql = "SELECT phone, email, discord FROM offers";
    // $query = mysqli_query($conn,$sql);
    

    echo '<div id="data-block">';
            echo $result["phone"];
            echo $result["email"];
            echo $result["discord"];
    echo '</div>';

    // What's this for? - @AdamrePL
    // if you want to load data dynamicaly using javascript from a database, I recommend checking out XMLHttpRequest() (in other words AJAX) and our code https://github.com/AdamrePL/Project/blob/forms-styling/assets/js/profile-controller.js
}
?>  

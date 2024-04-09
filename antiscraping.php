<?php
//&almost done
function showData(){
    // require_once "conf/config.php"; 
    require_once $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"]."/clases/Offer.php";
    // $sql = "SELECT phone, email, discord FROM offers";
    // $query = mysqli_query($conn,$sql);
    

    echo '<div id = "data-block">';
            echo $result["phone"];
            echo $result["email"];
            echo $result["discord"];
    echo '</div>';
}
?>  
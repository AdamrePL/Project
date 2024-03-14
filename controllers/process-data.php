<?php
require_once "../conf/config.php";
include_once "account-controller.php";


if (isset($_SESSION["uuid"])) {
    header("Location: ");
}

//? whuh? there doesn't even exist a single field named "log" or "reg" . . . ?
// if (!isset($_POST["log"]) || !isset($_POST["reg"])) {
//     header("Location: ../src/access.php?error=brakdanych");
// }

$a = $_POST["username"];
$b = $_POST["email"];
$c = $_POST["r_password"];
$cc = $_POST["r_password-repeat"];
$sql = "SELECT * FROM `users`;";
$user_table = mysqli_fetch_array(mysqli_query($conn,$sql));

if(!user_exists($conn,generate_id($a))){
    echo "flare 1";
    echo $a,$b,$c,$cc;
    if(!in_array($a,$user_table)){
        echo "flare2";
        create_user($conn,$a,$b,$c); //something's wrong with this idfk
        header("Location: ../src/profile.php");
    } else{
        echo "flare3";
    }
} else {
    echo "critical failure";
}

// create_user($conn,$a,$b,$c);

?>;
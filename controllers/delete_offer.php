<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];

require_once $abspath . "conf\config.php";

if (isset($_SESSION["uid"]) and isset($_POST["offer_id"])){
    $uid = $_SESSION["uid"];
    $offer_id = $_POST["offer_id"];

    $sql = "DELETE FROM `offers` WHERE `id` = ? and `user-uuid` = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt,"ss", $offer_id, $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $affected = mysqli_affected_rows($conn);
    mysqli_stmt_close($stmt);
    if ($affected > 0){
        header("Location: ../src/profile.php");
        exit(200);
        // echo "success";
    } else {
        header("Location: ../src/profile.php");
        exit(403);
    }
}
?>
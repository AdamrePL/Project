<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once $abspath . 'conf/config.php';

if (!isset($_SESSION["isadmin"]) || $_SESSION["isadmin"] == false) {
    header("Location: /");
    exit(403);
}

mysqli_query($conn,"TRUNCATE TABLE `booklist`;");

$json_data = file_get_contents("$abspath.assets/downloads/booklist.json");
$json_data = json_decode($json_data);
foreach ($json_data as $klasa => $value) { // class loop
    $class = $klasa;
    echo '<h1>Klasa: ' . $class . '</h1>';
    foreach ($value as $ksiazka => $dane) { // object loop
        $dane = get_object_vars($dane); // $dane = json_decode(json_encode($dane), true);
        echo "<br><br>";
        $title = $dane["nazwa"];
        $author = $dane["autorzy"];
        $publisher = $dane["wydawnictwo"];
        $subject = $dane["przedmiot"];

        //& note to self: set record count to 500 in phpMyAdmin to avoid 30 minutes of debugging perfectly fine code
        if (!empty($title)) {
            $sql = "INSERT INTO `booklist` VALUES('',?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 'ssiss', $title, $subject, $class, $author, $publisher);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

?>
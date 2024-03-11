<?php 
require_once "../conf/config.php";

$search = $_GET["search"];
$sql = "SELECT * FROM `offers` WHERE JSON_UNQUOTE(JSON_EXTRACT(`products`, '$.name')) LIKE ? LIMIT 3";
// this should work???

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt); 
$result = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}

?>
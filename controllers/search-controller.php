<?php 
require_once "../conf/config.php";

$search = '{"name": "' . $_GET["search"] . '"}';
// $sql = "SELECT 
// `jt`.*
// FROM 
// `offers`,
// JSON_TABLE(
//     `products`,
//     '$[*]'
//     COLUMNS (
//         name VARCHAR(255) PATH '$.name',
//         author VARCHAR(255) PATH '$.author',
//         publisher VARCHAR(255) PATH '$.publisher',
//         subject VARCHAR(255) PATH '$.subject',
//         class INT PATH '$.class',
//         price DECIMAL(10, 2) PATH '$.price',
//         quality VARCHAR(255) PATH '$.quality',
//         note VARCHAR(255) PATH '$.note',
//         img1 VARCHAR(255) PATH '$.img[0]',
//         img2 VARCHAR(255) PATH '$.img[1]',
//         custom BOOLEAN PATH '$.custom'
//     )
// ) AS jt";
$sql = "SELECT * FROM offers WHERE JSON_CONTAINS(products, ?)";

// this should work???
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt); 
$result = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    echo json_encode(json_decode($row["products"])[0], JSON_PRETTY_PRINT);
}

?>
<head><link rel="stylesheet" href="../assets/css/test.env.css"></head>


<?php
    echo '<a href="'.ltrim(dirname(str_replace("\\", "/", __DIR__)), $_SERVER["DOCUMENT_ROOT"]) . '">test</a>';
    echo '<a href="../">etete</a>';
    ?>

<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/conf/test.php";

echo '<a href=/'.ltrim(str_replace("\\", "/", __DIR__), $_SERVER["DOCUMENT_ROOT"]).'>wewe</a>';
echo ltrim(dirname(dirname(str_replace("\\", "/", $_SERVER["SCRIPT_FILENAME"]))), $_SERVER["DOCUMENT_ROOT"]);

// $url = $_SERVER["REQUEST_URI"];
$url = ltrim(dirname(str_replace("\\", "/", __DIR__)), $_SERVER["DOCUMENT_ROOT"]);
$url_array = explode("/", $url);
$slash_count = count($url_array) - 1;
$result_url = "";
for ($i = 0; $i < $slash_count; $i++) {
    $result_url = $result_url . "../";
}
?>

<!-- OOHOHOHO!??!?? IT WORKS???! -->
<!-- NVM IT DOESNT IN INDEX.PHP -->

<?php

function get_subdir_count(string $te, int $count = 0, int $pos = 0) {
    $pos = strpos($te, "\\", $pos + 1);
    if ($pos !== false) {
        $count++;
        return get_subdir_count($te, $count, $pos);
    }
    return $count;
}

echo get_subdir_count(getcwd());

// ! AND THEN I REALIZED I CAN DO : 

$cnt = 0;
$ps = strpos(getcwd(), "\\", 0);
while ($ps !== false) {
    $cnt++;
    $ps = strpos(getcwd(), "\\", $ps + 1);
}

echo $cnt;

echo "<h1>Overview:</h1>";

echo "<br> " . getcwd();
echo '<br><a href="/conf/config.php">base</a>';
// echo '<br>' . $_SERVER["SERVER_NAME"];
echo '<br>';
echo '<br>' . $_SERVER["DOCUMENT_ROOT"];
echo ' + ';
echo $_SERVER["REQUEST_URI"];
echo '<br> = '. $_SERVER['SCRIPT_FILENAME'];
echo '<br>';


echo '<br>' . __FILE__;
echo '<br>' .  str_replace("\\", "/", __DIR__);
echo '<br>' .  dirname(str_replace("\\", "/", __DIR__));

echo '<table>';
echo '<h5>';
print_r($_POST);
echo '</h5>';
echo '<tr>
    <th>'.str_replace(" ", "", $_POST["phone"]).'</th>
    <th>'.str_replace(" ", "", $_POST["discord"]).'</th>
    <th>'.str_replace(" ", "", $_POST["email"]).'</th>
    </tr>';
for($i = 0; $i < count($_POST["book"]); $i++) {
    echo '<tr>
        <td>Book name: '.str_replace(" ", "", $_POST["book"][$i]).'</td>
            <td>'.str_replace(" ", "", $_POST["book"][$i]).'</td>
            <td>'.str_replace(" ", "", $_POST["price"][$i]).'</td>
            <td>'.str_replace(" ", "", $_POST["quality"][$i]).'</td>
            <td>'.str_replace(" ", "", $_POST["note"][$i]).'</td>
        </tr>';
}

echo '<h5>';print_r($_FILES); echo '</h5>';
echo '</table>';
?>

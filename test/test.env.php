<?php
// header('HTTP/1.0 403 Forbidden', true, 403); # HTTP/1.1 also works but may not be compatibile everywhere
// exit();

// OR

// http_response_code(403);
// exit();

echo '<a href=' . $_SERVER["BASE"] .'>mamamia</a>';
include_once $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"] . "conf/test.php";


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
echo $_SERVER["DOCUMENT_ROOT"].' + '.$_SERVER["REQUEST_URI"];
echo '  = '. $_SERVER['SCRIPT_FILENAME'];
echo '<br>' . __FILE__;
echo '<br>' .  str_replace("\\", "/", __DIR__);
echo '<br>' .  dirname(str_replace("\\", "/", __DIR__));

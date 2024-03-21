<head><link rel="stylesheet" href="../assets/css/test.env.css"></head>

<?php include_once "../conf/test.php" ?>

<?php
    echo '<a href="'.ltrim(dirname(str_replace("\\", "/", __DIR__)), $_SERVER["DOCUMENT_ROOT"]) . '">test</a>';
    echo '<a href="../">etete</a>';
?>

<?php
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
echo '<br>';
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

echo '<br><br><br>';
print_r($_POST);
echo str_replace(" ", "", $_POST["phone"]);
echo '<br><br><br>';
print_r($_FILES);
?>

<p>
    Nulla aute excepteur aliquip aliqua do dolore. Magna excepteur aliqua ipsum et amet esse nulla ex ex deserunt esse amet voluptate. Mollit quis occaecat eiusmod esse quis consequat mollit ipsum sunt sunt duis consequat eiusmod. Lorem ipsum consequat exercitation ex qui et anim quis anim in elit sit. Mollit ad elit sunt consequat cupidatat anim excepteur cupidatat eu consectetur officia nisi occaecat velit. Qui elit anim ipsum sint esse in ad mollit quis est labore exercitation ad ea.
</p>
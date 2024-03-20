<head><link rel="stylesheet" href="../assets/css/test.env.css"></head>

<?php
echo "<br> " . getcwd();
echo '<br>';

echo '<br>' . $_SERVER["DOCUMENT_ROOT"];
echo ' + ';
echo $_SERVER["REQUEST_URI"];
echo '<br> =';

echo '<br>' . $_SERVER['SCRIPT_FILENAME'];
echo '<br>';
echo '<br>' . __FILE__;
echo '<br>' .  __DIR__;

echo '<br><br><br>';
print_r($_POST);
echo str_replace(" ", "", $_POST["phone"]);
echo '<br><br><br>';
print_r($_FILES);
?>

<p>
    Nulla aute excepteur aliquip aliqua do dolore. Magna excepteur aliqua ipsum et amet esse nulla ex ex deserunt esse amet voluptate. Mollit quis occaecat eiusmod esse quis consequat mollit ipsum sunt sunt duis consequat eiusmod. Lorem ipsum consequat exercitation ex qui et anim quis anim in elit sit. Mollit ad elit sunt consequat cupidatat anim excepteur cupidatat eu consectetur officia nisi occaecat velit. Qui elit anim ipsum sint esse in ad mollit quis est labore exercitation ad ea.
</p>
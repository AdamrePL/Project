<?php 
echo $_SERVER["REQUEST_URI"];
echo '<br>' . $_SERVER["DOCUMENT_ROOT"];
echo "<br> " . getcwd();
echo '<br>';
echo '<br>' . $_SERVER['SCRIPT_FILENAME'];
echo '<br>';
echo '<br>' . __FILE__;
echo '<br>' .  __DIR__;
?>

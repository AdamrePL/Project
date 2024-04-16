<link rel="stylesheet" href="assets/css/global.css">
<?php
require_once "classes/Footer.php";
ob_start(); // Footer content is to be pasted below, between the ending php tag and and the starting tag
?>
<footer>
    <p><a href="/src/terms-of-service.php">Warunki świadczenia usług</p></a>
    <p>&copy;<span title="TLiMC&#013;Technikum Łączności i Multimediów Cyfrowych"><a target="_blank" href="https://tlimc.szczecin.pl/">TŁiMC</a></span> 2024</p>
    <p id = "creators">Adamre | Browar | chopa113 | derfie | anaxar </p>
</footer>
<?php
$footer = new Footer(ob_get_clean());
$footer->render_footer();

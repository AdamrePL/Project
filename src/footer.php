<link rel="stylesheet" href="assets/css/footer.css">
<?php
require_once "classes/Footer.php";
ob_start(); // Footer content is to be pasted below, between the ending php tag and and the starting tag
?>
<footer><span title="TLiMC&#013;Technikum Łączności i Multimediów Cyfrowych"><a target="_blank" href="https://tlimc.szczecin.pl/">TŁiMC</a></span>
<!-- <span title="Github&#013;AdamrePL"><i class="fa-brands fa-github"></i><a target="_blank" href="https://github.com/AdamrePL/Project">Github</a></span> -->
<p>&copy; 2024 Adamre | Browar | chopa113 | derfie | anaxar</p>

<footer>
<?php
$footer = new Footer(ob_get_clean());
$footer->render_footer();

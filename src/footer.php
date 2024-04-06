<?php
require_once $_SERVER["DOCUMENT_ROOT"].$_SERVER["BASE"]."classes/Footer.php";
ob_start(); // Footer content is to be pasted below, between the ending php tag and and the starting tag
?>

<span title="TLiMC&#013;Technikum Łączności i Multimediów Cyfrowych"><a target="_blank" href="https://tlimc.szczecin.pl/">TLiMC</a></span>
<!-- <span title="Github&#013;AdamrePL"><i class="fa-brands fa-github"></i><a target="_blank" href="https://github.com/AdamrePL/Project">Github</a></span> -->
<P>&copy; Made by Adamre and Browar - 2024</P>

<?php
$footer = new Footer(ob_get_clean());
$footer->render_footer();

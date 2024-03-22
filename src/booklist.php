<?php require_once "../conf/config.php"; ?>
<head>
    <title><?php echo SITENAME . " - "; ?>Spis Książek</title>
    <link href="../assets/css/booklist.css" type="text/css" rel="stylesheet">
</head>

<body>
<!-- //& <section> Tutaj dodać filtrowanie książek po klasie i przedmiocie </section> -->
<section id="booklist">
    <h1>Spis Książek</h1>

    <?php 
        $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC, `subject`";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            echo '<div class="card">';
                echo '<span>';
                    echo '<p>'. $result["name"] .'</p>';
                    echo '<p>Klasa - '. $result["class"] .'</p>';
                echo '</span>';


                echo '<ul>';
                    echo '<li> Przedmiot: '. $result["subject"] .'</li>';
                    echo '<li> Wydawnictwo: '. $result["publisher"] .'</li>';
                    echo '<li> Autorzy: ';
                    $authors = explode(",", $result["authors"]);
                    $authors_count = count($authors);
                        for ($index = 0; $index < $authors_count; $index++) {
                            if ($index != $authors_count - 1) {
                                echo $authors[$index] . ", ";
                            } else {
                                echo $authors[$index];
                            }
                        }
                    echo '</li>';
                echo '</ul>';
            echo '</div>';
        }
    ?>
</section>

<section id="booklist-files">
    <h1>Zawartość do pobrania</h1>
    <a href="../assets/downloads/booklist.json" download>Uzupełniony - przykładowy plik przygotowawczy</a>
    <a href="../assets/downloads/booklist_template.json" download>Plik przygotowawczy dla wstawienia książek na stronę</a>
</section>

<?php
    include_once "footer.php";
?>

</body>
<?php require_once "../conf/config.php"; ?>

<head>
    <title><?php echo SITENAME . " - "; ?>Spis Książek</title>
    <link href="../assets/css/booklist.css" type="text/css" rel="stylesheet">
    <script src="../assets/js/booklist.js"></script>

</head>

<body>
    <!-- //& <section> Tutaj dodać filtrowanie książek po klasie i przedmiocie </section> -->

    <div class="side-panel" id="side-panel-booklist">
        <h2 class="title" id="side-panel-title">Zawężanie wyników</h2>
        <div class="side-panel-group" id="side-panel-subjects">

            <br>
            <h4>Przedmiot</h4>

            <?php
            $sql = "SELECT DISTINCT subject FROM booklist";
            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)) {
                echo '<p class = "filter-subject" > <a href = "/src/booklist.php?subject=' . $result["subject"] . '">' . $result["subject"] . '</p></a>';
                // echo '<hr>';
            }
            ?>
        </div>

        <div class="side-panel-group" id="side-panel-grades">
            <br>
            <h4>Klasa</h4>
            <p>
                <?php
                $sql = "SELECT DISTINCT class FROM booklist";
                $query = mysqli_query($conn, $sql);
                
                for ($i = 1; $i<6; $i++){
                    echo '<span  class = "btn-filter ">' . $i .'</span>';
                }
                // while ($result = mysqli_fetch_assoc($query)) {
                    
                // }
                //&tutaj bedzie sprawdzanie czy filter jest dostępny, żeby każda klasa się wyświetlała
                //&np. jak nie będzie produktów dla danej klasy czyli w aktualnym przypadku (10.04) nie ma dla klasy 3 i 4,
                //&to będzie wyświetlana ona z jakimiś charakterystycznymi stylami
                ?></p>
        </div>
    </div>


    <section id="booklist">
        <h1 id="books-title">Spis Książek</h1>
        <button onclick= "toggleSide_Panel()" class="btn-filter" id="btn-show">☰</button>
        <?php
        if(isset($_GET["subject"])){
        $sql = "SELECT * FROM `booklist` WHERE `subject` = '". $_GET["subject"] ."' ORDER BY `class` ASC";
        }
        else
        {
        $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC";
        }
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            echo '<div class="card">';
            echo '<span>';
            echo '<p>' . $result["name"] . '</p>';
            echo '<p>Klasa - ' . $result["class"] . '</p>';
            echo '</span>';


            echo '<ul>';
            echo '<li> Przedmiot: ' . $result["subject"] . '</li>';
            echo '<li> Wydawnictwo: ' . $result["publisher"] . '</li>';
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
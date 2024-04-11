<?php require_once "../conf/config.php"; ?>

<head>
    <title><?php echo SITENAME . " - "; ?>Spis Książek</title>
    <link href="../assets/css/booklist-new.css" type="text/css" rel="stylesheet">
    <script src="../assets/js/booklist.js"></script>

</head>

<body>

    <!-- filtry i sortowanie -->
    <?php
    $sql = "SELECT DISTINCT subject FROM booklist";
    $query = mysqli_query($conn, $sql);
    echo '<div class = "container" id ="btn-container">';
    echo 'Przedmiot<br>';
    while ($result = mysqli_fetch_assoc($query)) {
        echo '<a class = "btn-filter" href = "/src/booklist.php?subject=' . $result["subject"] . '">' . $result["subject"] . '</a>';
    }
    ?>
  
    <?php
    echo '<br>Klasa<br>';
    for ($grade = 1; $grade < 6; $grade++) {
        echo '<a class = "btn-filter" href = "/src/booklist.php?grade=' . $grade . '">' . $grade . '</a>';
    }
    echo '</div>';

    ?></p>
    </div>
    </div>
    


    <section id="booklist">
        <!-- <button onclick= "toggleSide_Panel()" class="btn-filter" id="btn-show">☰</button> -->
        <?php
        //!implementing filters
        if (isset($_GET["subject"])) {
            $sql = "SELECT * FROM `booklist` WHERE `subject` = '" . $_GET["subject"] . "' ORDER BY `class` ASC";
            echo "Produkty do przedmiotu " . $_GET["subject"];
        } else if (isset($_GET["grade"])) {
            $sql = "SELECT * FROM `booklist` WHERE `class` = '" . $_GET["grade"] . "' ORDER BY `subject` ASC";
            echo "Produkty dla klasy " . $_GET["grade"] . ": ";
        } else {
            $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC";
        }
        //! 





        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            echo '<div class="card">';
            //image
            // echo '<span class = "book-image-container"><img class ="book-image" src = "#"></img></span>';


            echo '<span class = "details">';
            //title
            echo '<span class = "book-title">';
            echo '<p>' . $result["name"] . '</p>';
            echo '</span>';

            //grade
            echo '<span class="book-grade">
            ' . $result["class"] . 
            '</span>';



            echo '<span class = "book-subject">' . $result["subject"] . '</span>';
            echo '<span class = "book-publisher">' . $result["publisher"] . '</span>';
            echo '<span class = "book-authors"> ';
            $authors = explode(",", $result["authors"]);
            $authors_count = count($authors);
            for ($index = 0; $index < $authors_count; $index++) {
                if ($index != $authors_count - 1) {
                    echo $authors[$index] . ", ";
                } else {
                    echo $authors[$index];
                }
            }
            echo '</span>';
            echo '</span>';
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
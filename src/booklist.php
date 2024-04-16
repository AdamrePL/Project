<?php require_once "../conf/config.php"; ?>


<head>
    <title><?php echo SITENAME . " - "; ?>Spis Książek</title>
    <link href="../assets/css/booklist-new.css" type="text/css" rel="stylesheet">
    <script src="../assets/js/booklist.js"></script>

</head>

<body>

    <!-- filtry i sortowanie -->
    <div class="filter-bar">
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
            echo '<a class = "btn-filter"  href = "/src/booklist.php?grade=' . $grade . '">' . $grade . '</a>';
        }

        echo '</div>';


        ?></p>
    </div>
    </div>
    </div>


    <section id="booklist">
        <!-- <button onclick= "toggleSide_Panel()" class="btn-filter" id="btn-show">☰</button> -->
        <?php
        //!implementing filters
        if (isset($_GET["subject"])) {
            $sql = "SELECT * FROM `booklist` WHERE `subject` = '" . $_GET["subject"] . "' ORDER BY `class` ASC";
            echo "Podręczniki do przedmiotu " . $_GET["subject"];
        } else if (isset($_GET["grade"])) {
            $sql = "SELECT * FROM `booklist` WHERE `class` = '" . $_GET["grade"] . "' ORDER BY `subject` ASC";
            echo "Podręczniki dla klasy " . $_GET["grade"] . ": ";
        } else {
            $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC";
            echo "Wszystkie podręczniki";
        }
        //! 





        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            echo '<a class="card" href = "/src/book.php?book=' . $result["name"] . '">';
            //image
            // echo '<span class = "detail image-container"><img class ="detail image" src = "#"></img></span>';


            echo '<span class = "details">';
            //title
            echo '<span class = "detail title">';
            echo '<p>' . $result["name"] . '</p>';
            echo '</span>';

            //grade
            echo '<span class="detail grade">
            ' . $result["class"] .
                '</span>';



            // echo '<span class = "detail subject" id = "test">' . $result["subject"] . '</span>';
            // echo '<span class = "detail publisher">' . $result["publisher"] . '</span>';
            // echo '<span class = "detail authors"> ';
            // $authors = explode(",", $result["authors"]);
            // $authors_count = count($authors);
            // for ($index = 0; $index < $authors_count; $index++) {
            //     if ($index != $authors_count - 1) {
            //         echo $authors[$index] . ", ";
            //     } else {
            //         echo $authors[$index];
            //     }
            // }
            // echo '</span>';
            // echo '</span>';
            // echo '<span id = "card-image"><img src="#" alt="zdjęcie"'. $result["name"].'"></span>';
            echo '</a>';
        }
        ?>
    </section>



    <?php include "footer.php"; ?>  


</body>
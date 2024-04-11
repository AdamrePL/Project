<?php require_once "../conf/config.php"; ?>
<head>
        <title><?php echo SITENAME . " - "; ?>Spis Książek</title>
    <link href="../assets/css/booklist.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<!-- //& <section> Tutaj dodać filtrowanie książek po klasie i przedmiocie </section> -->
<section id="booklist">
    <h1 id = "books-title">Spis Książek</h1>
    <button onclick="show_Sidepanel()">☰</button>
    <!-- //?got an idea to do filtering in side panel -->
    <div class="side-panel" id ="side-panel-booklist">
    <?php
    $sql = "SELECT DISTINCT subject FROM booklist";
    $query = mysqli_query($conn,$sql);
    echo '<button onclick="hide_Sidepanel()">X</button>';
    while ($result = mysqli_fetch_assoc($query)){
        echo'<p> '. $result["subject"].'</p>';
        echo '<hr>';
    }
    ?>
=======
    <!-- //& <section> Tutaj dodać filtrowanie książek po klasie i przedmiocie </section> -->
<<<<<<< Updated upstream
    <div class="side-panel" id="side-panel-booklist">
        <h2 class="side-panel-title">Zawężanie wyników</h2>
        <br>
        <h4>Przedmioty</h4>
        
        
        <?php
        $sql = "SELECT DISTINCT subject FROM booklist";
        $query = mysqli_query($conn, $sql);

        while ($result = mysqli_fetch_assoc($query)) {
            echo '<p> ' . $result["subject"] . '</p>';
            echo '<hr>';

        }
        ?>
        <p>
        <h4>Klasy</h4>
        </p>
        <?php
        $sql = "SELECT DISTINCT class FROM booklist";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            echo '<span class = "btn-filter">' . $result["class"] . '</span>';
        }
        ?>
<<<<<<< HEAD
>>>>>>> Stashed changes
=======
>>>>>>> e22fff761387592c840f29755f5ce7895985ad0e
=======

    <!-- <div class="side-panel" id="side-panel-booklist"> -->
    <!-- <h2 class="title" id="side-panel-title">Zawężanie wyników</h2> -->
    <!-- <div class="side-panel-group" id="side-panel-subjects"> -->

    <!-- <br> -->
    <!-- <h4>Przedmiot</h4> -->

    <?php
    $sql = "SELECT DISTINCT subject FROM booklist";
    $query = mysqli_query($conn, $sql);
    echo '<div class = "container" id ="btn-container">';
    echo 'Przedmiot<br>';
    while ($result = mysqli_fetch_assoc($query)) {
        echo '<a class = "btn-filter" href = "/src/booklist.php?subject=' . $result["subject"] . '">' . $result["subject"] . '</a>';
    }
    ?>
    <!-- </div> -->

    <!-- <div class="side-panel-group" id="side-panel-grades">
            <br>
            <!-- <h4>Klasa</h4> -->
        <?php
        echo '<br>Klasa<br>';
        for($grade = 1; $grade<6; $grade++){
            echo '<a class = "btn-filter" href = "/src/booklist.php?grade=' . $grade . '">' . $grade . '</a>';
        }
       echo '</div>';

        ?></p>
    </div>
>>>>>>> Stashed changes
    </div>

    <script>
        function show_Sidepanel() {
            document.getElementById("side-panel-booklist").style.width = "500px";
            document.getElementById("books").style.marginLeft = "500px";
            document.getElementById("books-title").style.marginLeft = "500px";
        }

<<<<<<< Updated upstream
        function hide_Sidepanel() {
            document.getElementById("side-panel-booklist").style.width = "0";
            document.getElementById("books").style.marginLeft = "0";
            document.getElementById("books-title").style.marginLeft = "0";
        }
    </script>

    <div class="container" id="books">
    <?php 
        $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC, `subject`";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            echo '<div class="card">';
                echo '<span>';
                    echo '<p>'. $result["name"] .'</p>';
                    echo '<p>Klasa - '. $result["class"] .'</p>';
                echo '</span>';
=======
    <section id="booklist">
        <!-- <button onclick= "toggleSide_Panel()" class="btn-filter" id="btn-show">☰</button> -->
        <?php
        if (isset($_GET["subject"])) {
            $sql = "SELECT * FROM `booklist` WHERE `subject` = '" . $_GET["subject"] . "' ORDER BY `class` ASC";
            echo "Produkty do przedmiotu " . $_GET["subject"];
        } else if (isset($_GET["grade"])) {
            $sql = "SELECT * FROM `booklist` WHERE `class` = '" . $_GET["grade"] . "' ORDER BY `subject` ASC";
            echo "Produkty dla klasy " . $_GET["grade"] .": ";

        } else {
            $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC";
        }





        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            echo '<div class="card">';
            echo '<span class = "book-title">';
            echo '<p>' . $result["name"] . '</p>';
            echo '</span>';
            echo '<span class="book-grade">Klasa - ' . $result["class"] . '</span>';

>>>>>>> Stashed changes


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
    </div>
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
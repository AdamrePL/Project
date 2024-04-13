<?php require_once "../conf/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../assets/css/booklist.css" type="text/css" rel="stylesheet">
    <script src="../assets/js/booklist.js" defer></script>

    <title><?php echo SITENAME . " - "; ?>Spis Książek</title>
</head>

<body>
    <!-- //& <section> Tutaj dodać filtrowanie książek po klasie i przedmiocie </section> -->
    <div class="side-panel" id="side-panel-booklist">
        <button type="menu" onclick="hide_Sidepanel()">X</button>
        <h2 class="side-panel-title">Filtry</h2>

        <h3>Przedmioty</h3>
        <?php
        $sql = "SELECT DISTINCT `subject` FROM `booklist`;";
        $query = $conn->query($sql);

        while ($result = $query->fetch_assoc()) {
            echo '<p> ' . $result["subject"] . '</p>';
        }
        ?>
        <p><h3>Klasy</h3></p>
        <?php
        $sql = "SELECT DISTINCT `class` FROM `booklist`;";
        $query = $conn->query($sql);
        while ($result = $query->fetch_assoc()) {
            echo '<span class="btn-filter">' . $result["class"] . '</span>';
        }
        ?>
    </div>


    <section id="booklist">
        <h1 id="books-title">Spis Książek</h1>
        <header>
            <label>
                Klasa: 
                <select>
                    <?php
                        $sql = "SELECT DISTINCT `class` FROM `booklist`;";
                        $query = $conn->query($sql);
                        while ($result = $query->fetch_assoc()) {
                            echo '<option>' . $result["class"] . '</option>';
                        }
                    ?>
                </select>
            </label>
            
            <label>
                Przedmiot: 
                <select>
                    <?php
                        $sql = "SELECT DISTINCT `subject` FROM `booklist`;";
                        $query = $conn->query($sql);
                        while ($result = $query->fetch_assoc()) {
                            echo '<option>' . $result["subject"] . '</option>';
                        }
                    ?>
                </select>
            </label>
        </header>
        <button type="menu" onclick="show_Sidepanel()" class="btn-filter" id="btn-show">T</button>
        <?php
        $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC, `subject`";
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
<?php require_once "../conf/config.php"; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../assets/css/booklist.css" type="text/css" rel="stylesheet">

    <title><?php echo SITENAME . " - "; ?>Spis Książek</title>
</head>

<body>
    <section id="filters">
        <header id="filters-bar">
            <select name="class">
                <option value="all" selected>klasa: wszystkie</option>
                <?php
                    $sql = "SELECT DISTINCT `class` FROM `booklist`;";
                    $query = $conn->query($sql);
                    while ($result = $query->fetch_assoc()) {
                        echo '<option>' . $result["class"] . '</option>';
                    }
                ?>
            </select>

            <select name="subject">
                <option value="all" selected>przedmiot: wszystkie</option>
                <?php
                    $sql = "SELECT DISTINCT `subject` FROM `booklist`;";
                    $query = $conn->query($sql);
                    while ($result = $query->fetch_assoc()) {
                        echo '<option>' . $result["subject"] . '</option>';
                    }
                ?>
            </select>
        </header>
    </section>

    <main id="booklist">
        <h1 id="books-title">Spis Książek</h1>
        <?php
        $subj = isset($_GET["subject"]) ? $conn->real_escape_string($_GET["subject"]) : false;
        $class = isset($_GET["class"]) ? $conn->real_escape_string($_GET["class"]) : false;

        if ($subj && $class) {
            $sql = "SELECT * FROM `booklist` WHERE `subject` LIKE '%$subj%' AND class = '$class'";
        } else if ($subj) {
            $sql = "SELECT * FROM `booklist` WHERE `subject` LIKE '%$subj%' ORDER BY `class` ASC";
        } else if ($class) {
            $sql = "SELECT * FROM `booklist` WHERE `class` = '$class'  ORDER BY `subject`";
        } else {
            $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC, `subject`";
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
    </main>

    <section id="booklist-files">
        <h1>Zawartość do pobrania</h1>
        <a href="../assets/downloads/booklist.json" download>Uzupełniony - przykładowy plik przygotowawczy</a>
        <a href="../assets/downloads/booklist_template.json" download>Pusty plik przygotowawczy dla wstawienia książek na stronę</a>
    </section>

    <?php
    include_once "footer.php";
    ?>

</body>
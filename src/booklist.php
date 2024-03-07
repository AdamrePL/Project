<?php require_once "../conf/config.php"; ?>

<h1>Spis Książek</h1>
<table>
    <tr>
        <td>Klasa</td>
        <td>Przedmiot</td>
        <td>Nazwa</td>
        <td>Wydawnictwo</td>
        <td>Autorzy</td>
    </tr>
    <?php 
    $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC, `subject`";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_assoc($query)) {
        echo '<tr>';
        echo '<td>' . $result["class"] . '</td>';
        echo '<td>' . $result["subject"] . '</td>';
        echo '<td>' . $result["name"] . '</td>';
        echo '<td>' . $result["publisher"] . '</td>';
        echo '<td>';
        $authors = explode(",", $result["authors"]);
        for ($index = 0; $index < count($authors); $index++) {
            if ($index != count($authors) - 1) {
                echo $authors[$index] . ", <br>";
            } else {
                echo $authors[$index];
            }
        }
        echo '</td>';
        echo '</tr>';
    }
    ?>
</table>

<a href="../booklist.json" download>Plik przygotowawczy dla wstawienia książek na stronę</a>
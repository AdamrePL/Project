<?php require_once "../conf/config.php"; ?>
<head>
    <title><?php echo SITENAME . " - "; ?>Spis Książek</title>
    <link href="../assets/css/booklist.css" type="text/css" rel="stylesheet">
</head>

<body>
<h1>Spis Książek</h1>
    <?php 
        $sql = "SELECT * FROM `booklist` ORDER BY `class` ASC, `subject`";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            echo '<div>';
                echo '<span>';
                    echo '<p>'.$result["name"].'</p>';
                    echo '<p>Klasa - '.$result["class"].'</p>';
                echo '</span>';

                echo '<ul>';
                    echo'<li> Przedmiot: '.$result["subject"].'</li>';
                    echo'<li> Wydawnictwo: '.$result["publisher"].'</li>';
                    echo '<li> Autorzy: ';
                    $authors = explode(",", $result["authors"]);
                    for ($index = 0; $index < count($authors); $index++) {
                        if ($index != count($authors) - 1) {
                            echo $authors[$index] . ", ";
                        } else {
                            echo $authors[$index];
                        }
                    }
                echo '</li></ul>';
                
            echo '</div>';
            echo '</table>';        
        }
    ?>
<br>
<a href="../booklist.json" download>Plik przygotowawczy dla wstawienia książek na stronę</a>
</body>
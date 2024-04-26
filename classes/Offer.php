<?php
$abspath = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["BASE"];
require_once "$abspath/conf/config.php";

class Offer
{
    private $conn;
    private $path_arg;

    public function __construct($conn, $path_arg = null)
    {
        $this->conn = $conn;
        $this->path_arg = $path_arg;
    }


    public function formatDate()
    {
        date_default_timezone_set('Europe/Warsaw');
        return date('Y-m-d H:i:s');
    }

    public function dateToDays($date1, $date2)
    {
        $diff = strtotime($date1) - strtotime($date2);
        return round($diff / 86400);
    }

    public function deleteIf30()
    {
        $sql = "SELECT * FROM `offers`";
        foreach ($this->conn->query($sql) as $row) {
            if ($this->dateToDays($this->formatDate(), $row["offer-edate"]) >= 30) {
                $this->conn->query("SET FOREIGN_KEY_CHECKS = 0");
                $this->conn->query("ALTER TABLE `offers` DROP FOREIGN KEY `offers_ibfk_1`");

                $deleteOffer = "DELETE FROM `offers` WHERE `id` = " . $row["id"];
                $this->conn->query($deleteOffer);

                $deleteProduct = "DELETE FROM `products` WHERE `offer-id` = " . $row['id'];
                $this->conn->query($deleteProduct);

                $this->conn->query("ALTER TABLE `offers` ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`user-uuid`) REFERENCES `users` (`uuid`) ON DELETE NO ACTION ON UPDATE NO ACTION");
                $this->conn->query("SET FOREIGN_KEY_CHECKS = 1");
            }
        }
    }

    public function printAll($all = true)
    {
        $condition = array("nowy", "używany", "uszkodzony");
        $break = '<div class="break"></div>';

        if ($all) {
            $sqlFilterSubject = "SELECT DISTINCT subject FROM booklist";
            $queryFilterSubject = mysqli_query($this->conn, $sqlFilterSubject);

            echo '<div class="container" id="btn-container">';
            echo '<h3>Przedmiot</h3>';
            echo $break;

            while ($result = mysqli_fetch_assoc($queryFilterSubject)) {
                echo '<a class="btn-filter" href="/src/offer-list.php?subject=' . $result["subject"] . '">' . $result["subject"] . '</a>';
            }

            echo $break;
            echo '<h3>Klasa</h3>';
            echo $break;

            for ($grade = 1; $grade < 6; $grade++) {
                echo '<a class="btn-filter" href="/src/offer-list.php?grade=' . $grade . '">' . $grade . '</a>';
            }

            echo $break;
            echo '<h3>Stan</h3>';
            echo $break;

            foreach ($condition as $cond) {
                echo '<a class="btn-filter" href="/src/offer-list.php?filter/condition=' . $cond . '">' . $cond . '</a>';
            }

            echo $break;

            if (isset($_GET["subject"])) {
                echo "<p>Oferty dla przedmiotu " . $_GET["subject"];
            } else if (isset($_GET["grade"])) {
                echo "<p>Oferty dla klasy " . $_GET["grade"];
            } else {
                echo "<p>Wszystkie oferty";
            }

            echo '</p>';

            $sql = "SELECT * FROM `offers` WHERE `status` = '1' ORDER BY `id` DESC LIMIT 20 ";
            $query = mysqli_query($this->conn, $sql);

            if (isset($_GET["subject"])) {
                $sql2 = "SELECT `offers`.*, `products`.`subject` FROM `offers` INNER JOIN `products` ON `offers`.`id` = `products`.`offer-id` WHERE `products`.`subject` = '" . $_GET["subject"] . "'";
            } else if (isset($_GET["grade"])) {
                $sql2 = "SELECT `offers`.*, `products`.`grade` FROM `offers` INNER JOIN `products` ON `offers`.`id` = `products`.`offer-id` WHERE `products`.`subject` = '" . $_GET["grade"] . "'";
            }
        } else {
            $sql = "SELECT * FROM `offers` WHERE `user-uuid` = '" . $_SESSION['uid'] . "' ORDER BY `id` DESC LIMIT 20 ";
            $query = mysqli_query($this->conn, $sql);
        }

        if (mysqli_num_rows($query) != 0) {
            while ($result = mysqli_fetch_assoc($query)) {
                if ($this->formatDate() >= date($result["offer-edate"])) {
                    $sqlUpdate = "UPDATE `offers` SET `status` = '0' WHERE `status` = '1' AND `id` =" . $result["id"];
                    $this->conn->query($sqlUpdate);
                }

                if (isset($_GET["subject"])) {
                    $sql2 = "SELECT * FROM `products` WHERE `offer-id` =" . $result["id"] . " AND `subject` = '" . $_GET["subject"] . "' and `inactive` = 0";
                } else if (isset($_GET["grade"])) {
                    $sql2 = "SELECT * FROM `products` WHERE `offer-id` =" . $result["id"] . " AND `class` = '" . $_GET["grade"] . "' and `inactive` = 0";
                } else {
                    $sql2 = "SELECT * FROM `products` WHERE `offer-id` =" . $result["id"] . " and `inactive` = 0";
                }

                $query2 = mysqli_query($this->conn, $sql2);
                $prod = mysqli_num_rows($query2);

                if ($prod == 0) {
                    continue;
                }

                echo '<div class="offer" id="' . $result["id"] . '">';

                if ($prod > 1) {
                    echo '<h4 class="offer-title"><a href="'.$this->path_arg.'src/view-offer.php?id=' . $result["id"] . '">Pakiet</a></h4>';
                    echo '<details>';
                    echo '<summary>Pakiet zawiera: </summary>';

                    while ($result2 = mysqli_fetch_assoc($query2)) {
                        echo $result2["name"] . '<br>';
                    }

                    echo '</details>';
                } else {
                    $result2 = mysqli_fetch_assoc($query2);
                    echo '<h4 class="offer-title"><a href="'.$this->path_arg.'src/view-offer.php?id=' . $result["id"] . '">' . $result2["name"] . '</a></h4>';
                }


                if (!$all) {
                    echo '<form action="../src/revise-offer.php" method="get">';
                    echo '<input type="hidden" name="offer_id" value="' . $result["id"] . '">';

                    echo '<button type="submit" class="btn-edit">Zmień ofertę</button>';
                    echo '</form>';


                    echo '<form action="../controllers/delete_offer.php" method="post">';
                    echo '<input type="hidden" name="offer_id" value="' . $result["id"] . '">';
                    echo '<button type="submit" class="btn-edit delete">Usuń ofertę</button>';
                    echo '</form>';
                }

                echo '<span class="offer-date">';
                echo '<span>oferta utworzona: ' . date('d.m.Y', strtotime($result["offer-cdate"])) . '</span>';
                echo '<span>oferta wygasa: ' . date('d.m.Y', strtotime($result["offer-edate"])) . '</span>';
                echo '</span>';
                echo '</div>';
            }
        }
    }
}
?>

<?php

class OffersDisplay {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function display_offers($amount, $status = null, $email = null) {
        if (!is_null($email)) {
            $sql = "SELECT * FROM `offers` WHERE `email` = '$email'";
            $this->display($sql, true);
        } else if (!is_null($status)) {
            $sql = "SELECT * FROM `offers` WHERE `status` = $status LIMIT $amount";
            $this->display($sql);
        } else {
            $sql = "SELECT * FROM `offers` WHERE `status` = 1 LIMIT $amount";
            $this->display($sql);
        }
    }

    // public function fetch_all_offers() {}

    private function display($sql, $settings = false) {
        $query = $this->conn->query($sql);
        while ($result = $query->fetch_assoc()) {
            $offer_id = $result["id"];
            $sql2 = "SELECT * FROM `products` WHERE `offer-id` = '$offer_id'";
            $query2 = $this->conn->query($sql2);
            $count = $query2->num_rows;
            if ($count == 0) {
                continue;
            } elseif ($count > 1) {
                echo "<div class='offer' id='offer_$offer_id'>";
                echo '<h4 class="offer-title">Pakiet</h4>';
                if ($settings) {
                    echo '
                        <span>
                            <a><i class="fa fa-cog"></i></a>
                            <a><i class="fa fa-trash"></i></a>
                        </span>
                    ';
                }
                echo '<details class="offer-contains">';
                echo '<summary>Pakiet zawiera: </summary>';
                while ($result2 = mysqli_fetch_assoc($query2)) {
                    echo $result2["name"] . '<br>';
                }
                echo '</details>';
            } else {
                echo "<div class='offer' id='offer_$offer_id'>";
                $result2 = mysqli_fetch_assoc($query2);
                echo '<h4 class="offer-title">'. $result2["name"] .'</h4>';
                if ($settings) {
                    echo '
                        <span>
                            <a><i class="fa fa-cog"></i></a>
                            <a><i class="fa fa-trash"></i></a>
                        </span>
                    ';
                }
            }

            echo '<details class="contact-info">';
            echo '<summary>Dane kontaktowe</summary>';
            if ($settings) {
                echo '<p>'. $result["discord"] .'</p>';
                echo '<p>'. $result["phone"] .'</p>';
                echo '<p>'. $result["email"] .'</p>';
            }
            echo '</details>';
            echo "<a href='src/offer.php?id=$offer_id'>więcej..</a>";
            echo '<span class="offer-date">';                
                echo '<span>oferta utworzona: ' . date('d.m.Y', strtotime($result["offer-cdate"]))  . '</span>';
                echo '<span>oferta wygasa: ' . date('d.m.Y', strtotime($result["offer-edate"])) . '</span>';
            echo '</span>';
            echo '</div>';
        }
    }

}
?>

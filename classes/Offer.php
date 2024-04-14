<?php

class Offer {
    private $conn;
    private $offer_id;
    
    public function __construct($conn, $offer_id) {
        $this->conn = $conn;
        $this->offer_id = $offer_id;
    }

    public function get_products() {
        $sql = "SELECT * FROM `products` WHERE `products`.`offer-id` = $this->offer_id";
        $query = $this->conn->query($sql);
        return $query->fetch_assoc();
    }
}

class OffersDisplay {
    private $conn;

    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function display_offers($amount, $status = null, $user = null) {
        if (!is_null($user)) {
            $sql = "SELECT * FROM `offers` WHERE `user-uuid` = '$user'";
            $this->display($sql, true);
        } else if (!is_null($status)) {
            $sql = "SELECT * FROM `offers` WHERE `status` = $status LIMIT $amount";
            $this->display($sql);
        } else {
            $sql = "SELECT * FROM `offers` WHERE `status` = 1 LIMIT $amount";
            $this->display($sql);
        }
        
    }

    public function display($sql, $settings = false){
        $query = $this->conn->query($sql);
        while ($result = $query->fetch_assoc()) {
            echo '<div class="offer" id="offer_'. $result["id"] .'">';
                $sql2 = "SELECT * FROM `products` WHERE `offer-id` =" . $result["id"];
                $query2 = mysqli_query($this->conn, $sql2);
                $prod = mysqli_num_rows($query2);
                
                if ($prod > 1) {
                    echo '<h4 class="offer-title">Pakiet</h4>';
                    if ($settings) {
                        echo '<span>ustawienia: <a><i class="fa fa-trash"></i></a></span>';
                    }
                    echo '<details class="offer-contains">';
                    echo '<summary>Pakiet zawiera: </summary>';
                    // for ($i = 0; $i < $prod; $i++) {
                        
                    // }
                    while ($result2 = mysqli_fetch_assoc($query2)) {
                        echo $result2["name"] . '<br>';
                    }
                    
                    echo '</details>';

                } else {
                    $result2 = mysqli_fetch_assoc($query2);
                    echo '<h4 class="offer-title">'. $result2["name"] .'</h4>';
                    if ($settings) {
                        echo '<span>ustawienia: <a><i class="fa fa-trash"></i></a></span>';
                    }
                }

                echo '<details class="contact-info">';
                echo '<summary>Dane kontaktowe</summary>';
                if ($settings) {
                    $sql = "SELECT `phone`, `email`, `discord` FROM `users` WHERE uuid = '". $_SESSION["uid"]." '";
                    $query = $this->conn->query($sql);
                    $result3 = $query->fetch_assoc();
                    echo '<p>'. $result3["discord"] .'</p>';
                    echo '<p>'. $result3["phone"] .'</p>';
                    echo '<p>'. $result3["email"] .'</p>';
                }
                echo '</details>';
                echo '<a href="src/offer.php?id='. $result["id"] .'">Pokaż więcej..</a>';
                echo '<span class="offer-date">';                
                    echo '<span>oferta utworzona: ' . date('d.m.Y', strtotime($result["offer-cdate"]))  . '</span>';
                    echo '<span>oferta wygasa: ' . date('d.m.Y', strtotime($result["offer-edate"])) . '</span>';
                echo '</span>';
            echo '</div>';
        }
    }

}
?>

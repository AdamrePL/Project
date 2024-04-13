<?php
class OffersDisplay {
    private $conn;

    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function Display($amount){
        $sql = "SELECT * FROM `offers` WHERE `status` = '1' LIMIT $amount";
        $query = $this->conn->query($sql);
        while ($result = $query->fetch_assoc()){
            echo '<div class="offer" id="offer_'. $result["id"] .'">';
                $sql2 = "SELECT * FROM `products` WHERE `offer-id` =" . $result["id"];
                $query2 = mysqli_query($this->conn, $sql2);
                $prod = mysqli_num_rows($query2);
                
                if ($prod > 1) {
                    echo '<h4 class="offer-title">Pakiet</h4>';
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
                }

                echo '<details class="contact-info">';
                echo '<summary>Dane kontaktowe</summary>';
                echo '</details>';
                echo '<span class="offer-date">';                
                    echo '<span>oferta utworzona: ' . date('d.m.Y', strtotime($result["offer-cdate"]))  . '</span>';
                    echo '<span>oferta wygasa: ' . date('d.m.Y', strtotime($result["offer-edate"])) . '</span>';
                echo '</span>';
            echo '</div>';
        }
    }

}
?>

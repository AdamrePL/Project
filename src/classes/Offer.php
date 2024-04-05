<?php
class Oferty 
{
    private $conn;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function PrintAll(){
        $sql = "SELECT * FROM `offers` WHERE `status` = '1' LIMIT 20";
        $query = mysqli_query($this->conn, $sql);
        

        while ($result = mysqli_fetch_assoc($query)){
            $date = date_default_timezone_set('Europe/Warsaw');
            $FormatDate = date('Y-m-d H:i:s',$date);
            

            if ($FormatDate <= $result["offer-edate"]){
                $sqlupdate = "UPDATE `offers` SET `status` = '0' WHERE `status` = '1'" ;
                $this->conn->query($sqlupdate);
            }
            echo '<div class="offer">';
                        $sql2 = "SELECT * FROM `products` WHERE `offer-id` =" . $result["id"];
                        $query2 = mysqli_query($this->conn, $sql2);
                        $prod = mysqli_num_rows($query2);
                        
                        if ($prod > 1) {
                            echo '<h4 class="offer-title">Pakiet</h4>';
                            echo '<details>';
                            echo '<summary>Pakiet zawiera: </summary>';
                            for ($i = 0; $i < $prod; $i++) {
                                
                            }
                            while ($result2 = mysqli_fetch_assoc($query2)) {
                                echo $result2["name"] . '<br>';
                            }
                            echo '</details>';

                        } else {
                            $result2 = mysqli_fetch_assoc($query2);
                            echo '<h4 class="offer-title">'. $result2["name"] .'</h4>';
                            echo $FormatDate;
                        }
                        
                        echo '<details>';
                        echo '<summary>Dane kontaktowe chuj</summary>';
                        echo $result["phone"];
                        echo $result["email"];
                        echo $result["discord"];
                        echo '</details>';
                        
                        echo '<span class="offer-date">';
                            echo '<span>oferta utworzsdadsadsdona: ' . $result["offer-cdate"]  . '</span>';
                            echo '<span>oferta wygasa: ' . $result["offer-edate"] . '</span>';
                        echo '</span>';
                    echo '</div>';
        }

    }

     

    
}
?>
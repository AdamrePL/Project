<?php
class Oferty 
{
    private $conn;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function FormatDate (){
        date_default_timezone_set('Europe/Warsaw');
        $FormatDate = date('Y-m-d H:i:s');
        return $FormatDate;
    }

    public function dateToDays($date1, $date2){
        $diff = strtotime($date1) - strtotime($date2);
        return round($diff/86400);

    }

    public function deleteIf30 (){
        $sql = "SELECT * FROM `offers`";
        foreach($this->conn->query($sql) as $row){
            //check date
            if (self::dateToDays(self::FormatDate(),$row["offer-edate"]) >= 30){

                $this->conn->query("SET FOREIGN_KEY_CHECKS = 0");

                $this->conn->query("ALTER TABLE `offers` DROP FOREIGN KEY `offers_ibfk_1`");
                
                $deleteoffer = "DELETE FROM `offers` WHERE `id` = " . $row["id"];
                $this->conn->query($deleteoffer);
                $deleteproduct = "DELETE FROM `products` WHERE `offer-id` = " .$row['id'];
                $this->conn->query($deleteproduct);

                $this->conn->query("ALTER TABLE `offers` ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`user-uuid`) REFERENCES `users` (`uuid`) ON DELETE NO ACTION ON UPDATE NO ACTION");
                $this->conn->query("SET FOREIGN_KEY_CHECKS = 1");
                
            }
        }
    }

    public function PrintAll(){
        $sql = "SELECT * FROM `offers` WHERE `status` = '1' LIMIT 20";
        $query = mysqli_query($this->conn, $sql);
        

        while ($result = mysqli_fetch_assoc($query)){
            
            
            echo "<script>console.log('Debug Objects: " . self::dateToDays(self::FormatDate(),$result["offer-edate"]) . "' );</script>"; //tylko test

            if (self::FormatDate() >= date($result["offer-edate"])){
                $sqlupdate = "UPDATE `offers` SET `status` = '0' WHERE `status` = '1' AND `id` =" . $result["id"];
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
                        }
                      


                        echo 'Dane kontaktowe';
                        // ShowButton();            
                        // //!WILL BE FINISHED            
                        echo '<span class="offer-date">';
                            echo '<span>oferta utworzona: ' . date('d.m.Y', strtotime($result["offer-cdate"]))  . '</span>';
                            echo '<span>oferta wygasa: ' . date('d.m.Y', strtotime($result["offer-edate"])) . '</span>';
                        echo '</span>';
                    echo '</div>';

                    
        }
        
    }

     

    
}
?>
<?php
class Oferty 
{
    private $conn;
    private $table_name_offers = "offers";


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readOffers(){
        $queryOffers = "SELECT * FROM" . $this ->table_name_offers . " WHERE `status` = '1' LIMIT 20";
        $stmtOffers = $this->conn->prepare($queryOffers);
        $stmtOffers->execute();

        return $stmtOffers;

    }

    
}
?>
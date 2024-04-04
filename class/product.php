<?php
class Product {
    private $conn;
    private $table_name_products = "products";

    private $offers_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function readProductsFromOffers(){
        $queryProducts = "SELECT * FROM" . $this->table_name_products . " WHERE 'offer-id' = " . $this->offers_id;
        $stmtProducts = $this->conn->prepare($queryProducts);
        $stmtProducts->execute();
        
        return $stmtProducts;
    }

}
?>
<?php 

class Offer {
    private mysqli $conn;

    private int $days = 14;
    private int $hours = 0;

    public string $discord;
    public int $phone;
    public string $email;

    public array $books;
    public array $price;
    public array $quality;

    public array $qulities = ["Używana", "Zniszczona", "Nowa"];
    private const PRICE_CHECK_REGEX = "/^\d*\.?\d*$/"; // or ^\d*(\.\d{0,2})?$

    /**
     * @var string[] $status
     * 
     * "active" - Aktywna
     * 
     * "expired" - Wygasła
     * 
     * "cancelled" - Anulowana
     * 
     * "ended" - Zakończona
     * 
     * "removed" - Usunięta przez administratora
     * 
     * "archived" - [experimental] opcjonalne na wypadek zostawiania ofert w bazie danych po miesiącu od zakończenia/wygasniecia oferty
     * 
     * "hidden" - [experimental] Ukryta, aby sprzedawca nie widział jej na swoim profilu - bardzo podobne do expired/cancelled, tylko roznica taka ze go nie widac na profilu
    */
    private $status = ["active", "expired", "cancelled", "ended", "removed", "archived", "hidden"];

    public function __construct(mysqli $conn, string $email, ?string $discord = null, int|string|null $phone = null) {
        $this->conn = $conn;
        $this->email = $this->conn->real_escape_string(htmlspecialchars(str_replace(" ", "", $email), ENT_QUOTES, 'UTF-8'));
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Incorrect Email", 1);
        }
        $this->discord = htmlspecialchars($this->conn->real_escape_string(str_replace(" ", "", $discord)), ENT_QUOTES, 'UTF-8');
        $this->phone = str_replace(" ", "", $phone);
    }

    public function set_expiry(int|string $days = 14, int|string $hours = 0) {
        $this->days = $days < 5 ? 14 : $days;
        $this->days = $days > 90 ? 90 : $days;

        $this->hours = $hours < 0 ? 0 : $hours;
        $this->hours = $hours > 23 ? 23 : $hours;
    }

    public function insert_products(int $offer_id, array $books, array $prices, array $quality) {
        $sql = "INSERT INTO `products` VALUES('', ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->stmt_init();
        $stmt->prepare($sql);

        $book_count = count($books);

        for ($i = 0; $i < $book_count; $i++) {
            $sql = "SELECT * FROM `booklist` WHERE id = ".$this->conn->real_escape_string($books[$i]);
           
            //$query = "SELECT * FROM `booklist` WHERE"; for($i = 0; $i < $book_count; $i++) { if ($i == 0) {$query .= ' id = ' . $_POST["book"][$i]; continue; } $query .= ' AND id = ' . $_POST["book"][$i]; }
            $query = $this->conn->query($sql);
            if ($result = mysqli_fetch_assoc($query)) {
                $book_name = $result["name"];
                $book_subj = $result["subject"];
                $book_class = $result["class"];
                $book_authors = $result["authors"];
                $book_pub = $result["publisher"];  
            }
        
            $book_price = doubleval(str_replace(" ", "", $prices[$i]));
            $book_qual = str_replace(" ", "", $quality[$i]);
            
            $sql = "INSERT INTO `products`(`id`, `offer-id`, `name`, `author`, `publisher`, `subject`, `class`, `price`, `quality`) VALUES('', ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt->bind_param('issssids', $offer_id, $book_name, $book_authors, $book_pub, $book_subj, $book_class, $book_price, $book_qual);
            $stmt->execute();
        }
    }

    public function insert_offer() {
        $hashed_mail = convert_uuencode(base64_encode($this->email));
        $sql = "INSERT INTO `offers` VALUES('', NOW(), DATE_ADD(DATE_ADD(NOW(), INTERVAL $this->days DAY), INTERVAL $this->hours HOUR), '1', '$this->phone', '$hashed_mail', '$this->discord')";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

}

?>
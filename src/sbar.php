<link rel="stylesheet" href="assets/css/navbar.css">
<div class="sbar">
<search>
            <form method="get">
                <input type="search" pattern="[^'\x22]+" list="books-search-list" name="search" id="searchbar" placeholder="Znajdź Produkt" />
                <button type = "submit"><i id="icon-search" class="fa-solid fa-magnifying-glass"></i></button>
                <datalist id="books-search-list">
                    <?php
                    // $sql = "SELECT DISTINCT `name` FROM `booklist`"; Wszystkie */
                    $sql = "SELECT DISTINCT `id`, `name` FROM `products`"; /* Dostępne */
                    $query = mysqli_query($conn, $sql);
                    while ($result = mysqli_fetch_array($query)) {
                        echo '<option value="' . $result["name"] . '">' . $result["name"] . '</option>';
                    }
                    ?>
            </form>
        </search>
</div>
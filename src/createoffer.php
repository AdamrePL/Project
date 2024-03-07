<div class="offerCreate">
    <h1>Testing</h1>
    <form>
        <input type="text" placeholder="Book title"/>
        <select name="przedmioty">
            <?php $sql = "SELECT DISTINCT `subject` FROM booklist;";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_array($query)) {
                    echo '<option value="' . $result["subject"] . '">' . $result["subject"] . '</option>';
                }
            ?>
        </select>
        <!-- <input type="text" placeholder="Stan Książki"/> -->
        <input type="submit" value="Create Offer"/>
        <input type="reset" value="Reset"/>
    </form>
</div>
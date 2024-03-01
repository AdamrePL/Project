<?php require_once "config.php"; ?>
<!--user page-->
<style>
    *{
     margin: 0px;
     padding: 0px;
     font-family: Verdana, Geneva, Tahoma, sans-serif;
     /* font-family: sans-serif; */
     box-sizing: border-box;
     -webkit-user-select: text;
     -moz-user-select: none;
     -ms-user-select: text;
     user-select: text;
    }

    #ui{
        font-size: 2rem;
        display: flex;
        flex-direction: row;
        border: 1px solid black;
        box-shadow: 0px 10px 40px gray;
        width: 100%;
        height: 30%;
    }

    #u1 {
        display: flex;
        flex-direction: column;
        margin: 1rem;
        height: auto;
        width: 40%;
        border: 1px dotted black;
    }

    #u1 > p{
        padding-bottom: 1.1rem;
    }
    

    #u2{
        display: flex;
        margin: 1rem;
        height: auto;
        width: 60%;
        border: 1px solid black;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content: center;
        font-size: 1.75rem;
    }

    #u2 > p {
        padding-bottom: 0.5rem;
    }

    /* content: icon corresponding to contact thingamabob*/
    #pn:before{
        content: "a";
    }
    #ea:before{
        content:"b";
    }
    #dc:before{
        content: "c";
    }

    #u1 > span, button {
        font-size: 1rem;

        /* & span {
            color: red;
        }
        
        & button {
            color: red;
        } */
    }
</style>
<section id="user-details">
<?php
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uuid = 'tester#aA1'");
    $result = mysqli_fetch_assoc($query);
?>
    <div class="user">
        <h3 class="username"><?php echo $result["username"] ?></h3>
        <div clas="user-id">
            <span class="uid"><?php echo $result["uuid"]; ?></span>
            <!-- <template> -->
                <span>Are you sure you want to display sensitive information?</span>
                <button type="button">tak</button>
                <button type="button">Anuluj</button>
            <!-- </template> -->
        </div>
    </div>

    <div class="contact">
        <p><?php echo !empty($result["phone"]) ? $result["phone"] : "Nr tel."; ?></p>
        <p><span><?php echo $result["email"]; ?></span><input type="checkbox" name="" id="" /></p>
        <p><?php echo !empty($result["discord"]) ? $result["discord"] : "Discord"; ?></p>
    </div>
</section>

<section class="user-offers">
    <?php
        $sql = "SELECT * FROM `offers`,`users`,`products` WHERE 'users.uuid' = 'offers.user-uuid' AND 'offers.product-id' == 'products.id';";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($query))
    ?>
</section>
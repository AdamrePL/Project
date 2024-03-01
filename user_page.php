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
        height: 35%;
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
<div id="ui">
    <?php
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uuid = 'tester#aA1'");
        while ($result = mysqli_fetch_assoc($query)) {
            //print_r( $result );
            //TODO: style
            
            echo '<div id="u1">';
                echo '<p id="uname">'.$result["username"].'</p>';
                echo '<p id="ibox">'.$result["uuid"].'</p>'; // ** use ajax or something here
                echo '<span> Show UID? </span> <button type="button" id="SY">Yes</button> <button type="button" id="SN">No</button>';
            echo '</div>';

            echo '<div id="u2">';
                if($result["phone"]){
                    echo '<p id="pn">'.$result["phone"];    
                }

                if($result["email"]){
                    echo '<p id="ea"">'.$result["email"].'<br>';
                }
            
                if($result["discord"]){
                    echo '<p id="dc">'.$result["discord"];
                }
            
            echo '</div>';
        }
    ?>
</div>
<!--offers-->
    <?php
        //query throws error on 'AND' statement, black magic!
        // $res = mysqli_query($conn,"SELECT * FROM `offers`,`users`,`products`
        //                     WHERE users.uuid == offers.user-uuid AND 
        //                     offers.product-id == products.id;"
        //                    );
        echo "krilling my shelf";
    ?>

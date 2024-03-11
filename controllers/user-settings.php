<!-- 
    
    // ! TEMPORARY FILE
    // ! TEMPORARY FILE
    // ! TEMPORARY FILE

 -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/"> -->
</head>
<body>
<a href="../src/profile.php">RETURNO</a>
<h1> User Settings </h1>

<form action="" type="">

    <label for="new_password">Change password</label>
    <input type="text" name="new_password" placeholder="New Password"/>
    
    <label for="con_password">Confirm New Password</label>
    <input type="text" name="con_password" placeholder="Confirm New Password"/>

    <label for="email_adress">Enter email:</label>
    <input type="email" name="email_adress" placeholder="Email" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$"/>

    <label for="telephone_number">Enter phone number</label>
    <input type="tel" name="telephone_number" placeholder="Phone Number" pattern="\d{3}[-\s]?\d{3}[-\s]?\d{3}" minlength="9"/> <!-- inputmode="numeric" -->
    
    <label for="discord_user">Enter discord username</span>
    <input type="text" name="discord_user" placeholder="Discord Username"/>

    <button type="submit">Confirm</button>
    <button type="button">Cancel</button>
    
</form>

</body>
</html>

<!-- 
//* EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
//? uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$
-->
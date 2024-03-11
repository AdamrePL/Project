<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/settings.css">
</head>
<body>
<a class="return-btn" href="../src/profile.php">&NestedLessLess; Powrót</a>

<div class="user-settings-wrapper">
    <h1> User Settings </h1>

    <form action="" type="">
        <label for="new_password">change password</label>
        <input type="text" name="new_password" placeholder="new password"/>
        
        <label for="con_password">confirm password</label>
        <input type="text" name="con_password" placeholder="confirm new password"/>

        <label for="email_adress">enter email:</label>
        <input type="email" name="email_adress" placeholder="email" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$"/>

        <label for="telephone_number">enter phone number</label>
        <input type="tel" name="telephone_number" placeholder="phone number" pattern="\d{3}[-\s]?\d{3}[-\s]?\d{3}" minlength="9"/> <!-- inputmode="numeric" -->
        
        <label for="discord_user">enter discord username</label>
        <input type="text" name="discord_user" placeholder="discord username"/>

        <label for="email_flag">Autocomplete email as contact form?</label>
        <input type="checkbox" name="email_flag"/>

        <span>
            <button type="submit" id="confirm">confirm</button>
            <button type="button" id="cancel">cancel</button>
        </span>
    <form>
</div>

<!-- //* EMAIL REGEX: "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
//? uhh.. slower regex for email but more precise? ^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$ -->
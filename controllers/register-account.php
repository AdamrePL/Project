<?php
require_once "../conf/config.php";

$path_to_form = "../src/access.php";

if (isset($_SESSION["uid"])) {
    header("Location: / ");
    exit(403);
}

if (!isset($_POST["submit"])) {
    header("Location: $path_to_form?error=submit-error");
    exit(403);
}

include_once "AccountManager.php";

$idk = new AccountManager($conn);

$pass_len = 8;

$email = str_replace(" ", "", trim($_POST["email"]));
$pass = trim($_POST["password"]);
$pass_check = trim($_POST["password-repeat"]);

if (empty($name) || empty($email)) {
    header("Location: $path_to_files?error=empty-fields");
    exit(403);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: $path_to_form?error=incorrect-email");
    exit(422);
}

if (!empty($pass)) {
    if (strlen($pass) < $pass_len) {
        header("Location: $path_to_form?error=shit-too-small-men");
        exit(422);
    }

    if (empty($pass_check)) {
        header("Location: $path_to_form?error=reapeat-required");
        exit(422);
    }

    if ($pass !== $pass_check) {
        header("Location: $path_to_form?error=passwords-dont-match");
        exit(403);
    }

    if (preg_match("/(?=.*\s)/", $pass)) {
        header("Location: $path_to_form?error=processing-data-failure");
        exit(422);
    }

    if (!preg_match("/(?=.*\d)/", $pass)) {
        header("Location: $path_to_form?error=digit-required");
        exit(422);
    }

    if (!preg_match("/(?=.*[A-Z])/", $pass)) {    
        header("Location: $path_to_form?error=capital-letter-required");
        exit(422);
    }

    if (!preg_match("/(?=.*[a-z])/", $pass)) {
        header("Location: $path_to_form?error=lowercase-letter-required");
        exit(422);
    }
}

if (!isset($_POST["accept_tos"])) {
    header("Location: $path_to_form?error=agreement-rejected");
    exit(403);
}

if ($uid = $idk->create_user($email, $pass)) {
// do formularza oraz tutaj dodac wybor czy logowac po zarejestrowaniu czy nie,
//& it ""works""
// jezeli nie to:
    // if (!isset($_POST["login_after_register"])) {
    //     header("Location: ../src/profile.php");
    //     exit(200);
    // } else {
        session_regenerate_id(true);
        $_SESSION["uid"] = $uid;
        $_SESSION["email"] = $email;
        $_SESSION["isadmin"] = 0;
        $_SESSION["first-login"] = 2;
        header("Location: ../src/profile.php");
        exit(200);
    // }
} else {
    header("Location: $path_to_form?error=unexpected-error");
    exit(500);
}
?>
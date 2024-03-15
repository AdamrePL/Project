<?php

require_once "../conf/config.php";

$path_to_form = "../src/access.php";

if (isset($_SESSION["uid"])) {
    header("Location: / ");
    exit(403);
}

if (!isset($_POST["reg"])) {
    header("Location: $path_to_form?error=l_submit_error");
    exit(403);
}

require_once "functions.php";

$uid = trim($_POST["user-id"]);

const UID_PATTERN = "/\w{3,30}(#[a-zA-Z0-9]{3})/";

if (!preg_match(UID_PATTERN, $uid)) {
    header("Location: $path_to_form?error=incorrect-uid");
    exit(422);
}

$uid = explode("#", $uid);
$username = strtolower($uid[0]);
$id = $uid[1];
$uid = $username . '#' . $id;

if (strlen($id) > 3) {
    header("Location: $path_to_form?error=incorrect-tag");
    exit(422);
}


if (!user_exists($conn, $uid)) {
    header("Location: $path_to_form?error=no-user-found");
    exit(403);
}

$pwd = get_user_password($conn, $uid);

if (!empty($pwd) && empty($_POST["l_password"])) {
    header("Location: $path_to_form?error=password-required");
    exit(403);
}

if (password_verify($_POST["l_password"], $pwd)) {
    header("Location: $path_to_form?error=wrong-password");
    exit(403);
}

$sql = "SELECT * FROM `users` WHERE uuid = ?;";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, 's', $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if ($result = mysqli_fetch_assoc($result)) {
    $_SESSION["uid"] = $result["uuid"];
    $_SESSION["isadmin"] = $result["admin"];
    $_SESSION["username"] = $result["username"];
}
update_last_login($conn, $uid);
header("Location: ../src/profile.php?info=success");

$conn -> close();
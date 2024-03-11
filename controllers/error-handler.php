<?php
$errors = explode(",", $_GET["error"]);

function user_error_handler() {
    if (in_array("incorrect-uid", explode(",", $_GET["error"]))) {
        return "niepoprawne uid";
    }
    if (in_array("no-user-found", explode(",", $_GET["error"]))) {
        return "użytkownik nie istnieje";
    }
    if (in_array("incorrect-uid", explode(",", $_GET["error"]))) {
        return "niepoprawne uid";
    }
    

}
<?php
    $code = http_response_code();
    switch ($code) {
        case $code:
            header("Location: $_SERVER[BASE]?error=$code");
            break;

        default:
            header("Location: $_SERVER[BASE]?error=418");
            break;
    }
?>
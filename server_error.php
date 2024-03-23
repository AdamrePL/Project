<?php
    $code = $_GET["error-code"];
    switch ($code) {
        case 404:
            header("Location: $_SERVER[BASE]?error=$code");
            break;
        
        default:
            header("Location: $_SERVER[BASE]?error=418");
            break;
    }
?>
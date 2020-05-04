<?php

function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
    if ($die) {
        die();
    }
}

function redirect($url = false)
{

    if ($url) {
        $redirect = $url;
    } else {
        $redirect = $_SERVER['HTTP_REFERER'] ?? PATH;
    }

    header("Location: $redirect");
    exit();
}

function checkUserData($str) {
    return htmlspecialchars($str, ENT_QUOTES);
}
<?php

function debug($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
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

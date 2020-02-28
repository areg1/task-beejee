<?php

function getSiteLink()
{
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $link = "https://"; 
    } else {
        $link = "http://"; 
    }
    $link .= $_SERVER['HTTP_HOST'];

    return $link;
}
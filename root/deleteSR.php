<?php
     // Check if cookie exists
    if (!empty($_COOKIE['SRID']))
    {
        echo "Cookies are enabled on your browser";
    } 
    else 
    {
        echo "Cookies are NOT enabled on your browser";
    }
    
?>
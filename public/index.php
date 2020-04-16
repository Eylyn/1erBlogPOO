<?php

require '../config/dev.php';
require '../vendor/autoload.php';

try {
    if(isset($_GET['route']))
    {
        if ($_GET['route'] === 'article') {
            require '../templates/single.php';
        }
        else{
            echo 'Page inconnue';   
        }
    }
    else{
        require '../templates/home.php';
    }
} catch (Exception $e) {
    echo 'Erreur';
}
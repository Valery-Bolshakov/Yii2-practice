<?php
//Создали стандартную функцию для дебага и не забываем подлючать его во фронтконтроллере
function debug($data, $die = false)
{
    echo "<pre>" . print_r($data, 1) . "</pre>";
    if ($die) {
        die;
    }
}
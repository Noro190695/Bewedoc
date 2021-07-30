<?php

function dump($p){
    echo '<pre>';
        print_r($p);
    echo '</pre>';
}
function dd($p){
    echo '<pre>';
    print_r($p);
    echo '</pre>';
    die;
}
function view($html,$data = null) {
    include(ROOT . '/app/views/' . $html);
    die;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
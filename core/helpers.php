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
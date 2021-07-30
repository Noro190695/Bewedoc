<?php


namespace app\controllers;


use core\base\views\Views;
use core\base\validation\Validate;

class MainController {

    public function indexAction() {

        Views::render('index.twig', ['name' => NAME]);
    }
}
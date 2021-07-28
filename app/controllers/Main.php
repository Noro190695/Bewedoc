<?php


namespace app\controllers;


use core\base\views\Views;
use core\base\validation\Validate;

class Main {
    private $name = 'ND';
    public function indexAction() {
        $res = Validate::check([
            'Noro' => [
                'required',
                'min' => 3,
                'max' => 10,
            ],
            'norojan56@mail.ru' => ['email']

        ]);

        Views::render('index.twig', ['name' => $this->name]);
    }
}
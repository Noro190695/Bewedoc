<?php


namespace core\base\views;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;


class Views {

    public static function render($view, $params = null){

        $loader = new FilesystemLoader(ROOT.'/app/views');
        $twig = new Environment($loader);
        $twig->addFunction(new TwigFunction('asset', function ($asset) {
            return sprintf('/app/assets/%s', ltrim($asset, '/'));
        }));
        if ($params !== null){
            echo $twig->render($view, $params );
        }else{
            echo $twig->render($view);
        }


    }
    public static function renderTemplate($template, $param){

    }

}
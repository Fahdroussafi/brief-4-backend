<?php


class BaseController{

    protected array $data = [];

    protected function view($path,$data = []){
        if (file_exists($path.'.php'))
        require_once $path.'.php';
        else die("View $path does not exist!");
    }

    protected  function getModleInstance($modle){
        if (file_exists('Modles/'.ucwords($modle).'.php')) {
            require_once 'Modles/'.ucwords($modle).'.php';
            return new $modle;
        }
        return  false;
    }

}
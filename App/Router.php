<?php

class Router{

    private array $handlers;
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    public function get(string $path,$handler){
        $this->addHandler(self::METHOD_GET,$path,$handler);
    }

    public function post(string $path,$handler){
        $this->addHandler(self::METHOD_POST,$path,$handler);
    }

    private function addHandler(string $method,string $path,$handler){
        $this->handlers[$method.$path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function run(){

        $requestPath = $_SERVER['PATH_INFO'] ? $_SERVER['PATH_INFO'] : '/';
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $callBack = null;

        foreach($this->handlers as $handler){

            if($requestMethod === $handler['method'] && $requestPath === $handler['path']){

                if(is_callable($handler['handler'])){
                    $callBack = $handler['handler'];
                }else if(is_array($handler['handler'])){

                    $method = $handler['handler'][1] ?? 'index';

                    $_handler = $handler['handler'][0];
                    $controller = new $_handler;
                    $callBack = [$controller,$method];

                }

            }

        }

        call_user_func_array($callBack,[array_merge($_GET,$_POST)]);
    }
}
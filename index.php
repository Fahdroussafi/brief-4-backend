<?php

require_once 'App/Router.php';
require_once  'App/BaseController.php';
require_once  'Controllers/Employee.php';
require_once 'App/Database.php';

$router = new Router();

$router->get('/employees',[Employees::class,'getEmployees']);

$router->run();

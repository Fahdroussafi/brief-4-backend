<?php

require_once 'App/Router.php';
require_once  'App/BaseController.php';
require_once  'Controllers/Employee.php';
require_once 'App/Database.php';

require_once './dump.php';

$router = new Router();

$router->get('/employees',[Employees::class,'getEmployees']);
$router->post('/employees',[Employees::class,'getEmployeeBy']);
$router->get('/addemployee',[Employees::class,'showForm']);
$router->post('/addemployee',[Employees::class,'addEmployee']);
$router->post('/employees/remove',[Employees::class,'removeEmployee']);

$router->run();
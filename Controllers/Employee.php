<?php

class Employees extends  BaseController {



    public function getEmployees(){
        $mdl = $this->getModleInstance('Employee');
        $this->data = $mdl->selectEmployees();
        //echo '<pre>';
        //print_r($this->data);

        $this->view("Views/employees",$this->data);
    }

    public function __get($attr){
        return $this->$attr;
    }

    public function __set($attr,$value){
        $this->$attr = $value;
    }

    public function login($user,$passwd){
        if ($user && $passwd) header('location:pages/home.php');
        else header('location:pages/404.php');
        // TODO: Login handling...
    }

}
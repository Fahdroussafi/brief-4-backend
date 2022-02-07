<?php

class Employees extends  BaseController {

    public function getEmployees(){
        $mdl = $this->getModleInstance('Employee');
        $this->data = $mdl->selectEmployees();
        $this->view("Views/employees",$this->data);
    }

    public function getEmployeeBy($params){
        $mdl = $this->getModleInstance('Employee');

        if (isset($params['select'])) {
            if (!empty($params['select'])) {
                $searchBY = $params['select'];
                $value = $params['value'];
                $this->data = $mdl->searchEmloyee($searchBY,"%$value%");
                $this->view("Views/employees",$this->data);
                return;
            }
        }

        $this->getEmployees();

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
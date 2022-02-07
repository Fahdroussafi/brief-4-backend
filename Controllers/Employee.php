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

    public function showForm(){
        $this->view('Views/addemployee');
    }

    public function addEmployee(){

        $mdl = $this->getModleInstance('Employee');

        if (!isset($_POST['id']) || !isset($_POST['username']) || !isset($_POST['passwd'])) {
            $data['message'] = 'ID, Username and password are required!';
            $this->view('Views/addemployee',$data);
            return;
        }

        $employeeID = $_POST['id'];

        if ($mdl->employeeExist($employeeID)) {
            $data['message'] = "ID: $employeeID already exist!";
            $this->view('Views/addemployee',$data);
            return;
        }

        $username = $_POST['username'];
        $passwd = $_POST['passwd'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        
        if($mdl->insertEmployee($employeeID, $username, $passwd, $phone, $email)){
            $data['message'] = 'Employee added successfully!';
            $this->view('Views/addemployee',$data);
            return;
        }

        $data['message'] = 'Ops somthing went wrong!';
        $this->view('Views/addemployee',$data);
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
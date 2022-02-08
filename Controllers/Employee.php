<?php

class Employees extends  BaseController {

    public function getEmployees(){
        $mdl = $this->getModleInstance('Employee');
        $this->data['employees'] = $mdl->selectEmployees();
        $this->view("Views/employees",$this->data);
    }

    public function getEmployeeBy($params){
        $mdl = $this->getModleInstance('Employee');

        if (isset($params['select'])) {
            echo 'is set';
            if (!empty($params['select'])) {
                $searchBY = $params['select'];
                $value = $params['value'];
                $this->data['employees'] = $mdl->searchEmloyee($searchBY,"%$value%");
                $this->view("Views/employees",$this->data);
            }else  $this->getEmployees();
        }

    }

    public function showForm(){
        $this->view('Views/addemployee');
    }

    public function addEmployee($params){

        $mdl = $this->getModleInstance('Employee');

        if (!isset($params['id']) || !isset($params['username']) || !isset($params['passwd'])) {
            $data['message'] = 'ID, Username and password are required!';
            $this->view('Views/addemployee',$data);
            return;
        }

        $employeeID = $params['id'];

        if ($mdl->employeeExist($employeeID)) {
            $data['message'] = "ID: $employeeID already exist!";
            $this->view('Views/addemployee',$data);
            return;
        }

        $username = $params['username'];
        $passwd = $params['passwd'];
        $phone = $params['phone'];
        $email = $params['email'];
        
        if($mdl->insertEmployee($employeeID, $username, $passwd, $phone, $email)){
            $data['message'] = 'Employee added successfully!';
            $this->view('Views/addemployee',$data);
            return;
        }

        $data['message'] = 'Ops somthing went wrong!';
        $this->view('Views/addemployee',$data);
    }

    public function removeEmployee($params){
        
        // dump($params);

        if (isset($params['delete'])) {
            $mdl = $this->getModleInstance('Employee');
            $id =  $params['id'];

            if($mdl->deleteEmployee($id)){
                $this->data['message'] = 'Employee removed successfully';
            }else{
                $this->data['message']  = 'Ops somthing went wrong!';
            }

            $this->getEmployees();

        }


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
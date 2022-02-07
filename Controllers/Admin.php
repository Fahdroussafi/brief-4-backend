<?php

class Admin extends Employee{

    public $newAttr;
    
    public function __construct($id,$uname,$passwd,$newAttr){
        parent::__construct($id,$uname,$passwd);
        $this->newAttr = $newAttr;
    }

    public function addEmployee(){
        // TODO: Add an employee...
        echo 'Adding employee...';
    }

    public function removeEmployee($id){
        // TODO: Remove an employee...
        echo "Removing employee... [ID:$id]";
    }

    public function hi(){
        return "Hi i am child class of ".parent::hi();
    }
    

}
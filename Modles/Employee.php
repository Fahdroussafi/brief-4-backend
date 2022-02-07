<?php


class Employee extends Database {

    public function __construct($table='employee', $primaryKey='id'){
        parent::__construct($table, $primaryKey);
    }

    public function selectEmployees():array{
        $result = $this->conn->query("SELECT * FROM employee");
        $employees = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
                array_push($employees, $row);
        }

        return $employees;
    }

    public function searchEmloyee($searchBy,$value){
        $stmt = $this->conn->prepare("SELECT * FROM employee WHERE $searchBy LIKE ?");
        $stmt->bind_param('s',$value);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $employees = [];
    
        while($emp = $result->fetch_assoc())
        array_push($employees,$emp);
    
        return $employees;
    }

}
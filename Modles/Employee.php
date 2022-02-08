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

    public function employeeExist($id){
        $stmt = $this->conn->prepare("SELECT * FROM employee WHERE employeeID=?");
        $stmt->bind_param('s',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function insertEmployee($employeeID, $username, $passwd, $phone, $email){
        $sql = "INSERT INTO `employee` (`employeeID`,`username`,`passwd`,`phone`,`email`) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $employeeID, $username, $passwd, $phone, $email);

        return $stmt->execute();
    }

    public function deleteEmployee($id){
        $stmt = $this->conn->prepare("DELETE FROM `employee` WHERE `employee`.`employeeID` = ?");
        $stmt->bind_param('s',$id);
        return $stmt->execute();
    }

}
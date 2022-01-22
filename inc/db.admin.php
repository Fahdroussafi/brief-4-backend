<?php

require_once 'connect.php';

function idExist($conn,$id){
    $stmt = $conn->prepare("SELECT * FROM employee WHERE employeeID=?");
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function insertEmployee($conn, $employeeID, $username, $passwd, $phone, $email)
{
    $sql = "INSERT INTO `employee` (`employeeID`,`username`,`passwd`,`phone`,`email`) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $employeeID, $username, $passwd, $phone, $email);

    return $stmt->execute();
}


function getEmployees($conn)
{
    $result = $conn->query("SELECT * FROM employee");
    $employees = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc())
            array_push($employees, $row);
    }

    return $employees;
}

function deleteEmployee($conn, $employeeID)
{

    $stmt = $conn->prepare("DELETE FROM `employee` WHERE `employee`.`employeeID` = ?");
    $stmt->bind_param('s', $employeeID);
    return $stmt->execute();
}


<?php

require_once 'connect.php';

function usernameExist($conn,$table,$username){
    $stmt = $conn->prepare("SELECT username,email FROM $table WHERE username=?");
    $stmt->bind_param('s',$username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0 ? $result->fetch_assoc() : 0;   
}

function emailExist($conn,$table,$email){
    $stmt = $conn->prepare("SELECT email,username FROM $table WHERE email=?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0 ? $result->fetch_assoc() : 0;   
}


function adminExist($conn,$email,$passwd){
    if(emailExist($conn,'admin',$email)){
        $stmt = $conn->prepare("SELECT username,email FROM admin WHERE email=? AND passwd=?");
        $stmt->bind_param('ss',$email,$passwd);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : false;           
    }
    return false;
}

function employeeExist($conn,$username,$passwd){
    if(usernameExist($conn,'employee',$username)){
        $stmt = $conn->prepare("SELECT username,email FROM employee WHERE username=? AND passwd=?");
        $stmt->bind_param('ss',$username,$passwd);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? $result->fetch_assoc() : false;           
    }
    return false;
}
<?php

session_start();

function auth($role = null){
    if (!isset($_SESSION['logedIn']) || !$_SESSION['logedIn']){
        header('location: login.php');
        exit;
    }

    if ($role && $_SESSION['role'] != $role) {
        header('location: dashboard.php');
        exit;
    }
}
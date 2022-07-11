<?php
include_once('employeestorage.php');
include_once('userstorage.php');
include_once('auth.php');

session_start();
$auth = new Auth(new UserStorage());

$employeeStorage = new EmployeeStorage();


$employeeid = $_GET['id'];



$employeeStorage->delete($employeeid);

$site ="Location: employees.php?";
    
header($site);
exit();




<?php
include_once('employeestorage.php');
include_once('userstorage.php');
include_once('auth.php');

session_start();
$auth = new Auth(new UserStorage());

$isadmin=false;

if ($auth->is_authenticated()){
    if (in_array("admin", $auth->authenticated_user()['roles'])){
        $isadmin=true;
    }
}

$employeeStorage = new EmployeeStorage();


$employeeid = $_GET['id'];


if($isadmin){
$employeeStorage->delete($employeeid);
}

$site ="Location: employees.php?";
    
header($site);
exit();




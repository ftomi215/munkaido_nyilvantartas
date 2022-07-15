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
$userStorage = new UserStorage();



$employeeid = $_GET['id'];
$employee = $employeeStorage->findById($employeeid);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtr=device-widtr, initial-scale=1.0">
    <title>Dolgozó adatai</title>
</head>
<body>
    <h1><?=$employee['title']." ".$employee['familyname']." ".$employee['forename1']." ".$employee['forename2']." "?>adatai:</h1>


    <table>
    <tr>
        <td>Név</td>
        <td><?=$employee['title']." ".$employee['familyname']." ".$employee['forename1']." ".$employee['forename2']?></td>
    </tr>
    <tr>
        <td>Születési idő</td>
        <td><?=$employee['birthdate']?></td>
    </tr>
    <tr>
        <td>Születési hely</td>
        <td><?=$employee['birthplace']?></td>
    </tr>
    <tr>
        <td>Állampolgárság</td>
        <td><?=$employee['nationality']?></td>
    </tr>
    <tr>
        <td>Anyja neve</td>
        <td><?=$employee['nameofmother']?></td>
    </tr>
    <tr>
        <td>Nem</td>
        <td><?=$employee['gender']?></td>
    </tr>
    <tr>
        <td>Adóazonosító jel</td>
        <td><?=$employee['tax']?></td>
    </tr>
    <tr>
        <td>Törzsszám</td>
        <td><?=$employee['idnumber']?></td>
    </tr>
    <tr>
        <td>Tajszám</td>
        <td><?=$employee['taj']?></td>
    </tr>
    <tr>
        <td>Jogviszony kezdete</td>
        <td><?=$employee['hired_since']?></td>
    </tr>
    <tr>
        <td>Munkakör</td>
        <td><?=$employee['vacation']?></td>
    </tr>
    <tr>
        <td>Éves szabadságkeret (órában megadva)</td>
        <td><?=$employee['title']?></td>
    </tr>
    <tr>
        <td>Éves betegszabadság-keret (órában megadva)</td>
        <td><?=$employee['sickleave']?></td>
    </tr>
    <tr>
        <td>Munkaidő</td>
        <td><?=$employee['worktime']?></td>
    </tr>
    <tr>
        <td>Szerződés szerinti napi munkaidő (órában megadva)</td>
        <td><?=$employee['dailywork']?></td>
    </tr>
    <tr>
        <td>Jogviszony típusa</td>
        <td><?=$employee['legreltype']?></td>
    </tr>
    <tr>
        <td>Megjegyzés</td>
        <td><?=$employee['comment']?></td>
    </tr>
    
    </table>







</body>
</html>
<?php
include_once('storage.php');
include_once('userstorage.php');
include_once('employeestorage.php');
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

$employees = $employeeStorage->findAll([]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolgozók</title>
</head>
<body>

    <h1>Dolgozók:</h1>
    <table>
        <th>Név</th>
        <th>Születési idő</th>
        <?php if($isadmin){?>
            <th>Adóazonosító jel</th><?php
        }?>
        <th>Jogviszony kezdete</th>
        <th>Munkakör</th>
        <th>Műveletek</th>
        <?php foreach ($employees as $employee) : ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?= $employee["title"]." ".$employee["familyname"]." ".$employee["forename1"]." ".$employee["forename2"]?></td>
            <td style="text-align: center; vertical-align: middle;"><?= $employee["birthdate"]?></td>
            <?php if($isadmin){?>
                <td style="text-align: center; vertical-align: middle;"><?= $employee["tax"]?></td><?php
            }?>
                <td style="text-align: center; vertical-align: middle;"><?= $employee["hired_since"]?></td>
            <td style="text-align: center; vertical-align: middle;"><?= $employee["position"]?></td>
            <td style="text-align: center; vertical-align: middle;">
                <a href="employeedetails.php?id=<?=$employee['id']?>"><img src="images/more_info.jpg" alt="adatok" width="14" heigth="14"></a>
                <?php if($isadmin){?>
                    <a href="modifyemployee.php?id=<?=$employee['id']?>"><img src="images/edit.png" alt="módosít" width="12" heigth="12"></a>
                    <a href="deleteemployee.php?id=<?=$employee['id']?>"><img src="images/delete.png" alt="töröl" width="12" heigth="12"></a><?php
                }?>
            </td>
        </tr>
        <?php endforeach ?>
    </table>

    
</body>
</html>



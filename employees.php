<?php
include_once('storage.php');
include_once('userstorage.php');
include_once('employeestorage.php');
include_once('auth.php');

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

    <p>Dolgozók:</p>
    <table>
        <th>Név</th>
        <th>Születési idő</th>
        <th>Adóazonosító jel</th>
        <th>Jogviszony kezdete</th>
        <th>Munkakör</th>
        <th>Műveletek</th>
        <?php foreach ($employees as $employee) : ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?= $employee["title"]." ".$employee["familyname"]." ".$employee["forename1"]." ".$employee["forename2"]?></td>
            <td style="text-align: center; vertical-align: middle;"><?= $employee["birthdate"]?></td>
            <td style="text-align: center; vertical-align: middle;"><?= $employee["tax"]?></td>
            <td style="text-align: center; vertical-align: middle;"><?= $employee["hired_since"]?></td>
            <td style="text-align: center; vertical-align: middle;"><?= $employee["position"]?></td>
            <td style="text-align: center; vertical-align: middle;"><a href="modifyemployee.php?id=<?=$employee['id']?>"><img src="images/edit.png" alt="módosít" width="12" heigth="12"></a> <a href="deleteemployee.php?id=<?=$employee['id']?>"><img src="images/delete.png" alt="töröl" width="12" heigth="12"></a></td>
        </tr>
        <?php endforeach ?>
    </table>

    
</body>
</html>



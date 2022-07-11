<?php
include_once('storage.php');
include_once('userstorage.php');
include_once('employeestorage.php');
include_once('auth.php');

$employeeStorage = new EmployeeStorage();


$data = [];
$errors = [];

if (count($_POST) > 0) {
    

        $data['title'] = $_POST['title'];
        $data['familyname'] = $_POST['familyname'];
        $data['forename1'] = $_POST['forename1'];
        $data['forename2'] = $_POST['forename2'];
        $data['birthdate'] = $_POST['birthdate'];
        $data['birthplace'] = $_POST['birthplace'];
        $data['nationality'] = $_POST['nationality'];
        $data['nameofmother'] = $_POST['nameofmother'];
        $data['gender'] = $_POST['gender'];
        $data['tax'] = $_POST['tax'];
        $data['idnumber'] = $_POST['idnumber'];
        $data['taj'] = $_POST['taj'];
        $data['hired_since'] = $_POST['hired_since'];
        $data['position'] = $_POST['position'];
        $data['position'] = $_POST['position'];
        $data['vacation'] = $_POST['vacation'];
        $data['sickleave'] = $_POST['sickleave'];
        $data['worktime'] = $_POST['worktime'];
        $data['dailywork'] = $_POST['dailywork'];
        $data['legreltype'] = $_POST['legreltype'];
        $data['comment'] = $_POST['comment'];
        $data['role'] = $_POST['role'];
        





        /* date_default_timezone_set("Europe/Budapest");
        $data['hired_since']=date('Y-m-d', time()+ 2168); */
        $employeeStorage->add($data);
        header('Location: index.php?');
        exit();
    
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolgozó felvétele</title>
</head>
<body>

<p>Dolgozó felvétele</p>

  
        <form action="" method="post" novalidate>
        <p>Titulus:</p>
        <input type="text" name="title">
        <?php if(isset($errors['title'])): ?>
            <span style="color: red"> <?= $errors['title'] ?> </span>
        <?php endif ?>

        <p>Családnév:</p>
        <input type="text" name="familyname">
        <?php if(isset($errors['familyname'])): ?>
            <span style="color: red"> <?= $errors['familyname'] ?> </span>
        <?php endif ?>

        <p>Utónév1:</p>
        <input type="text" name="forename1">
        <?php if(isset($errors['forename1'])): ?>
            <span style="color: red"> <?= $errors['forename1'] ?> </span>
        <?php endif ?>

        <p>Utónév2:</p>
        <input type="text" name="forename2">
        <?php if(isset($errors['forename2'])): ?>
            <span style="color: red"> <?= $errors['forename2'] ?> </span>
        <?php endif ?>

        <p>Születési idő:</p>
        <input type="date" name="birthdate">
        <?php if(isset($errors['birthdate'])): ?>
            <span style="color: red"> <?= $errors['birthdate'] ?> </span>
        <?php endif ?>

        <p>Születési hely:</p>
        <input type="text" name="birthplace">
        <?php if(isset($errors['birthplace'])): ?>
            <span style="color: red"> <?= $errors['birthplace'] ?> </span>
        <?php endif ?>

        <p>Állampolgárság:</p>
        <input type="text" name="nationality">
        <?php if(isset($errors['nationality'])): ?>
            <span style="color: red"> <?= $errors['nationality'] ?> </span>
        <?php endif ?>

        <p>Anyja neve:</p>
        <input type="text" name="nameofmother">
        <?php if(isset($errors['nameofmother'])): ?>
            <span style="color: red"> <?= $errors['nameofmother'] ?> </span>
        <?php endif ?>

        <p>Nem:</p>
        <input type="radio" id="man" name="gender" value="férfi">
        <label for="man">Férfi</label><br>
        <input type="radio" id="woman" name="gender" value="nő">
        <label for="woman">Nő</label><br> 
        <?php if(isset($errors['gender'])): ?>
            <span style="color: red"> <?= $errors['gender'] ?> </span>
        <?php endif ?> 
        <!-- <input type="text" name="gender">
        <?php if(isset($errors['gender'])): ?>
            <span style="color: red"> <?= $errors['gender'] ?> </span>
        <?php endif ?> -->

        <p>Adóazonosító jel:</p>
        <input type="number" name="tax">
        <?php if(isset($errors['tax'])): ?>
            <span style="color: red"> <?= $errors['tax'] ?> </span>
        <?php endif ?>

        <p>Törzsszám:</p>
        <input type="number" name="idnumber">
        <?php if(isset($errors['idnumber'])): ?>
            <span style="color: red"> <?= $errors['idnumber'] ?> </span>
        <?php endif ?>

        <p>Tajszám:</p>
        <input type="number" name="taj">
        <?php if(isset($errors['taj'])): ?>
            <span style="color: red"> <?= $errors['taj'] ?> </span>
        <?php endif ?>

        <p>Jogviszony kezdete:</p>
        <input type="date" name="hired_since">
        <?php if(isset($errors['hired_since'])): ?>
            <span style="color: red"> <?= $errors['hired_since'] ?> </span>
        <?php endif ?>

        <p>Munkakör:</p>
        <input type="text" name="position">
        <?php if(isset($errors['position'])): ?>
            <span style="color: red"> <?= $errors['position'] ?> </span>
        <?php endif ?>
        
        <p>Éves szabadságkeret (órában megadva):</p>
        <input type="number" name="vacation">
        <?php if(isset($errors['vacation'])): ?>
            <span style="color: red"> <?= $errors['vacation'] ?> </span>
        <?php endif ?>

        <p>Éves betegszabadság-keret (órában megadva):</p>
        <input type="number" name="sickleave">
        <?php if(isset($errors['sickleave'])): ?>
            <span style="color: red"> <?= $errors['sickleave'] ?> </span>
        <?php endif ?>

        <p>Munkaidő:</p>
        <input type="radio" id="fulltime" name="worktime" value="full-time">
        <label for="fulltime">Teljes munkaidő</label><br>
        <input type="radio" id="parttime" name="worktime" value="part-time">
        <label for="parttime">Részmunkaidő</label><br> 
        <?php if(isset($errors['worktime'])): ?>
            <span style="color: red"> <?= $errors['worktime'] ?> </span>
        <?php endif ?> 
        <!-- <input type="number" name="vacation">
        <?php if(isset($errors['text'])): ?>
            <span style="color: red"> <?= $errors['vacation'] ?> </span>
        <?php endif ?> -->

        <p>Szerződés szerinti napi munkaidő (órában megadva):</p>
        <input type="number" name="dailywork">
        <?php if(isset($errors['dailywork'])): ?>
            <span style="color: red"> <?= $errors['dailywork'] ?> </span>
        <?php endif ?>

        <p>Jogviszony típusa:</p>
        <input type="text" name="legreltype">
        <?php if(isset($errors['legreltype'])): ?>
            <span style="color: red"> <?= $errors['legreltype'] ?> </span>
        <?php endif ?>

        <p>Megjegyzés:</p>
        <input type="text" name="comment">
        <?php if(isset($errors['comment'])): ?>
            <span style="color: red"> <?= $errors['comment'] ?> </span>
        <?php endif ?>
        

        <br><br>
        <button>Felvétel</button>
        </form>    

    
</body>
</html>
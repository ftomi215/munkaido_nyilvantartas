<?php
include_once('storage.php');
include_once('userstorage.php');
include_once('auth.php');

$userStorage = new UserStorage();
session_start();
$auth = new Auth(new UserStorage());


$userid = $_GET['id'];
$user = $userStorage->findById($userid);

$errors = [];
$data = [];
if (count($_POST) > 0) {
    
    if($_POST['ps1']==$_POST['ps2']){

    $data['username'] = $user['username'];
    $data['password'] = password_hash($_POST['ps1'], PASSWORD_DEFAULT);
    $data['email'] = $user['email'];
    $data['personid'] = $user['personid'];
    $data['roles'] = $user['roles'];
    $data['id'] = $_GET['id'];
    
    $userStorage->update($userid,$data);

    header('Location: successfulmodification.html');
    exit();
    }
    else{
        $errors['ps'] = 'A két jelszó nem egyezik meg!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelszó módosítása</title>
</head>
<body>
    <h1>Jelszó módosítása</h1>

    <form action="" method="post">
    <p>Adja meg új jelszavát:</p>
    <input type="password" name="ps1"><br>

    <p>Adja meg új jelszavát újra:</p>
    <input type="password" name="ps2">
    <?php if(isset($errors['ps'])): ?>
            <span style="color: red"> <?= $errors['ps'] ?> </span>
    <?php endif ?><br><br>

    <button>Megváltoztat</button>

    </form>
</body>
</html>
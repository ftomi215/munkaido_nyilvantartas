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
if (count($_POST) > 0) {

    if($auth->authenticate($user['username'],$_POST['ps'])){
        header('Location: changepassword.php?id='.$userid);
        exit();
    }
    else{
        $errors['ps']='Helytelen jelszó!';
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelszó módosítás</title>
</head>
<body>
    <h1>Jelszava megváltoztatása előtt, kréjük adja meg jelenlegi jelszavát!</h1>

    <form action="" method="post">
    <input type="password" name="ps">
    <?php if(isset($errors['ps'])): ?>
            <span style="color: red"> <?= $errors['ps'] ?> </span>
    <?php endif ?>
    <br><br>
    <button>Küldés</button>
    </form>
</body>
</html>
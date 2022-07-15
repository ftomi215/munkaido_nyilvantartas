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
    

    $data['username'] = $_POST['username'];
    $data['password'] = $user['password'];
    $data['email'] = $_POST['email'];
    $data['personid'] = $user['personid'];
    $data['roles'] = $user['roles'];
    $data['id'] = $_GET['id'];
    
    $userStorage->update($userid,$data);

    header('Location: successfulmodification.html');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Személyes adatok módosítása</title>
</head>
<body>
    <h1>Személyes adatok módosítása</h1>
    <br>


    <form action="" method="post" novalidate>
        <p>Felhasználónév:</p>
        <input type="text" name="username" value="<?= $user['username'] ?>">
        <?php if(isset($errors['username'])): ?>
            <span style="color: red"> <?= $errors['username'] ?> </span>
        <?php endif ?>

        <p>E-mail cím:</p>
        <input type="text" name="email" value="<?= $user['email'] ?>">
        <?php if(isset($errors['email'])): ?>
            <span style="color: red"> <?= $errors['email'] ?> </span>
        <?php endif ?>
        <br><br>
        <button>Módosít</button>

        <br><br>
        <a href="passwordcheck.php?id=<?=$auth->authenticated_user()['id']?>">Jelszó módosítása</a>
    </form>

</body>
</html>
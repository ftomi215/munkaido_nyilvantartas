<?php
include_once('storage.php');

include_once('userstorage.php');
include_once('auth.php');


session_start();
$auth = new Auth(new UserStorage());




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kezdőlap</title>
</head>
<body>

    <?php if (!$auth->is_authenticated()) {?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    <?php } 
    else{?>
        <p>Hello, <?= $auth -> authenticated_user()['username'] ?>!</p>

        <br>
        <a href="employees.php">Dolgozók</a>
        <br>

        <br>
        <a href="addemployee.php">Új dolgozó felvétele</a>
        <br>
        <br>

        <a href="logout.php">Logout</a>
    <?php } ?>
    
    

    
    
    
</body>
</html>
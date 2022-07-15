<?php
include_once('storage.php');

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


date_default_timezone_set('Europe/Budapest');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
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
        <!-- <a href="register.php">Regisztráció</a> -->
        <a href="login.php">Bejelentkezés</a>
    <?php } 
    else{?>
        <h1>Hello, <?= $auth -> authenticated_user()['username'] ?>!</h1>

        <br>
        <a href="editpersonaldata.php?id=<?=$auth->authenticated_user()['id']?>">Személyes adatok szerkesztése</a>
        <br>

        <br>
        <a href="employees.php">Dolgozók</a>
        <br>

        <br>
        <a href="calendar.php?ym=<?php echo date('Y-m', $timestamp) ?>&day=<?php echo date('d', $timestamp) ?>">Beosztásom</a>
        <br>


        <?php
        if ($isadmin){
            ?><br>
            <a href="addemployee.php">Új dolgozó felvétele</a>
            <br><?php
        }
        
        ?>
        <br>

        <a href="logout.php">Kijelentkezés</a>
    <?php } ?>
    
    

    
    
    
</body>
</html>
<?php

include('storage.php');
include('auth.php');
include('userstorage.php');

// functions
function validate($post, &$data, &$errors) {
    if (!isset($post['username'])) {
        $errors['username'] = 'Nem adott meg felhasználónevet!';
      }
      else if (trim($post['username']) === '') {
        $errors['username'] = 'Nem adott meg felhasználónevet!';
      }
      else {
        $data['username'] = $post['username'];
      }
    
      if (!isset($post['email'])) {
        $errors['email'] = 'Nem adott meg e-mail címet!';
      }
      else if (trim($post['email']) === '') {
        $errors['email'] = 'Nem adott meg e-mail címet!';
      }
      else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Az e-mail cím helytelen!';
    }
    else{
        $data['email'] = $post['email'];
    }

    if (!isset($post['password'])) {
        $errors['password'] = 'Nem adott meg jelszavat!';
    }
    else if (trim($post['password']) === '') {
        $errors['password'] = 'Nem adott meg jelszavat!';
    }
    else if (strcmp($post['password'], $post['password_again']) !== 0){
        $errors['password'] = 'A jelszavak nem egyeznek meg!';
    }
    else{
        $data['password'] = $post['password'];
    }

    if (!isset($post['password_again'])) {
        $errors['password_again'] = 'Nem adott meg jelszavat!';
    }
    else if (trim($post['password']) === '') {
        $errors['password_again'] = 'Nem adott meg jelszavat!';
    }


  

  return count($errors) === 0;
}

function redirect($page) {
    header("Location: ${page}");
    exit();
}

// main
$user_storage = new UserStorage();
$auth = new Auth($user_storage);
$errors = [];
$data = [];
if (count($_POST) > 0) {
  if (validate($_POST, $data, $errors)) {
    if ($auth->user_exists($data['username'])) {
      $errors['global'] = "Már létezik ilyen nevű felhasználó";
    } else {
      $auth->register($data);
      redirect('login.php');
    } 
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
</head>
<body>
    <h1>Regisztráció</h1>
    <?php if (isset($errors['global'])) : ?>
  <p><span class="error"><?= $errors['global'] ?></span></p>
<?php endif; ?>
<form action="" method="post">
  <div>
    <label for="username">Felhasználónév: </label><br>
    <input type="text" name="username" id="username" value="<?= $_POST['username'] ?? "" ?>">

    <?php if (isset($errors['username'])) : ?>
      <span class="error"><?= $errors['username'] ?></span>
    <?php endif; ?>
  </div>
  <div>
    <label for="password">Jelszó: </label><br>
    <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? "" ?>">
    <?php if (isset($errors['password'])) : ?>
      <span class="error"><?= $errors['password'] ?></span>
    <?php endif; ?>
  </div>
  <div>
    <label for="password_again">Jelszó újra: </label><br>
    <input type="password" name="password_again" id="password_again" value="<?= $_POST['password_again'] ?? "" ?>">
    <?php if (isset($errors['password_again'])) : ?>
      <span class="error"><?= $errors['password_again'] ?></span>
    <?php endif; ?>
  </div>
  <div>
    <label for="email">E-mail cím: </label><br>
    <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? "" ?>">
    <?php if (isset($errors['email'])) : ?>
      <span class="error"><?= $errors['email'] ?></span>
    <?php endif; ?>
  </div>
  <div>
    <button type="submit">Regisztrálás</button>
  </div>
</form>




</body>
</html>
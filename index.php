<?php
    require_once 'config.php';
    require_once 'db_conn.php';
    


    require_once 'User.php';

    
    
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
      $newUsername=$_POST['username'];
      $newEmail=$_POST['email'];
      $newPassword=$_POST['password'];
    
    $newUser = new User();
    $newUser->setUsername($newUsername);
    $newUser->setEmail($newEmail);
    $newUser->setPassword($newPassword);
    $newUser->saveToDB($mysqli);
    }

    
    include_once 'logIn.php';
    
    if(isset($name)) echo $name.' Witaj na stronie głównej';
    
   // require_once 'foot.php';
    
?>

<?php
    session_start();
    
    require_once 'config.php';
    require_once 'db_conn.php';
    
    require_once 'src/User.php';

    if(!isset($_SESSION['userId'])){
    
        $_SESSION['userId'] = 0;
    }
    
    if($_SESSION['userId']>0){
        include_once 'posts.php';
    }else{   
        include_once 'logIn.php';
    }
    
    
            function registerNewUser($mysqli){

                $userId = 0;

                if(isset($_POST['new_user']) && isset($_POST['new_email']) && isset($_POST['new_password'])){
                  $newUsername=$_POST['new_user'];
                  $newEmail=$_POST['new_email'];
                  $newPassword=$_POST['new_password'];

                  $sql = 'Select email FROM Users';
                  $result=$mysqli->query($sql);
                    if($result==true){
                      $row=$result->fetch_assoc();
                        if($row['email']==$newEmail){
                            echo '<font color="red">Podany e-mail już istnieje</font>';
                        }else{

                        $newUser = new User();
                        $newUser->setUsername($newUsername);
                        $newUser->setEmail($newEmail);
                        $newUser->setPassword($newPassword);
                        $newUser->saveToDB($mysqli);

                        $userId = $mysqli->insert_id;
                        }

                    }

                return $_SESSION['userId'] = $userId;
                }
            }
        
        registerNewUser($mysqli);
        
if(isset($_POST['logOut']) && $_SESSION['userId']>0){
    unset($_SESSION['userId']);
}
    
    require_once 'foot.php';
    $mysqli->close();
    $mysqli=null;

<?php
    session_start();
    
    require_once 'config.php';
    require_once 'db_conn.php';
    
    require_once 'src/User.php';
    require_once 'src/Tweet.php';

    
        
            function registerNewUser($mysqli){

                $newUserId = null;

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

                        $newUserId = $mysqli->insert_id;
                        }

                    }

                return $newUserId; 
                }

            }
   // $_SESSION['userId']=registerNewUser($mysqli);  
    if(!isset($_SESSION['userId'])){
    
        include_once 'logIn.php';
            
    }else{
        include_once 'posts.php';
    
    }
    

        
            
if(isset($_POST['logOut']) && isset($_SESSION['userId'])){
    unset($_SESSION['userId']);
}
    
    require_once 'foot.php';
    $mysqli->close();
    $mysqli=null;

<?php
    require_once 'config.php';
    require_once 'db_conn.php';
    


    require_once 'Class/User.php';

    
    include_once 'logIn.php';
    
    if(isset($_POST['username']) && isset($_POST['Email']) && isset($_POST['Password'])){
      $newUsername=$_POST['username'];
      $newEmail=$_POST['Email'];
      $newPassword=$_POST['Password'];
      
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
            
             $sql="SELECT * FROM Users";
             $result=$mysqli->query($sql);
                 if($result==true && $result->num_rows>0){
                     foreach ($result as $row){
                      if($row['email']==$newEmail){
                        $id = $row['id'];
                        $name = $row['username']; 
                      }
                     }

                 //var_dump($id);
             }
             
   
            $user=User::loadUserById($mysqli, $id);
           // print_r($newUser);
                return true;

             }
    
     }
    }
    


    
    
  
      if (isset($user)){       
           echo '<h3>'.$name.', witaj na stronie głównej!</h3>';
           
          include_once 'Class/Tweet.php';
          include_once 'posts.php';//tutaj utknęłam!
             //var_dump($date);
              var_dump($id);

      }
    
   // require_once 'foot.php';
    $mysqli->close();
    $mysqli=null;
?>

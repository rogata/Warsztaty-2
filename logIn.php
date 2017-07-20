<?php
 
    function userLogin ($mysqli) {
        
        $userId = 0;
        
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['logIn'])){
            $email=$_POST['email'];
            $password=$_POST['password'];
             
            $users = User::loadAllUsers($mysqli);
            for($i=0; $i<count($users); $i++){
                
                $userEmail = $users[$i]->getEmail();
                $userPassword = $users[$i]->getPassword();
            
                if($userEmail==$email && password_verify($password, $userPassword)){

                  $userId = $users[$i]->getId();
                 

                }elseif($userEmail==$email && password_verify($password, $userPassword)==false) {
                    echo '<font color="red">Błędny login lub hasło!</font>';
                }elseif($userEmail!=$email && password_verify($password, $userPassword)) {
                    echo '<font color="red">Błędny login lub hasło!</font>';
                }
                
            }
            return $_SESSION['userId'] = $userId;
        }
    }
//var_dump(userLogin($mysqli));
    
    userLogin($mysqli);

?>
<!doctype html>
<html>
    <body>
        <h3>Twitter - logowanie</h3>
        <form action="" method="POST">
            <input type="email" name="email" value="" placeholder="e-mail">
            <input type="password" name="password" placeholder="password">
            <button type="submit" name="logIn" >LogIn</button>
        </form>
        <h3>Jeśli nie masz jeszcze konta to zarejesrtuj się <a href="newUser.php"> TUTAJ!</a></h3>
    </body>
</html>

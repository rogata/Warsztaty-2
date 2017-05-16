<?php
if(isset($_POST['email']) && isset($_POST['password'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $sql="SELECT * FROM Users";
    $result=$mysqli->query($sql);
    if($result==true && $result->num_rows>0){
        foreach ($result as $row){
            if($row['email']==$email && password_verify($password, $row['hashed_password'])){
                $name = $row['username'];
               return true;
            }else{
                echo 'Błędny login lub hasło!';
            }
        }
    }
}

?>
<!doctype html>
<html>
    <body>
        <h3>Zaloguj się</h3>
        <form action="" method="POST">
            <input type="email" name="email" value="" placeholder="e-mail">
            <input type="password" name="password" placeholder="password">
            <button type="submit" >LogIn</button>
        </form>
        <h3>Jeśli nie masz jeszcze konta to zarejesrtuj się <a href="newUser.php"> TUTAJ!</a></h3>
    </body>
</html>

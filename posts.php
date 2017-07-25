<?php 
    
    include 'comments.php';
    require_once 'src/Tweet.php';

    $userId = $_SESSION['userId'];
//var_dump($userId);
    function userById($mysqli, $userId){
        
        $loadUser = User::loadUserById($mysqli, $userId);
        
        return $loadUser;
    }
    
    echo '<h3>'.  userById($mysqli, $userId)->getUsername().', witaj na stronie głównej!</h3>';
    
    function updateData(){
        
        if(isset($_POST['update'])){
        echo '<form action="" method="POST">           
               <input type="text" name="newUsername" placeholder="username">
               <input type="email" name="newEmail" value="" placeholder="e-mail">
               <input type="password" name="newPassword" placeholder="password">
               <button type="submit" name="newLogIn" >Zmień</button>
             </form>';
        }
        
    }
?>

<html>
    <body>
        <form action="index.php" method="post" style="float:right">
            <button type="submit" name="logOut">Wyloguj</button>
        </form>  
        <a href="message.php" style="float:left">Wyślij wiadomość do użytkownika</a><br>
        <form action="" method="post">
            <button type="submit" name="update">Aktualizuj dane</button>  
        </form><br>
        <?php updateData(); ?>
    <center> 
        <form action="" method="POST">
            <textarea cols="70" name="post" placeholder="Dodaj wpis"></textarea>
            <button type="submit" name="btn">Opublikuj</button>
        </form>
    </body>
<?php
               
  echo '<a href="userPosts.php?userId='.$userId.'" style="float:left">Moje wpisy</a><br>';
  //echo '<a href="message.php" style="float:left">Wyślij wiadomość do użytkownika</a><br>';

    function saveNewText($userId, $mysqli){
        $newText = "";

        if(isset($_POST['post']) && isset($_POST['btn'])){

            $newText =$_POST['post'];

            if($newText != ""){
                $date = 'NOW()';
                $newPost = new Tweet();
                $newPost->setText($newText);
                $newPost->setCreationDate($date);
                $newPost->setUserId($userId);
                $newPost->saveToDB($mysqli);

            }
        }

    }
    
    saveNewText($userId, $mysqli);
        
    
    function loadTweets($mysqli, $userId){
    
        $allPosts=Tweet::loadAllTweets($mysqli);
        
        for($i=0; $i<count($allPosts); $i++){
            echo '<table width="50%" height="10%">';
                $sql = "SELECT username FROM Users WHERE id=".$allPosts[$i]->getUserId();
                $result = $mysqli->query($sql);
                if($result->num_rows>0){
                    foreach ($result as $row) {
                    $userName=$row['username'];
                    }
                }
                //var_dump($result);
                echo '<tr>';
                echo '<th>'.$userName.'</th>';
                echo '<td>'.$allPosts[$i]->getText()."</td>";
                echo '<td style="float:right">'.$allPosts[$i]->getCreationDate()."</td>";
                echo '</tr>';
            echo '</table>';
            comments($i);
            if(isset($_POST['comment'.$i]) && isset($_POST['btn'])){
            addComments($mysqli, $userId, $allPosts[$i]->getId(), $i);
            }
            loadComments($mysqli, $allPosts[$i]->getId());
            echo '<hr width="50%">';
        }
    }
    
    loadTweets($mysqli, $userId);
    
    function updateDataBase($mysqli, $userId){
        if(isset($_POST['newUsername']) && !empty($_POST['newUsername'])){ //|| isset($_POST['newEmail']) || isset($_POST['newPassword'])){
            $newUsername = $_POST['newUsername'];
            var_dump (userById($mysqli, $userId)->setUsername($newUsername));
            userById($mysqli, $userId)->saveToDB($mysqli);
            
        }
           /* $newEmail = $_POST['newEmail'];
            $newPassword = $_POST['newPassword'];
            var_dump($newUsername);
            var_dump(userById($mysqli, $userId)->getId());
            userById($mysqli, $userId)->setPassword($newPassword);
            userById($mysqli, $userId)->setEmail($newEmail);*/
        
    }
    
    updateDataBase($mysqli, $userId);
?>
    </center>
</html>


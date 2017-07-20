<?php 
    include 'comments.php';

    $userId = $_SESSION['userId'];
var_dump($userId);
    function userById($mysqli, $userId){
        
        $loadUser = User::loadUserById($mysqli, $userId);
        
        return $loadUser;
    }
    
    echo '<h3>'.  userById($mysqli, $userId)->getUsername().', witaj na stronie głównej!</h3>';
    
    //include 'comments.php';
?>
<!doctype html>
<html>
    <body>
        <form action="index.php" method="post" style="float:right">
            <button type="submit" name="logOut">Wyloguj</button>
        </form>
    <center>        
        <form action="" method="POST">
            <textarea cols="70" name="post" placeholder="Dodaj wpis"></textarea>
            <button type="submit" name="btn">Opublikuj</button>
        </form>
    </body>
<?php
               
echo ' <a href="userPosts.php?userId='.$userId.'" style="float:left">Moje wpisy</a>';

// var_dump($userId);

    function saveNewText($userId, $mysqli){
        $newText = "";

        if(isset($_POST['post']) && isset($_POST['btn'])){

            $newText =$_POST['post'];

            $sql = "SELECT text FROM Posts WHERE userId=$userId";
            $res = $mysqli->query($sql);
                if($res==true && $res->num_rows > 0 && $newText != ""){

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
           // echo '<td colspan=2>'.$allPosts[$i]->getText()." ".$allPosts[$i]->getCreationDate()."</td>";
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
    
?>
    </center>
</html>


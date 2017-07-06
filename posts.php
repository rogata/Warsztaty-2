<?php 
    echo '<h3>'.$_SESSION['username'].', witaj na stronie głównej!</h3>';
    require_once 'Class/Tweet.php';
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
$userId = $_SESSION['userId'];
               
echo ' <a href="userPosts.php?userId='.$userId.'" style="float:left">Moje wpisy</a>';
            // var_dump($userId);
$newText = "";

        if(isset($_POST['post'])){
            $newText =$_POST['post'];
            //var_dump($newText);
            //var_dump($userId);
            $sql = "SELECT text FROM Posts WHERE userId=$userId";
            $res = $mysqli->query($sql);
            if($res==true && $res->num_rows > 0){
                if($row=$res->fetch_assoc()){
                    if($row['text']!=$newText && $newText != ""){//po zapisaniu wartości $_POST['post'] cały czas dodawał się do bazy ten sam wpis po każdym odświrzeniu strony,dlatego postawiłam taki warunek, ale i tak czasami zapisze się dwa razy)
                        $date = 'NOW()';
                        $newPost = new Tweet();
                        $newPost->setText($newText);
                        $newPost->setCreationDate($date);
                        $newPost->setUserId($userId);
                        $newPost->saveToDB($mysqli);

                    }
                }
            }elseif($res->num_rows == null){ 
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
        
        $allPosts=Tweet::loadAllTweets($mysqli);
        //var_dump($allPosts);
        
        
        for($i=0; $i<count($allPosts); $i++){
        echo '<table width="70%" height="10%">';
            $sql = "SELECT username FROM Users WHERE id=".$allPosts[$i]->getUserId();
            $result = $mysqli->query($sql);
            if($result->num_rows>0){
                foreach ($result as $row) {
                $userName=$row['username'];
                    
                }
            }
            //var_dump($result);
            echo '<tr>';
            echo '<td>'.$userName;
           // echo '<td colspan=2>'.$allPosts[$i]->getText()." ".$allPosts[$i]->getCreationDate()."</td>";
            echo '<td>'.$allPosts[$i]->getText()."</td>";
            echo '<td style="float:right">'.$allPosts[$i]->getCreationDate()."</td>";
            echo '</tr><hr width="70%">';
            echo '<form action="" method="post">
                    <textarea name="post" placeholder="Komentarz"></textarea>
                    <button type="submit" name="btn">Dodaj</button>
                    </form>';
        echo '</table>';
        }
        
?>
    </center>
</html>


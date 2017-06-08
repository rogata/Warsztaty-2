<?php echo '<h3>'.$_SESSION['username'].', witaj na stronie głównej!</h3>'; 
require_once 'Class/Tweet.php';
?>
<!doctype html>
<html>
    <body>
        <form action="" method="POST">
            <textarea cols="70" rows="10" name="post" placeholder="Dodaj wpis"></textarea>
            <button type="submit" name="btn">Opublikuj</button>
        </form>
    </body>
</html>
<?php
$userId = $_SESSION['userId'];
            // var_dump($userId);

        if(isset($_POST['post'])){
            $newText =$_POST['post'];
            var_dump($newText);
            var_dump($userId);
           
            $date = 'NOW()';
            $newPost = new Tweet();
            $newPost->setText($newText);
            $newPost->setCreationDate($date);
            $newPost->setUserId($userId);
            $newPost->saveToDB($mysqli);
            
        }
        
        

        
        $allPosts=Tweet::loadAllTweets($mysqli);
        var_dump($allPosts);
  
?>


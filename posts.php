<?php

 if(isset($_POST['post'])){
            $newText =$_POST['post'];
            //$date = 'NOW()';
            $newPost = new Tweet();
            $newPost->setText($newText);
            $newPost->setCreationDate('NOW()');
            $newPost->setUserId($id);
            $newPost->saveToDB($mysqli);//nie zapisuje się do bazy
            //jak klikam button w formularzu to strona ładuje się od nowa czyli pojawia się logowanie
            return true;
        }else echo 'nie ma wpisu';
        
        
        $allPosts=Tweet::loadAllTweets($mysqli);
        var_dump($allPosts);
       // for($i=0; $i<count($allPosts); $i++){
         //  echo $allPosts[$i];
        //}
        echo '<hr>';
        

?>

<!doctype html>
<html>
    <body>
        <form action="" method="POST">
            <textarea cols="70" rows="10" name="post" placeholder="Dodaj wpis"></textarea>
            <button type="submit">Opublikuj</button>
        </form>
    </body>
</html>




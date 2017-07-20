<?php

    require_once 'config.php';
    require_once 'db_conn.php';
    require_once 'src/User.php';
    require_once 'src/Tweet.php';
    
    if(isset($_GET['userId'])){
        
        $userId = $_GET['userId'];
        $userPosts=Tweet::loadAllTweetsByUserId($mysqli, $userId);
        $username=User::loadUserById($mysqli, $userId);
       // var_dump($username);
        $userName=$username->getUsername();
        //var_dump($userPosts);
      
       echo '<table border="2" cellpadding="10">';
        for($i=0; $i<count($userPosts); $i++){
            echo '<tr>';
            echo '<td>Nazwa użytkownika: '.$userName;//$userPosts[$i]->getUserId();
            echo '<td>Tekst wpisu: '.$userPosts[$i]->getText()."</td>";
            echo '<td>Data wpisu: '.$userPosts[$i]->getCreationDate()."</td>";
            echo '</tr>';
        }
        echo '</table>';
       
    }
        require_once 'foot.php';  

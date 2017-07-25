<?php

    require_once 'src/Comment.php';

    function comments($i){
        echo '<form action="" method="post">
                        <textarea name="comment'.$i.'" placeholder="Komentarz"></textarea>
                        <button type="submit" name="btn">Dodaj</button>
                        </form>';

    }
    
    function addComments($mysqli, $userId, $postId, $i){
        
            $comments = $_POST['comment'.$i];
            $date = 'NOW()';
            
            $saveComment = new Comment();
            $saveComment->setUserId($userId);
            $saveComment->setText($comments);
            $saveComment->setCreationDate($date);
            $saveComment->setPost_id($postId);
            $saveComment->saveToDB($mysqli);
    }
    
    function loadComments($mysqli, $post_id){
        
       // $getTweetId = Tweet::loadAllTweets($mysqli);
        $comments = Comment::loadAllCommentsByPostId($mysqli, $post_id);
        for($i=0; $i<count($comments); $i++){
            echo '<table>';
                $sql = "SELECT username FROM Users WHERE id=".$comments[$i]->getUser_id();
                $result = $mysqli->query($sql);
                if($result->num_rows>0){
                    foreach ($result as $row) {
                    $userName=$row['username'];
                    }
                }
                //var_dump($result);
                echo '<tr>';
                echo '<th>'.$userName.'</th>';
                echo '<td>'.$comments[$i]->getText()."</td>";
                echo '</tr>';
            echo '</table>'; 
        }
    }
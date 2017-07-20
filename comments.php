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
        
        $getTweetId = Tweet::loadAllTweets($mysqli);
        $comments = Comment::loadAllCommentsByPostId($mysqli, $post_id);
        
      //  if($getTweetId->getId()==$post_id){
        echo'<tr>';
        echo'<th>'.$comments->getUser_id().'</th>';
        echo'<td>'.$comments->getText().'</td>';
        echo'</tr>';
       // }
        
    }
<?php
class Comment{
    
    private $id;
    private $user_id;
    private $post_id;
    private $text;
    private $creation_date;
    
    public function __construct(){
        $this->id=-1;
        $this->user_id=0;
        $this->post_id=0;
        $this->text="";
        $this->creation_date=0;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getUser_id(){
        return $this->user_id;
    }
    public function getPost_id(){
        return $this->post_id;
    }
    public function getText(){
        return $this->text;
    }
    public function getCreationDate(){
        return $this->creation_date;
    }
    
    public function setUserId($newUserId){
        $this->user_id=$newUserId;
    }
    public function setPost_id($newPostId){
        $this->post_id=$newPostId;
    }
    public function setText($newText){
        $this->text=$newText;
    }
    public function setCreationDate($newDate){
        $this->creation_date=$newDate;
    }
    
    static public function loadCommentById(mysqli $connection, $id){
        $sql="SELECT * FROM Comment WHERE id=$id";
        $result = $connection->query($sql);
        if($result == true && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->user_id = $row['user_id'];
            $loadedComment->post_id = $row['post_id'];
            $loadedComment->text = $row['text'];
            $loadedComment->creation_date = $row['creation_date'];
            return $loadedComment;
        }
        return null;
    }
    
    static public function loadAllCommentsByPostId(mysqli $connection, $post_id){
        $sql="SELECT * FROM Comment WHERE post_id=$post_id ORDER BY creation_date DESC";
        $ret=[];
        $result = $connection->query($sql);
        if($result == true && $result->num_rows>0){
            foreach ($result as $row){
                 $userComment = new Comment();
                 $userComment->id = $row['id'];
                 $userComment->user_id = $row['user_id'];
                 $userComment->post_id = $row['post_id'];
                 $userComment->text = $row['text'];
                 $userComment->creation_date = $row['creation_date'];
                         
                 $ret[]=$userComment;
            }
        }
        return $ret;
    }
    
    
     public function saveToDB($connection){
        if($this->id==-1){
            $sql="INSERT INTO Comment (user_id, post_id, text, creation_date) VALUE ('$this->user_id', '$this->post_id', '$this->text', $this->creation_date)";
            $result = $connection->query($sql);
            if($result == true){
                $this->id = $connection->insert_id;
                return true;
            }
           return false;
        }
     }
   
    
}
//$sql="CREATE TABLE Comment (id int auto_increment, user_id int not null, post_id int not null, text varchar(60), creation_                date datetime, PRIMARY KEY(id), FOREIGN KEY(user_id) REFERENCES Users(id), FOREIGN KEY(post_id) REFERENCES Posts(id))";
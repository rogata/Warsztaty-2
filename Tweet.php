<?php



class Tweet {
    
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    
    public function __construct(){
        $this->id=-1;
        $this->userId=0;
        $this->text="";
        $this->creationDate=0;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getUserId(){
        return $this->userId;
    }
    public function getText(){
        return $this->text;
    }
    public function getCreationDate(){
        return $this->creationDate;
    }
    
    public function setUserId($newUserId){
        $this->userId=$newUserId;
    }
    public function setText($newText){
        $this->text=$newText;
    }
    public function setCreationDate($newDate){
        $this->creationDate=$newDate;
    }
    
    static public function loadTweetById(mysqli $connection, $id){
        $sql="SELECT * FROM Posts WHERE id=$id";
        $result = $connection->query($sql);
        if($result == true && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];
            return $loadedTweet;
        }
        return null;
    }
    
    static public function loadAllTweetsByUserId(mysqli $connection, $userId){
        $sql="SELECT * FROM Posts WHERE userId=$userId";
        $ret=[];
        $result = $connection->query($sql);
        if($result == true && $result->num_rows>0){
            foreach ($result as $row){
                 $userTweet = new Tweet();
                 $userTweet->id = $row['id'];
                 $userTweet->userId = $row['userId'];
                 $userTweet->text = $row['text'];
                 $userTweet->creationDate = $row['creationDate'];
                         
                 $ret[]=$userTweet;
            }
        }
        return $ret;
    }
    
    static public function loadAllTweets(mysqli $connection){
        $sql="SELECT * FROM Posts ORDER BY creationDate DESC";
        $return =[];
        $result = $connection->query($sql);
        if($result == true && $result->num_rows>0){
            foreach ($result as $row){
                 $allTweet = new Tweet();
                 $allTweet->id = $row['id'];
                 $allTweet->userId = $row['userId'];
                 $allTweet->text = $row['text'];
                 $allTweet->creationDate = $row['creationDate'];
                         
                 $return[]=$allTweet;
            }
        }
        return $return;
    }
    
    static public function saveToDB($connection){
        if($this->id == -1){
            $sql = "INSERT INTO Posts(userId, text, creationDate) VALUE ($this->userId, $this->text, $this->creationDate)";
            $result = $connection->query($sql);
             if($result == true){
                $this->id = $connection->insert_id;
                return true;
                }
        }
        return false;
    }
}

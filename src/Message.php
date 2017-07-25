<?php

class Message {
    
    private $id;
    private $senderId;
    private $senderName;
    private $receiverId;
    private $receiverName;
    private $opened = 0;
    private $message;

    
     private function __construct($newId, $senderId, $senderName, $receiverId, $receiverName, $message){
        $this->id = $newId;
        $this->senderId = $senderId;
        $this->senderName = $senderName;
        $this->receiverId = $receiverId;
        $this->receiverName = $receiverName;
        $this->message = $message;
        //$this->opened = 0;
    }
    
     public function getId(){
        return $this->id;
    }

    public function getSenderId(){
        return $this->senderId;
    }

    public function getSenderName(){
        return $this->senderName;
    }

    public function getReceiverId(){
        return $this->receiverId;
    }

    public function getReceiverName(){
        return $this->receiverName;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessageText($newMessage){
        $this->message = $newMessage;
    }

    public function openMessage(){
        $this->opened = date("Y-m-d H:i:s");
        $this->saveToDB();
    }
    
    public static function CreateMessage($conn, $senderId, $senderName, $receiverId, $receiverName, $message){
        $sqlStatement = "INSERT INTO Messages(sender_id, receiver_id, message) values ($senderId, $receiverId, '$message')";
        if (Message::$conn->query($sqlStatement) === TRUE) {
            return new Message(Message::$conn->insert_id, $senderId, $senderName, $receiverId, $receiverName, $message);
        }
        //error
        return null;
    }
    
    public function loadAllReceivedMessage($conn,$receiverId, $receiverName){
         $returnMessage = array();
        $sqlStatement = "select Messages.id, sender_id, name, receiver_id, opened, message from Messages join Users on Messages.sender_id = Users.id where receiver_id = $receiverId";
        $result = Message::$conn->query($sqlStatement);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $returnMessage[] = new Message($row['id'], $row['receiver_id'], $row['name'], $row['receiver_id'], $receiverName, $row['message'], $row['opened']);
            }
        }
        return $returnMessage;
    }

//$sql="CREATE TABLE Messages (id int auto_increment, sender_id int not null, receiver_id int not null, name varchar(60), message varchar(60),                 , PRIMARY KEY(id), FOREIGN KEY(sender_id) REFERENCES Users(id), FOREIGN KEY(receiver_id) REFERENCES Users(id), FOREIGN KEY(name) REFERENCES Users(username))";

}

<?php

class User {
    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    static public function loadUserById(mysqli $connection, $id){
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = $connection->query($sql);
        if($result == true && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }
    static public function loadAllUsers(mysqli $connection){
        $sql = "SELECT * FROM Users";
        $ret = array();
        $result = $connection->query($sql);
        if($result == true && $result->num_rows != 0){
            foreach($result as $row){
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
    public function __construct(){
        $this->id = -1;
        $this->username="";
        $this->hashedPassword="";
        $this->email="";
    }
    public function saveToDB($connection){
        if($this->id==-1){
            if($this->id == -1){
            $sql = "INSERT INTO Users(username, email, hashed_password)
                VALUES ('$this->username', '$this->email', '$this->hashedPassword')";
            $result = $connection->query($sql);
            if($result == true){
                $this->id = $connection->insert_id;
                return true;
                }
            }
            return false;
        } else {
            $sql = "
                UPDATE Users SET
                    username='$this->username',
                    email='$this->email',
                    hashed_password='$this->hashedPassword'
                WHERE
                    id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                return true;
            }
        }
    }
    public function setUsername($newUsername){
        $this->username=$newUsername;
    }
    public function setEmail($newEmail){
        $this->email=$newEmail;
    }
    public function setPassword($newPassword){
        $this->hashedPassword =
            password_hash($newPassword, PASSWORD_BCRYPT);
    }
    public function getUsername(){
        return $this->username;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getId(){
        return $this->id;
    }
    public function delete(mysqli $connection){
        if($this->id != -1){
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
}

/* Utworzenie obiektów - jednorazowo */
// $jo = new User();
// $jo->setUsername('jo');
// $jo->setEmail('jo@host.com');
// $jo->setPassword('joPass');
// $jo->saveToDB($mysqli);
// $jim = new User();
// $jim->setUsername('jim');
// $jim->setEmail('jim@host.com');
// $jim->setPassword('jimPass');
// $jim->saveToDB($mysqli);

/* Zapamiętanie ID - jednorazowo */
// $joId = $jo->getId();
//$joId = 7;

/* Wczytanie pojedynczego usera */
//$loadedJo = User::loadUserById($mysqli,$joId);
//var_dump($loadedJo);
//echo '<hr/>';

/* Aktualizacja */
//$newEmail = 'new.email'.$loadedJo->getUsername().'@newhost.com';
//$loadedJo->setEmail($newEmail);
//$loadedJo->saveToDB($mysqli);

/* Wczytanie wszystkich userów */
//$allUsers = User::loadAllUsers($mysqli);
//foreach ($allUsers as $user) {
  //  var_dump($user);
    //echo '<hr/>';
//}

?>

<?php

    require_once 'config.php';
    require_once 'db_conn.php';
    require_once 'src/User.php';
    require_once 'src/Tweet.php';
   
function sendMessage($i){
    
    if(isset($_POST[$i])){
        echo '<form method="post" action="">'
            . '<textarea name="message'.$i.'" placeholder="Wiadomość"></textarea>'
            . '<button type="submit" name="send">Wyślij wiadomość</button>'
            .'</form>';
    }
}

function selectUser($mysqli){
    
    $users = User::loadAllUsers($mysqli);
    
    for($i=0; $i<count($users); $i++){
        echo '<form method = "post" action ="">'
               . '<button style="float:left" type="submit" name='.$i.'>'.$users[$i]->getUsername().'</button><br>'
           . '</form>';
        
        sendMessage($i);
    }
}

selectUser($mysqli);

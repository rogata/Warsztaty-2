<?php
    $mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($mysqli->connect_error){
        echo("Connect failed: ". mysqli_connect_error());
        exit();
    };
?>

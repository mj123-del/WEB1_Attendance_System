<?php
    $emailUser = $_POST['email/Username'];
    $passWrd = $_POST['password'];

    //Database Connectivity 
    $conn = new mysqli('localhost','root','','attendee');
    if(conn->connect_error){
        echo "Failed to connect database".$conn->connect_error;
    }else{
        $stmt = $conn->prepare()
    }

?>
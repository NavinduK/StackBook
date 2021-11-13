<?php
    // connection detais of the current device
    $dbhost="localhost:3306";
    $username="root";
    $password="navinduk";
    $dbname="stackbook";

    //Connect to databse
    $con = mysqli_connect($dbhost,$username,$password,$dbname);
    //Check if any errors occurs return error
    if(mysqli_connect_errno()){
        die('Database connection failed'.mysqli_connect_error());
    }
?>
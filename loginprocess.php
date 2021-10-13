<?php
    //include DB connection
    include('connect.php');
    // Proceed with login function only if user submit login form
    if(isset($_POST['submit'])){
		$errors = '';
        // Display an error if user havent fill email password
        if(!isset($_POST['email']) || !isset($_POST['password'])){
            $errors = 'Email or Password Missing!';
        }
        // If no any errors found above proceed with login
        if(empty($errors)){
            //
            //
        }
        mysqli_close($con);
    }
?>
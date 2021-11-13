<?php
    // include database connection 
    include('connect.php');

	$errors = '';
    // add a new post to the DB if user fills the form
    if (isset($_POST['submit'])) {
        //get the details of the form
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);

        // Validate Gmail is not already exists
        $query =  "SELECT * FROM users WHERE email='$email'";
        $valid = mysqli_query($con,$query);
        if (mysqli_num_rows($valid) > 0) {
            //error if already exist gmail
            $errors = 'Gmail Already Exist!';
        }else if (strlen($_POST['password'])<8) {
            //error if password is too short than 8 characters
            $errors = 'Enter Atleast 8 Character Password!';
        }else{
            $sql =  "INSERT INTO users (firstName, lastName, email, password) 
                    VALUES ('$firstName', '$lastName', '$email', '$password')";
            $result = mysqli_query($con, $sql);
            //RETURN TO Login IF QUERY SUCCESS  
            if ($result) {
                header('Location: ./login.php');
            }else{
                $errors='Database Issue!';
            }
        }
    }
?>
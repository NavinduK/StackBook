<?php
    //include DB connection
    include('connect.php');
    // Proceed with login function only if user submit login form
    if(isset($_POST['submit'])){
        // If no any errors found above proceed with login
        if(empty($errors)){
            // Take login variables entered by user with injecting mysql
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $pass = mysqli_real_escape_string($con, $_POST['password']);
            //hashing password before compare with DB password (using SHA1 hash method)
            $hashed_pass = sha1($pass);
            //Prepare Mysql Query to check the user exists
            $query = "SELECT * FROM users 
                        WHERE email = '{$email}' 
                        AND password = '{$hashed_pass}' 
                        LIMIT 1";
            //Run Query and check wether query correctly ran
            $Uresult = mysqli_query($con,$query);
            if($Uresult){
                if (mysqli_num_rows($Uresult) > 0) {
                    // Add logged user's details to the session storage to remember the user is logged
                    $result = mysqli_fetch_row($Uresult);
                    $_SESSION['email'] = $email;
                    $_SESSION['uid'] = $result[0];
                    $_SESSION["fName"] = $result[3];
                    $_SESSION["lName"] = $result[4];
                }
            }
        }
        mysqli_close($con);
    }
?>
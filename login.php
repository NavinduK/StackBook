<?php
    session_start();
    include('./components/loginprocess.php');
    //check whether user already logged, redirect to home if logged
	if(isset($_SESSION['uid'])){
	    	header("location: index.php");
	}
 ?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css">
</head>

<body>
    <div class="container">
        <div class="login">

            <div class="loginpic margin-top">
                <img src="img/login.png" alt="login">
                <div style="width: 300px; text-align:center; margin-top:10px">
                    <p>Not Registered?</p>
                    <a style="margin-top:10px" href="register.php">Register Here</a>
                </div>
            </div>
            <!-- member login form -->
            <form method="POST" name="loginform" class="loginform">
                <h2 class="logintitle margin-top">Member Login</h2>

                <div class="inputbox">
                    <input class="input" type="email" pattern="^[a-zA-Z0-9]+@gmail\.com$" 
                        title="Only Gmails are acceptable" name="email" placeholder="Email">
                </div>

                <div class="inputbox">
                    <input class="input" type="password" name="password" placeholder="Password">
                </div>

                <div class="errormsg">
                    <?php
					//Display the proper error if any error occured
						if (isset($errors) && !empty($errors)) {
							echo $errors;
						}
					?>
                </div>
                
                <div class="btnarea">
                    <button name="submit" class="loginbtn" id="loginBtn">Login<button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
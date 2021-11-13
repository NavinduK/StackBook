<?php
    //check whether user already logged, redirect to home if logged
    include('./components/registerprocess.php');
	session_start();
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
            </div>
            <!-- Member registration form -->
            <form method="POST" name="regform" class="loginform">
                <h2 class="logintitle">Member Register</h2>
                <div class="inputbox">
                    <input class="input" type="text" name="firstName" placeholder="First Name">
                </div>
                <div class="inputbox">
                    <input class="input" type="text" name="lastName" placeholder="Last Name">
                </div>
                <div class="inputbox">
                    <input class="input" type="email" pattern="^[a-zA-Z0-9]+@gmail\.com$" title="Only Gmails are acceptable" name="email" placeholder="Email">
                </div>
                <div class="inputbox">
                    <input class="input" type="password" name="password" placeholder="Password">
                </div>
                <div class="btnarea">
                    <button name="submit" class="loginbtn">Register Now<button>
                </div>

            </form>

        </div>
    </div>
</body>

</html>
<!-- Nav bar section -->
<div class="top-bar clearfix">
    <div class="navbar">
        <!-- Logo and link to home page -->
        <a href="index.php">
            <div class="top-bar-logo">
                <img src="img/logo.png" height="40px" alt="Logo English Grammar">
            </div>

            <div class="top-bar-title">
                <h1>StackBook</h1>
            </div>
        </a>
        <!-- menue bottons to ask question, login, register, logout -->
        <div class="menu">
            <div class="navigate">
                <!-- check wether user logged or not -->
                <?php
                    if(isset($_SESSION['uid'])){
                        $login = 1;
                    }else{
                        $login = 0;
                    }
                ?>
                <?php
                    // show Login and register button for the Users not already logged in
                    if($login == 0){
                        echo("
                            <a href='register.php'>Register</a>
                            <a href='login.php'>Login</a>
                        ");
                    }
                ?>
            </div>

            <?php
                // show Logout button for the Users already logged in
                if($login == 1){
                    echo("
                        <div class='logout'>
                            <a href='./components/logoutprocess.php'>
                                <img src='img/logout.png' height='40px' alt='Logout'>
                            </a>
                        </div>
                    ");
                }
            ?>
        </div>
    </div>
</div>
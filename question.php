<?php
    session_start();
    include('./Components/connect.php');
    // Get the pid and continue
    $pid = $_GET['pid'];
    // Select the question from the table
    if(isset($_GET['pid'])){
        $query = "SELECT * FROM posts WHERE pid = '{$pid}' LIMIT 1";
        //Run Query and check wether question exists
        $qresult = mysqli_query($con,$query);
        if (mysqli_num_rows($qresult) > 0) {
            // set result to a variable
            $result = mysqli_fetch_row($qresult);
        }else{
            // return 404 page if question not found
            header('Location: ./404.html');
        }
    }else{
        // return 404 page if pid not given
        header('Location: ./404.html');
    }

    //Submit comment to database
    if(isset($_POST['asubmit'])){
        // check wether user logged in
        if(!isset($_SESSION['uid'])){
            //redirect to login page with the post id, if user not logged
            header('Location: ./login.php?pid='.$pid);
        }else{
            //Get the comment user entered in form
            $comment = $_POST['answer'];
            //get current date and time posting question
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $dateTime = date("Y/m/d") ." on ". date("h:i a");
            //get the user's ID who post the question
            $user_id = $_SESSION['uid'];
            $user_name = $_SESSION['fName']. " " .$_SESSION['lName'];
            //Prepare the query and run it
            $sql =  "INSERT INTO comment (post_id, user_id, user_name, dateTime, comment)
                        VALUES ($pid, $user_id, '$user_name', '$dateTime', '$comment')";
            $result = mysqli_query($con, $sql);
            //RETURN TO HOME IF QUERY SUCCESS  
            if ($result) {
                header('Location: ./question.php?pid='.$pid);
            }else{
                echo 'DB error';
            }
        }
    }

    // Query to Select all comments to display on list and run it
    $sqlQ = "SELECT * FROM comment WHERE post_id=$pid ORDER BY cid DESC";
    $cresult = mysqli_query($con, $sqlQ);
    //Put all selected comments into an array
    if (mysqli_num_rows($cresult) > 0) {
        $comments = array();
        while ($row = mysqli_fetch_assoc($cresult)) {
            array_push($comments, $row);
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>StackBook</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://use.fontawesome.com/f07809b0f0.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Import Navigation Bar Component -->
        <?php include('./components/navigation.php')?>

        <div class="mainbody">
            <p style="margin: 100px auto 0 auto; font-size:20px; width:900px">
                Question by <?php echo $result[5]; ?>
            </p>

            <div>
                <!-- display question owner name and date -->
                <div class="question-u">
                    <p class="user-name-u"><?php echo $result[5]; ?></p>
                    <p class="post-date-u"><?php echo $result[3]; ?></p>
                </div>
                <!-- display question title and body -->
                <div class="question-q">
                    <h4 class="q-title-q"><?php echo $result[1]; ?></h4>
                    <hr style="border:none ;height: 0.7px; background:#017DC3">
                    <p class="q-description"><?php echo $result[2]; ?></p>
                </div>

                <div class="answer-q">
                    <!-- commenting form -->
                    <form action="question.php?pid=<?php echo $pid; ?>" method="POST">
                        <div class="title">
                            <p>Leave Your Answer</p>
                            <textarea maxlength="150" rows="3" name="answer" placeholder="Enter your answer here..."
                                required></textarea>
                        </div>
                        <input type="submit" name="asubmit" value="Post Your Answer" class="answer-b">
                    </form>
                </div>
            </div>
            <p style="margin: 40px auto 20px auto; font-size:20px; width:900px">Answers by Experts</p>

            <div>
                <!-- Loop the comment box for the comments fetched above by database -->
                <?php 
                    if (isset($comments)) { foreach ($comments as $row) {
                ?>
                <div class="comments">
                    <?php 
                    // if the logged user is the owner of current comment, display delete button
                        if($row['user_id'] == $_SESSION['uid']){
                            echo "<a href='./components/delete.php?pid=".$row['post_id']."&cid=".$row['cid']."'>
                                    <span class='delete' onclick='askClose()'><i class='fa fa-trash'></i></span>
                                </a>";
                        }
                    ?>
                    <!-- display comment, date and owner -->
                    <div style="display: flex;">
                        <p class="user-name-a"><?php echo $row["user_name"]; ?></p>
                        <p class="post-date-a">at <?php echo $row["dateTime"]; ?></p>
                    </div>
                    <hr style="border:none ;height: 0.7px; background:#017DC3">
                    <p class="q-description"><?php echo $row["comment"]; ?></p>
                </div>
                <!-- if no comments found for this post show "No Answers Recorded" -->
                <?php }}else{
                    echo "<p class='no-answers'>No Answers Recorded<p>";
                } ?>
            </div>

            <!-- Model box for asking a question -->
            <?php include('components/askModel.php')?>
        </div>

        <!-- Import Footer Component -->
        <?php include('components/footer.php')?>
    </div>

    <script type="text/javascript" src="js/askQuestion.js"></script>
</body>

</html>
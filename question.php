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
                Question
            </p>

            <div>
                <!-- display question owner name and date -->
                <div class="question-u">
                    user name / date
                </div>
                <!-- display question title and body -->
                <div class="question-q">
                    <h4 class="q-title-q">Question</h4>
                </div>

                <div class="answer-q">
                    <!-- commenting form -->
                </div>
            </div>
            <p style="margin: 40px auto 20px auto; font-size:20px; width:900px">Answers by Experts</p>

      
        </div>

        <!-- Import Footer Component -->
        <?php include('components/footer.php')?>
    </div>

</body>

</html>
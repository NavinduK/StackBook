<?php
session_start();
//include DB connection
    include("./components/connect.php");
    // Query to Select all questions to display on list and run it
    $sqlQ = "SELECT * FROM posts ORDER BY pid DESC";
    $qresult = mysqli_query($con, $sqlQ);
    //Put all selected questions into an array
    $questions = array();
    if (mysqli_num_rows($qresult) > 0) {
        while ($row = mysqli_fetch_assoc($qresult)) {
            array_push($questions, $row);
        }
    }
?>

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
            <div class="text-center heading marginA">
                <p style="font-size: 23px;"> Hello There</p>
                <h4> Welcome to StackBook </h4>
                <p> Ask a question and you will be sure to find an answer! </p>
                <button class="ask-btn" onclick="">Ask Question</button>
            </div>

            <p style="margin: 40px auto 0 auto; font-size:25px; width:900px">Recent Questions</p>

            <div>
                <!-- Loop the question box for the posts fetched by database -->
                <?php foreach ($questions as $row) { ?>
                <div class="question">
                    <!-- display post details -->
                    <a href="question.php?pid=<?php echo $row["pid"]; ?>">
                        <p class="user-name"><?php echo $row["postUName"]; ?></p>
                        <p class="post-date"><?php echo $row["dateTime"]; ?></p>
                        <hr style="border:none ;height: 0.8px; background:#017DC3">
                        <h4 class="q-title"><?php echo $row["title"]; ?></h4>
                        <p class="q-description"><?php echo $row["description"]; ?></p>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Import Footer Component -->
        <?php include('components/footer.php')?>
    </div>
</body>

</html>
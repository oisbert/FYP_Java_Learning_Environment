<html>
       <!-- 
         Function to add a post to the forum page
      -->
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/addTask.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <title>Add addQuickFeedback</title>
</head>

<body>

    <?php 
            include ("validateLoggedIn.php");
            include("headerTeacher.html");
        ?>

           <!-- 
            Add text box to enter the post content 
            action carried out is addpost.php
            -->
    <div class="description-container">
        <div class="bio-description">
        <form method="post" action="addQuickFeedback.php">
                <h3 id='desc'>Add Quick Feedback:</h3>
                <textarea id='description' name='description' class='description-textarea' rows=20 cols=70
                    required></textarea><br>
                <br>
                <br>
                <input class="button" type="submit" name="submit" value="Add quickfeedback" />
            </form>
        </div>
    </div>
</body>

</html>

<?php 
    //the addpost php function adds the post to the database when the post is submitted
    
    function addQuickFeedback() {
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }
        $sql = "INSERT INTO quickfeedback ( quickfeedbackAdded )
                VALUES ('{$_POST['description']}')";

        if ($conn->query($sql) === TRUE) {
            header("Location: addQuickFeedback.php");
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
         }

        $conn->close();
        }

    if(isset($_POST["submit"])) addQuickFeedback();
?>
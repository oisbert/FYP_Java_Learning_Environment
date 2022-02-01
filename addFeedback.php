<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/addTask.css?v=<?php echo time(); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <title>Add Post</title>
    </head>


    <body>
        
        <?php 
            include ("validateLoggedIn.php");
            include ("headerTeacher.html")
        ?>
        <hr>
        <div class = "description-container">
            <div class = "bio-description">
            <?php
            $taskID = $_GET['taskID'];
            $userID = $_GET['userID'];

            $data1 = array('taskID' => $taskID);

            $data2 = array('userID' => $userID);
            ?>
                <form method="post" name="confirmationForm" action="addFeedbackfunction.php?<?php echo http_build_query($data1) ?>&<?php echo http_build_query($data2)?>" >
                    <h3 id = 'desc'>Post Description:</h3>
                    <textarea id='description' name='query' class='description-textarea' rows= 20 cols=70 required></textarea>
                    <br>
                    <input type="submit" name="submit">
                </form>
            </div>
        </div>
    </body>
</html>
  


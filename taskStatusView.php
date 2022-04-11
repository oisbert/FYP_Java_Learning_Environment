<html>
    <head>
        <!--This loads the task status table located on the teachers task page-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/taskStatusView.css?v=<?php echo time(); ?>">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <title>Task View</title>

    </head>
    
    <script type="text/javascript">
        //function to add feedback to user selected
        function addFeedback(taskID, userID, filename) {
            window.location.href= 'addFeedback.php?taskID=' + taskID + '&userID=' + userID;
        }
        //function to add autograded feedback when selected 
        function autoGrade(userID, taskID) {
            window.location.href= 'autoGrader.php?userID=' + userID + '&taskID=' + taskID;
        }
    </script>
    <body>
        <?php include ("headerTeacher.html"); ?>
        <div class="page-box">
            <?php
                include ("validateLoggedIn.php");
                include ("serverConfig.php");

                $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
                if ($conn -> connect_error) {
                    die("Connection failed:" .$conn -> connect_error);
                }

                //collect the following information from the tables taskstatus and tasks.
                $sql = "SELECT a.status, b.taskTitle, c.username, a.filePathUser, a.taskID, a.userID
                        FROM taskstatus a 
                        INNER JOIN tasks b
                        ON a.taskID = b.taskID
                        INNER JOIN users c
                        ON a.userID = c.userID
                        ORDER BY taskID";
                $result = $conn -> query($sql);
                    //make a table
                    print "<table class='StatusTable' border='1'>";
                    print "<thead>
                                <tr>
                                    <th>Assignment name</th>
                                    <th>Student Name</th>
                                    <th>Status</th>
                                    <th>Submission</th>
                                    <th>Feedback</th>
                                    <th>AutoGrade</th>
                                </tr>
                            </thead>";
                            
                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc())
                        {   
                            //for each result load a new row in the table and add the information
                            print "<TR>";
                            print "<TD>{$row['taskTitle']}</TD>";
                            print "<TD>{$row['username']}</TD>";
                            print "<TD>{$row['status']}</TD>";
                            print "<TD><a href='taskUploads/{$row['taskTitle']}/{$row['filePathUser']}' download>{$row['filePathUser']}</a></TD>";
                            print "<TD><button type='button' class='btn btn-success' onClick='addFeedback({$row['taskID']}, {$row['userID']})'>Add Feedback</button></TD>";
                            print "<TD><a href='./autoGrader.php?taskID={$row['taskID']} &taskTitle={$row['taskTitle']} &userID={$row['userID']} &filePathUser={$row['filePathUser']}'> AutoGrade</a></TD>";
                            print "</TR>";
                        }
                    } else {
                        //if there is nothing on the tables print...
                        print "<TR>";
                        print "<TD colspan='3'>No Task information avalible</TD>";
                        print "</TR>";
                    }
                    $conn->close();
                    print "</table>";

            ?>
        </div>
    </body>
</html>
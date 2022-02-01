<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/taskPageTeacher?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
    <title>Tasks </title>
</head>

<script type="text/javascript">
    function taskCompleted(taskID) {
            window.location.href= 'taskStatusComplete.php?taskID=' + taskID;
        }

    function requestForHelp(taskID) {
            window.location.href= 'needHelp.php?taskID=' + taskID;
        }

    function disableButton(btn) {
            document.getElementById("btn1").disabled = true;
            alert("Button has been disabled.");
        }
    
    function cancel(taskID, taskTitle) {
            if (confirm("Are you sure you want remove your task status") == true){
            window.location.href= 'removeSubmission.php?taskID=' + taskID + '&taskTitle=' + taskTitle;
        }
    }

    function cancel(taskID, taskTitle) {
            if (confirm("Are you sure you want remove your task status") == true){
            window.location.href= 'UserFeedback.php?taskID=' + taskID + '&taskTitle=' + taskTitle;
        }
    }

    function viewFeedback(taskID){
        window.location.href= 'userFeedback.php?taskID=' + taskID;
    }

    function addUpload(taskID) {
        if (confirm("Are you sure you want upload your task status") == true){
        window.location.href= 'addUpload.php?taskID=' + taskID;
        }
    }

</script>


<body>
    <?php 
        include ("validateLoggedIn.php");
        include ("header.html");
    ?>

    <div class = "page-main">
        <?php
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $sql = "SELECT a.taskTitle, a.taskDescription, a.taskID, a.teacherID, a.filePath, b.feedback
            FROM tasks a
            INNER JOIN taskstatus b ON a.taskID = b.taskID";

            $result = $conn -> query($sql);
            

            if(mysqli_num_rows($result) != 0) {
                while($row = $result->fetch_assoc())
                {   
                    print "<div class='Tasks'>
                                    <p class='DetailsTitle text-left'>{$row['taskTitle']}</p>
                                    <p class='DetailsDesc text-left'><b>Description: </b>{$row['taskDescription']}</p>";

                    if($row['filePath'] != NULL){
                       print "<div class = 'Attachment-link'><a href='uploads/{$row['filePath']}' download>
                        Download file attachment
                        </a></div>";
                    }
                    else {
                        print "<p>No Attachment</p>";
                    }

                    $ButtonSQL = "select taskID, userID, feedback from taskstatus where userID = {$_SESSION['user']} AND taskID = {$row['taskID']};";
                    $ButtonSQLResult = $conn -> query($ButtonSQL);
                    $ButtonSQL = $ButtonSQLResult->fetch_assoc();
                    $row2 = mysqli_fetch_row($ButtonSQLResult);
                    print "<div class ='button-wrapper'>";
                    if($ButtonSQL) {
                        print "<button type ='button' id = 'completebtn' class='btn btn-success' disabled '>Complete</button> ";
                    } else {
                       
                        print "<form method='post' action='addUpload.php?taskID= {$row['taskID']} &taskTitle={$row['taskTitle']} &status=Complete' enctype='multipart/form-data'>";
                        print "<input type ='file' name='file'>";
                        print "<button type ='submit' id = 'completebtn' class='btn btn-success' onClick='addUpload({$row['taskID']})'>Complete</button>";
                        print "</form>";
                    }

                    //if($ButtonSQL) {
                    //   print "<button type ='button' id = 'needHelpbtn' class='btn btn-warning' disabled '>Need Help</button> ";
                    //} else {
                    //    print "<button type ='button' id = 'needHelpbtn' class='btn btn-warning' onClick='requestForHelp({$row['taskID']})'>Need Help</button>";
                    //}

                    if($ButtonSQL) {
                        print "<form method='post' action='removeSubmission.php?taskID= {$row['taskID']} &taskTitle={$row['taskTitle']}' enctype='multipart/form-data'>";
                        print "<button type ='submit' id = 'cancelbtn' class='btn btn-danger' onClick='cancel({$row['taskID']}, {$row['taskTitle']})'>Cancel</button>";
                        print "</form>";
                    } else {
                        print "<button type ='button' id = 'cancelbtn' class='btn btn-danger' disabled '>Cancel</button> ";
                    }

                    if($ButtonSQL && $row2['feedback'] != NULL) {
                        print "<button type ='button' id = 'feedbackbtn' class='btn btn-warning' onClick='viewFeedback({$row['taskID']})'>Feedback</button>";
                    } else {
                        print "<button type ='button' id = 'feedbackbtn' class='btn btn-warning' disabled '>No feedback avalible</button> ";
                    }
               
                    print "</div></div><BR>";
                                    
            }
        }
        ?>

    </div>
    <script src="js/animateTasks.js" type="text/javascript"></script>
</body>
</script>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/taskPageTeacher?v=<?php echo time(); ?>">
    <title>Tasks Teacher</title>
</head>

<script>
    function deletetask(variable) {
            if (confirm("Are you sure you want to delete this Task?") == true) {
            window.location.href= 'deleteTask.php?id=' + variable;
            };
        }

    function deleteAlltasks(variable) {
            if (confirm("Are you sure you want to delete all tasks and Assignments Uploads?") == true) {
            window.location.href= 'deleteAllTask.php?id=' + variable;
            };
        }

</script>


<body>
    <?php 
        include ("validateLoggedIn.php");
        include ("headerTeacher.html");
    ?>

    <div class = "page-main">
        <?php
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $sql = "select taskTitle, taskDescription, taskID, teacherID, filePath
                        from tasks ";
            
            
            $result = $conn -> query($sql);

            if(mysqli_num_rows($result) != 0) {
                while($row = $result->fetch_assoc())
                {   
                    print "<div class='Tasks'>
                                    <p class='Details text-left'><b>Title: </b>{$row['taskTitle']}</p>
                                    <p class='Details text-left'><b>Description: </b>{$row['taskDescription']}</p>
                                    <button type='button' class='btn btn-danger' style='margin-bottom:1%; float:right;' onClick='deletetask({$row['taskID']})'>Delete</button>";             
                                    print "</div><BR>";

                    if($row['filePath'] != NULL){
                         print "<div class = 'Attachment-link'><a href='uploads/{$row['filePath']}' download>
                                Download file attachment
                                </a></div>";
                    }
                    else {
                        print "<p>No Attachment</p>";
                        }
            }
        }
        ?>
        <div class = "button-wrapper">
        <div class="AddNewTask" onClick="location.href='addTask.php'"><h1>Add task<h1></div>
        <div class="TaskStatus" onClick="location.href='TaskStatusView.php'"><h1>View Status<h1></div>
        <div class="Delete-All" onClick="location.href='deleteAlltask.php'"><h1>Delete all tasks and Assignments<h1></div>
        </div>
    </div>
</body>
</html>
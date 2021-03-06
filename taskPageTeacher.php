<!DOCTYPE html>
<html lang="en">
<head>
    <!--Main task page for the teacher -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/taskPageTeacher.css?v=<?php echo time(); ?>">
    <title>Tasks Teacher</title>
</head>

<script>
    //function to remove a task
    function deletetask(variable) {
            if (confirm("Are you sure you want to delete this Task?") == true) {
            window.location.href= 'deleteTask.php?id=' + variable;
            };
        }
    
    //remove all tasks and their associated files 
    function deleteAlltasks(variable) {
            if (confirm("Are you sure you want to delete all tasks and Assignments Uploads?") == true) {
            window.location.href= 'deleteAllTask.php?id=' + variable;
            };
        }
    
    //function to remove autograder answer file 
    function deleteUpload(variable) {
            if (confirm("Are you sure you want Remove this answer file") == true) {
            window.location.href= 'deleteAnswerFile.php?id=' + variable;
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
            //get information from tasks table
            $sql = "SELECT taskTitle, taskDescription, taskID, teacherID, filePath, taskfilename
                        FROM tasks ";
            
            
            $result = $conn -> query($sql);

            if(mysqli_num_rows($result) != 0) {
                while($row = $result->fetch_assoc())
                {   
                    //for each row load a the following information into html segments
                    $taskfile = $row['taskfilename'];
                    print "<div class='Tasks'>
                                    <p class='Details text-left'><b>Title: </b>{$row['taskTitle']}</p>
                                    <p class='Details text-left'><b>Description: </b>{$row['taskDescription']}</p>";
                                   //if the teacher has uploaded an autoghrader answer file do the following
                                    if (file_exists("tasksAnswers/Answer{$taskfile}.java")) {
                                        print "<button type='button' id = 'DeleteButton' class='btn btn-danger' style='margin-bottom:1%; float:right;' onClick='deleteUpload({$row['taskID']})'>Delete Answer Upload</button>";
                                    }
                                    //if not then print option to upload
                                    else{
                                        print "<form method='post' action='taskPageTeacher.php' enctype='multipart/form-data'><br><br>
                                        <input type='hidden' value='{$row['taskfilename']}' name='taskfilename'>
                                        <p class='Details text-left'><b>Upload answer to the task here to Auto-Grade (Please name file Answer{$row['taskfilename']}.java)</p>
                                        <input type ='file' name='file'>
                                        <br>
                                        <br>
                                        <input class='button' type='submit' name='submit' value='Submit Answer' style='float:left''><br><br><br>";
                                    }
                                   
                                    print "<button type='button' id = 'DeleteButton' class='btn btn-danger' style='margin-bottom:1%; float:right;' onClick='deletetask({$row['taskID']})'>Delete Task</button>
                                    </form>";           
                                    
                    //if there is a file attached print the following
                    if($row['filePath'] != NULL){
                         print "<div class = 'Attachment-link'><a href='uploads/{$row['filePath']}' download>
                                Download file attachment
                                </a></div>";
                    }
                    //not print ...
                    else {
                        print "<p>No Attachment</p>";
                        }
                    print "</div><BR>";
            }
        }
        ?>
         <!--buttons to get to the the next add task...the status and option to delete all -->
        <div class = "button-wrapper">
        <div class="AddNewTask" onClick="location.href='addTask.php'"><h1>Add task<h1></div>
        <div class="TaskStatus" onClick="location.href='TaskStatusView.php'"><h1>View Status<h1></div>
        <div class="Delete-All" onClick="location.href='deleteAlltask.php'"><h1>Delete all tasks and Assignments<h1></div>
        </div>
    </div>
</body>
</html>

<?php 

    function addAnswer() {
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }
        //$teacherID = $_SESSION['teacher'];
        $taskfilename = $_POST['taskfilename'];
        $targetDir = "tasksAnswers/";
        $temp = explode(".", $_FILES["file"]["name"]);
        $fileName = 'Answer'.$taskfilename.'.'.end($temp);
        $fileName = str_replace(' ', '', $fileName);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $allowTypes = array('java');
        move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath);
        
        //creater directory for student uploads
        
        $directoryName = "tasksAnswers/";
        if(!is_dir($directoryName)){
            //Directory does not exist, so lets create it.
            mkdir($directoryName, 0755);
        }

        if(in_array($fileType, $allowTypes)){
            echo "File uploaded";
        }
        else{
            echo "Sorry, only java files are allowed";
            unlink("tasksAnswers/{$fileName}");
        }
    }

    if(isset($_POST["submit"])) addAnswer();
?>
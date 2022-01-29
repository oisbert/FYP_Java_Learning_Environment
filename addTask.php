<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/addTask.css?v=<?php echo time(); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <title>Add Task</title>
    </head>
    <body>
        
        <?php 
            include ("validateLoggedIn.php");
            include ("headerTeacher.html");
        ?>
        <div class = "description-container">
            <div class = "bio-description">
                <form method="post" action="addTask.php" enctype="multipart/form-data">
                    <h3>Task title:</h3>
                    <input class="text-input" type='text' placeholder='Enter Task Title' name='taskTitle' enctype="multipart/form-data" required></input>
                    <h3 id = 'desc'>Task Description:</h3>
                    <textarea id='description' name='taskDescription' class='description-textarea' rows= 20 cols=70 required></textarea><br>
                    <input type ="file" name="file">
                    <br>
                    <br>
                    <input class="button" type="submit" name="submit" value="Submit Task"/>
                </form>
            </div>
        </div>
    </body>
</html>

<?php 

    function addTask() {
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }
        $teacherID = $_SESSION['teacher'];
        // File upload path
        $targetDir = "uploads/";
        $fileName = NULL;
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif','pdf','java');
        move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath);
        
        //creater directory for student uploads
        
        $directoryName = "taskUploads/'{$_POST['taskTitle']}'";
        if(!is_dir($directoryName)){
            //Directory does not exist, so lets create it.
            mkdir($directoryName, 0755);
        }

        if(in_array($fileType, $allowTypes) OR $fileName == NULL){
        $sql = "INSERT INTO tasks ( taskTitle, taskDescription, teacherID, filePath)
                VALUES ('{$_POST['taskTitle']}', '{$_POST['taskDescription']}','{$teacherID}', '{$fileName}')";

        if ($conn->query($sql) === TRUE) {
            echo "The file ".$fileName. " has been uploaded successfully.";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
         }

        $conn->close();
        }
        else{
            echo "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.";
        }
    }

    if(isset($_POST["submit"])) addTask();
?>
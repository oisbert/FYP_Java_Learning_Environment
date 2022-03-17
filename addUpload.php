<?php   
        //function to add and upload to a task by a student

        include ("validateLoggedIn.php");
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }

        //get the id of the current user signed in
        $currentUser = $_SESSION['user'];
        //get the taskID of the current task
        $taskID = $_GET['taskID'];
        //get the task title of the current task
        $taskTitle= $_GET['taskTitle'];
        //get the file name of the current task
        $taskfilename= $_GET['taskfilename'];
        //get the status of the current task
        $status= $_GET['status'];

        //remove spaces if there is any from the task title
        $taskTitleNoSpaces = str_replace(' ', '', $taskTitle);

        //create a directory for the uploads
        $targetDir = "taskUploads/{$taskTitleNoSpaces}/{$currentUser}";

        // Checking whether the directory exists or not
        if (is_dir($targetDir)){
            echo ("Given directory exists");
        }else{
            mkdir("taskUploads/{$taskTitleNoSpaces}/{$currentUser}", 0700);
        }

        //specify the file path for the file being uploaded
        $userDirectory = "taskUploads/{$taskTitleNoSpaces}/{$currentUser}/";
        $temp = explode(".", $_FILES["file"]["name"]);

        //rename the file uploaded to the name set by the teacher
        $fileName = $taskfilename.'.'.end($temp);
        //remove any spaces
        $fileName = str_replace(' ', '', $fileName);
        //get the target directory
        $targetFilePath = $userDirectory.$fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        //only allowed type is java
        $allowTypes = array('java');
        //move file to specidifed directory
        move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath);

      
        if(in_array($fileType, $allowTypes) OR $fileName == NULL){
        $sql = "INSERT INTO taskstatus ( userID, taskID, status, filePathUser)
                VALUES ('{$currentUser}', '{$taskID}', '{$status}', '{$fileName}')";

        if ($conn->query($sql) === TRUE) {
            echo "The file ".$fileName. " has been uploaded successfully.".$status;
            header("Location: taskpage.php");
        } 
        else {
            echo "Please upload a file to complete the task";
         }

        $conn->close();
        }
        else{
            echo "Please upload a file to complete the task";
            header("Location: taskpage.php");
        }

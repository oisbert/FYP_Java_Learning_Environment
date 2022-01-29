<?php   
        include ("validateLoggedIn.php");
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }
        $currentUser = $_SESSION['user'];
        $taskID = $_GET['taskID'];
        $taskTitle= $_GET['taskTitle'];
        //$fileName = $_GET['fileName'];
        
        $directoryName = "taskUploads/{$taskTitle}";
        if(!is_dir($directoryName)){
            //Directory does not exist, so lets create it.
            mkdir($directoryName, 0755);
        }

        $targetDir = "taskUploads/{$taskTitle}/";
        $fileName = NULL;
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif','pdf','java');

        move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath);

      
        if(in_array($fileType, $allowTypes) OR $fileName == NULL){
        $sql = "INSERT INTO taskstatus ( userID, taskID, status, filePathUser)
                VALUES ('{$currentUser}', '{$taskID}', 'Help Needed', '{$fileName}')";

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
?>
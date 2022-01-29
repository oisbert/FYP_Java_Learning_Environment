<html>
    <body>
        <?php

   

// delete all files and sub-folders from a folder
function deleteAll($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            deleteAll($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

  

?>

        <?php

            include ("validateLoggedIn.php");
            include ("serverConfig.php");

            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $taskToDelete = $_GET['id'];
            $taskTitle = $_GET['taskTitle'];
            $currentUser = $_SESSION['user'];
            $removeFiles = "select taskTitle
            from tasks ";
            $result = $conn -> query($removeFiles);

            if (mysqli_num_rows($result) != 0) {
                while($row = $result->fetch_assoc())
                {   
                $directoryName = "taskUploads/{$taskTitle}";
                deleteAll($directoryName);

            } 
            }
            $connectionsSQL = "DELETE FROM tasks WHERE taskID={$taskToDelete};";

            if ($conn->query($connectionsSQL) === TRUE) {
                echo "Sucessful";
                header( "Location: deleteTask.php" );

            } 
            else {
                echo "Error: " . $connectionsSQL . "<br>" . $conn->error;
            }

            header( "Location: deleteTask.php" );
            $conn->close();
        ?>



    </body>
</html>
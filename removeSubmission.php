
        <?php
            //function to remvoe a students submission from the site
            include ("validateLoggedIn.php");
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $taskID = $_GET['taskID'];
            $taskTitle = $_GET['taskTitle'];
            $currentUser = $_SESSION['user'];
            $removeFiles = "SELECT filePathUser FROM taskstatus WHERE taskID = {$taskID} AND userID = {$currentUser}";
            $result = $conn -> query($removeFiles);

            //look for the directory of the task if its found delete it
            if (mysqli_num_rows($result) != 0) {
                while($row = $result->fetch_assoc())
                {   
                $directoryName = "taskUploads/{$taskTitle}/{$currentUser}/{$row['filePathUser']}";

                if(file_exists($directoryName)){
                unlink($directoryName);
                }
                else{
                    echo "no file to remove";
                    echo $directoryName;
                }

            } 
            }

            $sql = "DELETE FROM taskstatus WHERE taskID = $taskID AND userID = $currentUser";
            
            if ($conn->query($sql) === TRUE) {
                //header( "Location: cancelRequest.php" );

            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            header( "Location: taskPage.php" );
            $conn->close();
        ?>

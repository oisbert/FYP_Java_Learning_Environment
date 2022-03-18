
        <?php

            include ("validateLoggedIn.php");
            
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $taskID = $_GET['taskID'];
            $currentUser = $_SESSION['user'];

            $sql = "INSERT INTO taskstatus (userID, taskID, status)
            VALUES ('{$currentUser}', '{$taskID}', 'Completed')";

            if ($conn->query($sql) === TRUE) {
                header( "Location: taskPage.php" );

            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            header( "Location: taskPage.php" );
            $conn->close();
        ?>

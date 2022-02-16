<html>
    <body>
        <?php
            // function to delete all files and subfolders from folder
            function deleteAll($dir, $remove = false) {
             $structure = glob(rtrim($dir, "/").'/*');
             if (is_array($structure)) {
             foreach($structure as $file) {
             if (is_dir($file))
             deleteAll($file,true);
             else if(is_file($file))
             unlink($file);
             }
             }
             if($remove)
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

            //$taskToDelete = $_GET['id'];

             // folder path that contains files and subfolders
             $path = "./taskUploads";
             $path2 = "./uploads";
             // call the function
            deleteAll($path);
            deleteAll($path2);
            $connectionsSQL = "DELETE FROM tasks;";

            if ($conn->query($connectionsSQL) === TRUE) {
                echo "Sucessful";

            } 
            else {
                echo "Error: " . $connectionsSQL . "<br>" . $conn->error;
            }

            $connections2SQL = "DELETE FROM taskstatus;";

            if ($conn->query($connections2SQL) === TRUE) {
                echo "Sucessful";

            } 
            else {
                echo "Error: " . $connections2SQL . "<br>" . $conn->error;
            }

            header( "Location: taskPageTeacher.php" );
            $conn->close();
        ?>
    </body>
</html>
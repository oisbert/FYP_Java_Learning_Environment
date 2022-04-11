
        <?php
            //function to change a teachers access to the site this function is called in admin.php to allow teachers access to the site 
            include ("serverConfig.php");
            
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            
            $teacherID = $_GET['id'];

            //update the table teacher and set access to one. where the teacherID is the from the getter
            $sql = "UPDATE teacher SET access = 1 WHERE teacherID = {$teacherID}";

            if ($conn->query($sql) === TRUE) {
                header( "Location: admin.php" );

            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
               header( "Location: admin.php" );
            $conn->close();
        ?>

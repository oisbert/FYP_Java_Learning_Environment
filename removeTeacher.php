<html>
    <body>
        <?php
            //function to remove teacher utilized in adminRemoveteacher.php
            include ("validateLoggedIn.php");
            include ("serverConfig.php");

            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $teacherToDelete = $_GET['id'];

            $connectionsSQL = "DELETE FROM teacher WHERE teacherID={$teacherToDelete};";

            if ($conn->query($connectionsSQL) === TRUE) {
                echo "Sucessful";
                header( "Location: adminRemoveTeacher.php" );

            } 
            else {
                echo "Error: " . $connectionsSQL . "<br>" . $conn->error;
            }

            header( "Location: adminRemoveTeacher.php" );
            $conn->close();
        ?>
    </body>
</html>
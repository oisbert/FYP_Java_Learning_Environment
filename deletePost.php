
<?php
        //function to delete a post from the forum

            include ("validateLoggedIn.php");
            
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }
            //get the current postID
            $PostID = $_GET['PostID'];
            //then remove it form the database
            $sql = "DELETE FROM posts WHERE PostID = $PostID";

            if ($conn->query($sql) === TRUE) {
                header( "Location: forumteacher.php" );

            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            header( "Location: forumteacher.php" );
            $conn->close();
        ?>
    </body>
</html>
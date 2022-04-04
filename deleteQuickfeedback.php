<?php
        //function to delete a post from the forum

            include ("validateLoggedIn.php");
            
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }
            //get the current postID
            $feedID = $_GET['quickfeedbackID'];
            //then remove it form the database
            $sql = "DELETE FROM quickfeedback WHERE quickfeedbackID = $feedID";

            if ($conn->query($sql) === TRUE) {
                header( "Location: addFeedback.php" );

            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            header( "Location: addFeedback.php" );
            $conn->close();
        ?>

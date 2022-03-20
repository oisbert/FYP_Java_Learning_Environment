<?php
        /*
            Function to add points to the user account when a
            user selects collect points after completing an exercise
        */

        include("validateLoggedIn.php");
        include("serverConfig.php");
        $userID = $_GET['userID'];

        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

        if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
        }

        /*
            update the points coloumn add 1 to the points
        */

        $sql = "UPDATE users SET points = points + 1 WHERE userID = $userID";

        if ($conn->query($sql) === TRUE) {
            header("Location: exercisePage.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sqlPoints = "UPDATE users SET pointtracker = 0";

        if ($conn->query($sqlPoints) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sqlPoints . "<br>" . $conn->error;
        }

        header("Location: exercisePage.php");
        $conn->close();
?>
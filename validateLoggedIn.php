<?php
    //validates the type of user logged in
    session_start();

    if (!(isset($_SESSION["loggedin"])) || $_SESSION["loggedin"] == false) {
        header( "Location: login.php" );
    } 

    include ("serverConfig.php");

    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if ($conn -> connect_error) {
        die("Connection failed:" .$conn -> connect_error);
    }
    //if user set session variable to user
    if(isset($_SESSION['user'])) {
        $userID = $_SESSION['user'];
    }
    //if a teacher set session variable to teacher.... if the access is set to 0 deny access
    else if(isset($_SESSION['teacher'])) {
        $teacherID = $_SESSION['teacher'];
        $Access = "SELECT access FROM teacher
                      WHERE access = 0 AND teacherID = $teacherID;";
        $AccessResult = $conn -> query($Access);
        if(mysqli_num_rows($AccessResult) != 0) {
            header( "Location: login.php" );
        }
    }


?>
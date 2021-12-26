<?php
    session_start();

    if (!(isset($_SESSION["loggedin"])) || $_SESSION["loggedin"] == false) {
        header( "Location: login.php" );
    } 

    include ("serverConfig.php");

    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if ($conn -> connect_error) {
        die("Connection failed:" .$conn -> connect_error);
    }

    if(isset($_SESSION['user'])) {
        $userID = $_SESSION['user'];
       $bannedSql = "SELECT * FROM banneduser 
                      WHERE userID = {$userID};";
        $bResult = $conn -> query($bannedSql);
    }
    else if(isset($_SESSION['teacher'])) {
        $teacherID = $_SESSION['teacher'];
        $bannedSql = "SELECT * FROM bannedteacher
                      WHERE teacherID = {$teacherID};";
        $Access = "SELECT access FROM teacher
                      WHERE access = 0;";
        $AccessResult = $conn -> query($Access);
        $bResult = $conn -> query($bannedSql);
    }
    
    if(mysqli_num_rows($bResult) !== 0 && mysqli_num_rows($AccessResult) == 0) {
        header( "Location: login.php" );
    }

?>
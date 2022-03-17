<?php
    //Removes an answer file 
    include ("serverConfig.php");
    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if ($conn -> connect_error) {
        die("Connection failed:" .$conn -> connect_error);
    }

    $taskID = $_GET['id'];
    //get the answer file from tasks where the taskID is the current task
    $sql = "select taskfilename
                from tasks where taskID = {$taskID}";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        $taskfile = $row['taskfilename'];
        //remove the file from the directory
        unlink("tasksAnswers/Answer{$taskfile}.java");
    }

    $conn->close();
    header('Location: taskPageTeacher.php');

?>
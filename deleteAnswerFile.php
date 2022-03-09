<?php
    include ("serverConfig.php");
    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if ($conn -> connect_error) {
        die("Connection failed:" .$conn -> connect_error);
    }

    $taskID = $_GET['id'];

    $sql = "select taskfilename
                from tasks where taskID = {$taskID}";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        $taskfile = $row['taskfilename'];
        unlink("tasksAnswers/Answer{$taskfile}.java");
    }

    $conn->close();
    header('Location: taskPageTeacher.php');

?>
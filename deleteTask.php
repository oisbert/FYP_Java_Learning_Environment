
<?php
    //function to delete a task
    include("validateLoggedIn.php");
    include("serverConfig.php");

    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
    //get the taskID
    $taskToDelete = $_GET['id'];
    //delete the task form the database 
    $connectionsSQL = "DELETE FROM tasks WHERE taskID={$taskToDelete};";

    if ($conn->query($connectionsSQL) === TRUE) {
        echo "Sucessful";
    } else {
        echo "Error: " . $connectionsSQL . "<br>" . $conn->error;
    }

    //we also need to remove the tasks info from the taskstatus page 
    //write another query to delete from the task status table 
    $connections2SQL = "DELETE FROM taskstatus WHERE taskID={$taskToDelete};";

    if ($conn->query($connections2SQL) === TRUE) {
        echo "Sucessful";
    } else {
        echo "Error: " . $connections2SQL . "<br>" . $conn->error;
    }

    header("Location: taskPageTeacher.php");
    $conn->close();
?>

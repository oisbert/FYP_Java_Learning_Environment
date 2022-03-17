<?php 
    /*
        function that is utilized in the addFeedbackback.php
        when a form is submitted
    */
    if(isset($_POST['submit'])){
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }

        /*
            Get the taskID of the user the feedback is going to
            Get the taskID 
            Query is the contents of the feedback this will be posted into the database
        */

        $taskID = $_GET['taskID'];
        $userID = $_GET['userID'];
        $query = $_POST['query'];

        /*
            Update the taskstatus table'
            Set the feedback column to the feedback
            Where the taskID is the current task being edited and the userID as mentioned above
        */
        $sql = "UPDATE taskstatus
                SET feedback = '{$query}' 
                WHERE taskID = {$taskID} AND userID = {$userID}";

        if ($conn->query($sql) === TRUE) {
           
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
         }

        $conn->close();
        header('Location: taskStatusView.php');
        }
        else{
            echo "not working";
        }
    

?>
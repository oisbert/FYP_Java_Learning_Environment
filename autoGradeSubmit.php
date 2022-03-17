<?php 
    //fucntion to submit the auto-grader content
    if(isset($_POST['submit'])){
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }

        //get the taskID of the task being graded 
        $taskID = $_GET['taskID'];
        //get the userID of the task being graded
        $userID = $_GET['userID'];
        //get the content from the autograder 
        $textareaValue = $_POST['content'];

        //update the taskstatus set the autofeedback to the content from the autograder
        $sql = "UPDATE taskstatus
                SET autoFeedback =  ('".$textareaValue."') 
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
            echo "not working"; //for testing
        }
    

?>
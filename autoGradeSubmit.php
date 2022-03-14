<?php 
    if(isset($_POST['submit'])){
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }
        $taskID = $_GET['taskID'];
        $userID = $_GET['userID'];
        $textareaValue = $_POST['content'];
        echo $taskID;
        $sql = "UPDATE taskstatus
                SET autoFeedback =  ('".$textareaValue."') WHERE taskID = {$taskID} AND userID = {$userID}";

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
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    

?>
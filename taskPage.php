<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/taskPageTeacher?v=<?php echo time(); ?>">
    <title>Tasks </title>
</head>

<script type="text/javascript">
    function taskCompleted(taskID) {
            window.location.href= 'taskStatusComplete.php?taskID=' + taskID;
        }

    function requestForHelp(taskID) {
            window.location.href= 'needHelp.php?taskID=' + taskID;
        }

    function disableButton(btn) {
            document.getElementById("btn1").disabled = true;
            alert("Button has been disabled.");
        }

</script>


<body>
    <?php 
        include ("validateLoggedIn.php");
        include ("headerTeacher.html");
    ?>

    <div class = "page-main">
        <?php
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $sql = "select taskTitle, taskDescription, taskID, teacherID
            from tasks ";

            $result = $conn -> query($sql);

            if(mysqli_num_rows($result) != 0) {
                while($row = $result->fetch_assoc())
                {   
                    print "<div class='Tasks'>
                                    <p class='Details text-left'><b>Title: </b>{$row['taskTitle']}</p>
                                    <p class='Details text-left'><b>Description: </b>{$row['taskDescription']}</p>
                                    <button type ='button' class='btn btn-success' onClick='taskCompleted({$row['taskID']})'>Complete</button>
                                    <button type ='button' id = 'btn1' class='btn btn-warning' onClick='requestForHelp({$row['taskID']})'>Need Help</button>";
                                    print "</div><BR>";

                    $ButtonSQL = "select * from taskstatus where userID = {$_SESSION['user']} AND taskID = {$row['taskID']};";
                    $ButtonSQLResult = $conn -> query($ButtonSQL);
                    $ButtonSQL = $ButtonSQLResult->fetch_assoc();
                    if($ButtonSQL) {
                        print "<button type ='button' class='btn btn-danger' disabled '>Complete</button>";
                    } else {
                        print "<button type ='button' class='btn btn-success' onClick='taskCompleted({$row['taskID']})'>Complete</button>";
                    }
                                    
            }
        }
        ?>

    </div>
</body>
</script>
</html>
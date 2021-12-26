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
    
    function cancelRequest(taskID) {
        if (confirm("Are you sure you want remove your task status") == true){
        window.location.href= 'cancelRequest.php?taskID=' + taskID;
        }
    }

</script>


<body>
    <?php 
        include ("validateLoggedIn.php");
        include ("header.html");
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
                                    <p class='DetailsTitle text-left'>{$row['taskTitle']}</p>
                                    <p class='DetailsDesc text-left'><b>Description: </b>{$row['taskDescription']}</p>";

                    $ButtonSQL = "select * from taskstatus where userID = {$_SESSION['user']} AND taskID = {$row['taskID']};";
                    $ButtonSQLResult = $conn -> query($ButtonSQL);
                    $ButtonSQL = $ButtonSQLResult->fetch_assoc();

                    if($ButtonSQL) {
                        print "<button type ='button' id = 'completebtn' class='btn btn-success' disabled '>Complete</button> ";
                    } else {
                        print "<button type ='button' id = 'completebtn' class='btn btn-success' onClick='taskCompleted({$row['taskID']})'>Complete</button>";
                    }

                    if($ButtonSQL) {
                        print "<button type ='button' id = 'needHelpbtn' class='btn btn-warning' disabled '>Need Help</button> ";
                    } else {
                        print "<button type ='button' id = 'needHelpbtn' class='btn btn-warning' onClick='requestForHelp({$row['taskID']})'>Need Help</button>";
                    }

                    if($ButtonSQL) {
                        print "<button type ='button' id = 'cancelbtn' class='btn btn-danger' onClick='cancelRequest({$row['taskID']})'>Cancel</button>";
                    } else {
                        print "<button type ='button' id = 'cancelbtn' class='btn btn-danger' disabled '>Cancel</button> ";
                    }
               
                    print "</div><BR>";
                                    
            }
        }
        ?>

    </div>
</body>
</script>
</html>
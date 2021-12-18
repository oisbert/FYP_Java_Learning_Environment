<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks Teacher</title>
</head>
<body>
    <?php 
        include ("validateLoggedIn.php");
        //include ("headerTemplate.html");
    ?>

    <div class = "page-main">
        <?php
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $sql = "select a.taskTitle, a.taskDescription, a.taskExperience, a.taskID, b.teacherID
                        from tasks a
                        ORDER BY timeAdded DESC;";
        ?>

    </div>
</body>
</html>
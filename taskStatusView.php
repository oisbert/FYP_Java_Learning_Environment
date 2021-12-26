<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/taskStatusView.css?v=<?php echo time(); ?>">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <title>Task View</title>

    </head>
    <body>
        <?php include ("headerTeacher.html"); ?>
        <h1 class='page-heading'>Task Status</h1>
        <hr>
        <div class="page-box">
            <?php
                include ("validateLoggedIn.php");
                include ("serverConfig.php");

                $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
                if ($conn -> connect_error) {
                    die("Connection failed:" .$conn -> connect_error);
                }
                $sql = "SELECT a.status, b.taskTitle, c.username
                        FROM taskstatus a 
                        INNER JOIN tasks b
                        ON a.taskID = b.taskID
                        INNER JOIN users c
                        ON a.userID = c.userID";
                $result = $conn -> query($sql);
                    print "<table class='StatusTable' border='1'>";
                    print "<thead>
                                <tr>
                                    <th>Assignment name</th>
                                    <th>Student Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>";
                            
                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc())
                        {   
                            print "<TR>";
                            print "<TD>{$row['taskTitle']}</TD>";
                            print "<TD>{$row['username']}</TD>";
                            print "<TD>{$row['status']}</TD>";
                            print "</TR>";
                        }
                    } else {
                        print "<TR>";
                        print "<TD colspan='3'>No Task information avalible</TD>";
                        print "</TR>";
                    }
                    $conn->close();
                    print "</table>";

            ?>
        </div>
    </body>
</html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/userfeedback.css?v=<?php echo time(); ?>">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <title>User Feedback</title>

    </head>

    <body>
        <?php include ("header.html"); ?>
        <div class="page-box">
            <?php
                include ("validateLoggedIn.php");
                include ("serverConfig.php");

                $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
                if ($conn -> connect_error) {
                    die("Connection failed:" .$conn -> connect_error);
                }

                $_SESSION['user'] = $userID;
                $taskID = $_GET['taskID'];
                $sql = "SELECT feedback
                        FROM taskstatus 
                        WHERE userID = {$userID} AND taskID = {$taskID}";
                $result = $conn -> query($sql);
                    print "<div class='Feedback' border='1'>";
                    print "<h1>Feedback</h1>";
                    if(mysqli_num_rows($result) != 0) {
                        while($row = $result->fetch_assoc())
                        {   
                            print "<p>{$row['feedback']}</p>";
                        }
                    } 
                    $conn->close();
                    print "</div>";

            ?>
        </div>
    </body>
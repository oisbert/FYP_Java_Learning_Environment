<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/UserConnections.css?v=<?php echo time(); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <title>Admin</title>

    </head>
    <body>
        <?php
            //include ("validateAdmin.php");
            include ("serverConfig.php");
            
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            
            $teacherID = $_GET['id'];
            print $teacherID;
            $sql = "UPDATE teacher SET access = 1 WHERE teacherID = {$teacherID}";

            if ($conn->query($sql) === TRUE) {
                header( "Location: admin.php" );

            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
               header( "Location: admin.php" );
            $conn->close();
        ?>
    </body>
</html>
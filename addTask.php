<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/addTask.css?v=<?php echo time(); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <title>Add Task</title>
    </head>
    <body>
        
        <?php 
            include ("validateLoggedIn.php");
            include ("headerTeacher.html")
        ?>

        <h1 class="page-heading">Add Task</h1>
        <hr>
        <div class = "description-container">
            <div class = "bio-description">
                <form method="post" action="addTask.php">
                    <h3>Task title:</h3>
                    <input class="text-input" type='text' placeholder='Enter Task Title' name='taskTitle' required></input>
                    <h3 id = 'desc'>Task Description:</h3>
                    <textarea id='description' name='taskDescription' class='description-textarea' rows= 20 cols=70 required></textarea><br>
                    <br>
                    <br>
                    <input class="button" type="submit" name="submit" value="Submit Task"/>
                </form>
            </div>
        </div>
    </body>
</html>

<?php 

    function addTask() {
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }
        $teacherID = $_SESSION['teacher'];
        echo $teacherID;
        $sql = "INSERT INTO tasks ( taskTitle, taskDescription, teacherID)
                VALUES ('{$_POST['taskTitle']}', '{$_POST['taskDescription']}','{$teacherID}')";

        if ($conn->query($sql) === TRUE) {
            //header( "Location: teacherHome.php" );
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
         }

        $conn->close();
        }

    if(isset($_POST["submit"])) addTask();
?>
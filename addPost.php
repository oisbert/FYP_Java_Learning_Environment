<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/addTask.css?v=<?php echo time(); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <title>Add Post</title>
    </head>
    <body>
        
        <?php 
            include ("validateLoggedIn.php");
            include ("header.html")
        ?>

        <h1 class="page-heading">Add Post</h1>
        <hr>
        <div class = "description-container">
            <div class = "bio-description">
                <form method="post" action="addPost.php">
                    <h3>Post title:</h3>
                    <input class="text-input" type='text' placeholder='Enter Post Title' name='Title' required></input>
                    <h3 id = 'desc'>Post Description:</h3>
                    <textarea id='description' name='description' class='description-textarea' rows= 20 cols=70 required></textarea><br>
                    <br>
                    <br>
                    <input class="button" type="submit" name="submit" value="Submit Post"/>
                </form>
            </div>
        </div>
    </body>
</html>

<?php 

    function addPost() {
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }
        $userID = $_SESSION['user'];
        $sql = "INSERT INTO posts ( Title, description, userID, date)
                VALUES ('{$_POST['Title']}', '{$_POST['description']}','{$userID}', NOW())";

        if ($conn->query($sql) === TRUE) {
           
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
         }

        $conn->close();
        }

    if(isset($_POST["submit"])) addPost();
?>
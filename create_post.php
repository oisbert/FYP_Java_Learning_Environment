<?php
    session_start();
    include ("serverConfig.php");
    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
            }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = " ";
        $title = $_POST["title"];
        $post_desc = $_POST["desc"];

        if(empty($title) or empty($post_desc)) {
            $errors = "Invalid please enter somthing";
        } else {
            $query = mysqli_query($conn, "INSERT INTO posts(title, post_desc) VALUES ('$title','$post_desc');");

            if($query){
                echo "post created";
            }else{
                echo "it didnt work";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create new Post</h1>
    <p colour = "red"><?php echo $errors; ?></p>
    <form action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "POST">
        <input type ="text" name="title" placeholder="title"><br>
        <textarea name ="desc" rows="25" cols="50" placeholder="Post Description"></textarea>
        <input type='submit'>
    </form>
    
</body>
</html>
<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Forum</title>
</head>
<body>
    <p>Welcome <?php echo $_SESSION['username']  ?> </p>
    <a href="create_post.php">Create a new post</a>
</body>
</html>
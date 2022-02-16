<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Task Answer</title>
</head>
<body>
        <?php 
            include ("validateLoggedIn.php");
            include ("headerTeacher.html");
        ?>

        <div class = "description-container">
            <div class = "bio-description">
                <form method="post" action="addTask.php" enctype="multipart/form-data">
                    <input type ="file" name="file">
                    <br>
                    <br>
                    <input class="button" type="submit" name="submit" value="Submit Answer"/>
                </form>
        </div>
</body>
</html>
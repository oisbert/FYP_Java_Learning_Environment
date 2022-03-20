<html>
           <!-- 
         Function to add a reply a post on the forum page
      -->

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/addreply.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <title>Add Reply</title>
</head>

<body>


    <?php 
         include ("validateLoggedIn.php");
         include("header.html");
      
         ?>

                    <!-- 
            Add text box to enter the reply content 
            -->
    <div class="Addtask-text">
        <form method="post">
            <textarea name="description" type="text" rows="20" cols="80">
      </textarea>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

</body>
<?php
        //when the post is submitted...
         if (isset($_POST["submit"])) {

            //Get the postID of the post that the user is replying on
            $PostID = $_GET["PostID"];
            //Get the userID of the current user
            $userID = $_SESSION['user'];
            //Get the username of the current user
            $username = $_SESSION['username'];
            //Get the description of the reply
            $description = $_POST["description"];

            //insert into the database
            $sql = "INSERT INTO reply (PostID, userID, description, replyby)
                    VALUES ('{$PostID}', {$userID}, '{$description}', '{$username}')";
            
            if ($conn->query($sql) === TRUE) {
               echo "you have replied to the post!!";
               header("Location: forumHome.php");
            } else {
               echo "Error posting reply: " . $conn->error;
            }
         }
            $conn->close();
         
      ?>
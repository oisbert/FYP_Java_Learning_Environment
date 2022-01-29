<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/addreply.css?v=<?php echo time(); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <title>Add Reply</title>
    </head>
    <body>
        

<?php 
         include ("validateLoggedIn.php");
         include("header.html");
      
         ?>
      <div class ="Addtask-text">
      <form method="post" >  
      <textarea name="description" type="text" rows="20" cols="80">
      </textarea>
         <input type="submit" name="submit" value="Submit">  
      </form>
      </div>
   
   </body>
   <?php
         if (isset($_POST["submit"])) {

            $PostID = $_GET["PostID"];
            $userID = $_SESSION['user'];
            $username = $_SESSION['username'];
            $description = $_POST["description"];

            $sql = "INSERT INTO reply (PostID, userID, description, replyby)
                    VALUES ('{$PostID}', {$userID}, '{$description}', '{$username}')";
            
            if ($conn->query($sql) === TRUE) {
               echo "you have replied to the post!!";
            } else {
               echo "Error posting reply: " . $conn->error;
            }
         }
            $conn->close();
         
      ?>
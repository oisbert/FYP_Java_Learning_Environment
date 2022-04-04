<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/forumHome.css?v=<?php echo time(); ?>">
      <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
      <title>Forum</title>
   </head>
   <script>
      function showComments(modalNumber) {
          var modal = document.getElementById("myModal" + modalNumber);
          modal.style.display = "block";
          
          var span = document.getElementsByClassName("close" + modalNumber)[0];
          span.onclick = function() {
              modal.style.display = "none";
          }
      
          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
          }
      }
      
      function addReply(PostID) {
          window.location.href= 'addReply.php?PostID=' + PostID;
      }
      
   </script>
   <body>
      <?php 
         include ("validateLoggedIn.php");
         include ("header.html");
         ?>
      <div class = "page-main">
         <?php
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }
            
            $sql = "SELECT *
                    FROM posts ";
            
            
            $result = $conn -> query($sql);
            
            
            print "<img class='AddNewPost' id = 'animatebutton' src ='images/add.png' alt='Add post' onClick='location.href='addPost.php'>";
            if(mysqli_num_rows($result) != 0) {
                $counter = 0;
                while($row = $result->fetch_assoc())
                { 
                    $replySql = "SELECT a.ReplyID, a.description , a.PostID, a.replyby
                                 from reply a 
                                 INNER JOIN posts b 
                                 ON a.PostID = b.PostID
                                 WHERE a.PostID = {$row['PostID']}";
            
                    $valuePass =  "{$row['PostID']}";
            
                    
                    $replyResult = $conn -> query($replySql);
                    
                    while($replyRow = $replyResult ->fetch_assoc()){
                        
                        if("{$row['PostID']}" == "{$replyRow['PostID']}"){
                        $reply = array('Desc' => $replyRow['description'], 'PostID' => $replyRow['PostID'], 'username' => $replyRow['replyby']);
                        $replyNeeded[] = $reply;
                   
                        }
                        else{
                            $replyNeeded = array();
                        }
            
                    }
            
                    $usernameSQL = "SELECT a.username, a.userID
                                        from users a 
                                        INNER JOIN posts b 
                                        ON a.userID = b.userID
                                        WHERE a.userID = {$row['userID']}";
            
                    $usernameSQLResult = $conn -> query($usernameSQL);
            
                    while($userRow = $usernameSQLResult ->fetch_assoc()){
                        if("{$row['userID']}" == "{$userRow['userID']}"){
                            $userNeeded = [];
                        $user = array('username' => $userRow['username']);
                            if (!in_array($user, $userNeeded)){
                                $userNeeded[] = $user;
                            }
                        }
                        else{
                            $userNeeded = array();
                        }
            
                    }
            
                    
                    print "<div class='Posts'>
                                    <p class='Details text-left'><b>Title: </b>{$row['Title']}</p>
                                    <p class='Details text-left'><b></b>{$row['description']}</p>";
                                    if(!empty($userNeeded)) {
                                        foreach ($userNeeded as $row) 
                                        {   
                                   echo "<p class='Details text-left'><b>by user: </b> {$row['username']}</p>";
                                        }
                                        $userNeeded = [];
                                    }
                                   print "<button id = 'animatebutton' class='showcomments' onClick='showComments({$counter})'>Show comments</button> 
                                    <button id = 'animatebutton' class= 'addreplybtn' type='button' onClick='addReply({$valuePass})'>add reply</button>";          
                                    print "</div>";
                                  
                                    
                    print "<div id='myModal{$counter}' class='modal'>
                                                    <!-- Modal content -->
                                                    <div class='modal-content'>
                                                        <span class='close{$counter} close'>&times;</span>
                                                        <table class='reply'>
                                                        <thead>
                                                            <tr>
                                                                <th>Comments</th>
                                                            </tr>
                                                        </thead>";
                                                        if(!empty($replyNeeded)) {
                                                            foreach ($replyNeeded as $row ) 
                                                                
                                                            {   
                                                                echo '<tr>';
                                                               
                                                                echo '<td>' . $row['Desc'] . '</td>';
                                                                echo '<td>' . 'reply by:' . $row['username'] . '</td>';
                                                                echo '</tr>';
                                                            }
                                                    
                                                            $replyNeeded = [];
                                                           
                                                        }
                                                    
                                                        else echo "<tr><td colspan='3'>No Comments for this post</td></tr>";
                                                        print "</table> 
                                                        
                                                        </div></div>";
                                                        $counter++;
                                                        
                }                           
            }
            ?>
    

         </div>
      </div>
      <script src="js/animationForum.js" type="text/javascript"></script>
      <script src="js/animationButtonForum.js" type="text/javascript"></script>
   </body>
</html>
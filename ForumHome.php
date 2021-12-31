<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/forumHome.css?v=<?php echo time(); ?>">
    <title>Tasks Teacher</title>
</head>

<script>
    function deleteVacancy(variable) {
            if (confirm("Are you sure you want to delete this Task?") == true) {
            window.location.href= 'deleteTask.php?id=' + variable;
            };
        }

        function showSkills(modalNumber) {
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

            

            if(mysqli_num_rows($result) != 0) {
                $counter = 0;
                while($row = $result->fetch_assoc())
                { 
                    $replySql = "SELECT a.ReplyID, a.description , a.PostID
                                 from reply a 
                                 INNER JOIN posts b 
                                 ON a.PostID = b.PostID
                                 WHERE a.PostID = {$row['PostID']}";

                    print "{$row['PostID']}";

                    
                    $replyResult = $conn -> query($replySql);
                    
                    while($replyRow = $replyResult ->fetch_assoc()){
                        
                        if("{$row['PostID']}" == "{$replyRow['PostID']}"){
                        print "true";
                        $reply = array('Desc' => $replyRow['description'], 'PostID' => $replyRow['PostID']);
                        $replyNeeded[] = $reply;
                   
                        }
                        else{
                            $replyNeeded = array();
                        }
              
        
                    
                    }
                    
                    print "<div class='Tasks'>
                                    <p class='Details text-left'><b>Title: </b>{$row['Title']}</p>
                                    <p class='Details text-left'><b>description: </b>{$row['description']}</p>
                                    <button class='showskills' onClick='showSkills({$counter})'>Show comments</button>";            
                                    print "</div><BR>";
                                  
                                    
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
                                                            foreach ($replyNeeded as $row) 
                                                            {   
                                                                echo '<tr>';
                                                               
                                                                echo '<td>' . $row['Desc'] . '</td>';
                                                                echo '<td>' . $row['PostID'] . '</td>';
                                                                echo '</tr>';
                                                            }
                                                            $replyNeeded = [];
                                                        }
                                                        else echo "<tr><td colspan='3'>No Comments for this post</td></tr>";
                                                        print "</table>
                                                        <div class = test> <button type='button'>add reply</button> </div>
                                                        </div></div>";
                                                        $counter++;
                                                        
                }                           
            }
        ?>
        <div class="AddNewTask" onClick="location.href='addPost.php'"><h1>Add Post<h1></div>
    </div>
</body>
</html>
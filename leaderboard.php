<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/leaderboard.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
    <title>leaderboard </title>
</head>


<body>
    <?php 
        include ("validateLoggedIn.php");
        include ("header.html");
    ?>

    <div class = "page-main">
        <?php
        //this page loads the leaderboard information 
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }
            //get the points and the usernames from the database
            $sql = "SELECT username, points, admin
            FROM users ORDER BY points DESC";

            $result = $conn -> query($sql);
            print  "<div class = 'title'><h1>HighScores</h1></title>";
            if(mysqli_num_rows($result) != 0) {
                while($row = $result->fetch_assoc())
                {   
                    //do not include admin accounts on the leaderboard 
                    if($row['admin'] != 1){
                    //load all the students on the onto the leaderboard in order of points
                    print "<div class='leaderboard'>
                                    <ol>
                                    <li>
                                    <big>{$row['username']}</big>
                                    <medium>{$row['points']}</medium>
                                    </li>
                                    </ol>";
                    }
               
                    print "</div><BR>";
                                    
            }
        }
        ?>

    </div>

    <script src="js/leaderboard.js" type="text/javascript"></script>
</body>
</script>
</html>
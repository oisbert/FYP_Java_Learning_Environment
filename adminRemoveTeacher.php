<!DOCTYPE html>
<html lang="en">
     <!-- 
         Page to show the admin teachers currently on the site
         and give them the option to remove the accounts
      -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/adminAccess?v=<?php echo time(); ?>">
    <title>Admin</title>
</head>

<script type="text/javascript">
    //function to show warning about adding a user
    function teacherDelete(variable) {
        if (confirm("Are you sure you want to Delete this teacher?") == true) {
                window.location.href= 'removeTeacher.php?id=' + variable;
                };
    }

</script>


<body>
    <?php 
        include ("validateLoggedIn.php");
        include ("headerAdmin.html")
    ?>

    <div class = "page-main">
        <?php
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $sql = "SELECT teacherID, teachername, email
                    FROM teacher ";

            $result = $conn -> query($sql);

            if(mysqli_num_rows($result) != 0 ) {
                while($row = $result->fetch_assoc())
                {   
                    print "<div class='list-teachers'>
                                    <p class='Details text-left'><b>Name: </b>{$row['teachername']}</p>
                                    <p class='Details text-left'><b>Email: </b>{$row['email']}</p>
                                    <button type ='button' class='btn btn-danger' onClick='teacherDelete({$row['teacherID']})'>Remove</button>";
                                    print "</div><BR>";

                                    
            }
        }
        ?>

    </div>
</body>
</script>
</html>
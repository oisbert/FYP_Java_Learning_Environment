<!DOCTYPE html>
<html lang="en">
        <!-- 
         Page to show the admin teachers who dont have access 
         and provide options to remove or delete their access request
      -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/adminAccess.css?v=<?php echo time(); ?>">
    <title>Admin</title>
</head>

<script type="text/javascript">
    //function to show warning about adding a user
    function teacherAccess(variable) {
        if (confirm("Are you sure you want to Add this User?") == true) {
            window.location.href = 'teacherAccess.php?id=' + variable;
        };
    }

    //function to show warning about deleting a user
    function teacherDelete(variable) {
        if (confirm("Are you sure you want to Delete this User?") == true) {
            window.location.href = 'removeTeacher.php?id=' + variable;
        };
    }
</script>


<body>
    <?php
    include("validateLoggedIn.php");
    include("headerAdmin.html")
    ?>

    <div class="page-main">
        <?php
        include("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
        }

        //select all the following attributes from teacher
        $sql = "SELECT teacherID, teachername, email, access
                FROM teacher ";

        $result = $conn->query($sql);

        if (mysqli_num_rows($result) != 0) {
            while ($row = $result->fetch_assoc()) {
                //if the the attribute access has a value of 0 do the following...
                if ($row["access"] == 0)
                    //print a list of the teachers with no access and give the option to add or remove them
                    print "<div class='list-teachers'>
                                    <p class='Details text-left'><b>Name: </b>{$row['teachername']}</p>
                                    <p class='Details text-left'><b>Email: </b>{$row['email']}</p>
                                    <button type ='button' class='btn btn-success' onClick='teacherAccess({$row['teacherID']})'>Allow</button>
                                    <button type ='button' class='btn btn-danger' onClick='teacherDelete({$row['teacherID']})'>Remove</button>";
                print "</div><BR>";
            }
        }
        ?>

    </div>
</body>
</script>

</html>
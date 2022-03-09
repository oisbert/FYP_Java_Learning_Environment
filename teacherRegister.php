<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/register.css?v=<?php echo time(); ?>">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <title>Loop : Company Register</title>
        
        <script>

            function check_pass() {
                if (document.getElementById('password').value ==
                        document.getElementById('confirm_password').value) {
                            
                    document.getElementById('submit').disabled = false;
                    document.getElementById('submit').style.borderColor = "black"; 
                    document.getElementById("alert").style.display = "none";
                } 
                else {
                    document.getElementById('submit').disabled = true;
                    document.getElementById('submit').style.borderColor = "white"; 
                    document.getElementById("alert").style.display = "block";
                }
            }

        </script>

    </head>
    <body>
    <div class="bg-image"></div>
        <div class="wrapper">
            <div class="banner"> 
                    <div class="login">
                        <h2 style="text-align: left;">Register Teacher</h2>
                        <form method="post" action="teacherRegister.php">
                            <input class="input" type="text" name="name" pattern="[a-zA-z\s]{2,100}" title="Must be between 2 and 100 chars" placeholder="Teacher Name" required><br>
                            <input class="input" type="email" name="email" placeholder="Teacher Email" required><br>
                            <input class="input" id="password" type="password" name="pass" placeholder="Password" onchange='check_pass();'
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}" title="Must be between 6 and 16 chars and include at least one uppercase and one number" required><br>
                            <input class="input" id="confirm_password" type="password" name="passConfirm" placeholder="Confirm Password" onchange='check_pass();'
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}" title="Must be between 6 and 16 chars and include at least one uppercase and one number" required><br>
                            
                            <h6 id="alert" style="display:none">Your passwords don't match!</h6> 

                            <input class="button" id="submit" name="submit" type="submit" value="Register" style="margin-left: 22%;">
                            
                        </form>
                            <div class="buttons">
                                <div class="register">
                                    <h5><u>Have an Account?</u></h5>
                                    <button class="button" onClick="location.href='teacherLogin.php'">Sign In</button>
                                    <br>
                                    <a href="register.php" style="color: white; padding-left:0%">Are you a Student? Click here</a>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


<?php

    if(isset($_POST['submit'])) {

        session_start();
        session_unset();

        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" . $conn -> connect_error);
        }

        if($_POST['pass'] === $_POST['passConfirm']) {

            $teachername = $_POST['name'];
            $email = $_POST['email'];
            $hashedPass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO teacher (teachername, email, password)
            VALUES ('{$teachername}', '{$email}', '{$hashedPass}')";
            
            if ($conn->query($sql) === TRUE) {
                $sql = "select * from teacher where email=\"{$email}\";";
                $result = $conn -> query($sql);
                $row = $result->fetch_assoc();
                $teacherID = $row["teacherID"];
                $teachername = $row["teachername"];

                $_SESSION['company'] = $teacherID;
                $_SESSION['teachername'] = $teachername;
                $_SESSION['loggedin'] = true;
                header( "Location: teacherLogin.php" );

            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;

            }

        }
        else {
            
        }

        $conn->close();
    }
?>
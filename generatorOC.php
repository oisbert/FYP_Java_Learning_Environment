<html>
    <body>
        <?php

            include ("validateLoggedIn.php");
            include ("serverConfig.php");
            include ("IDtoLetter.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }

            $userIDtoLetters = num2alpha($userID);
            $userPoly = fopen("{$userIDtoLetters}Car.java", "w+");
            $current = file_get_contents("Car.java", "w");
            $userPolyEdit = fopen("{$userIDtoLetters}Car.java", "w");
            fwrite($userPolyEdit, $current);

            $holder = file_get_contents("{$userIDtoLetters}Car.java");
            $replace = str_replace("Car", "{$userIDtoLetters}Car",$holder);
            file_put_contents("{$userIDtoLetters}Car.java", $replace);
            fclose($userPolyEdit);
            $classPoly = fopen("{$userIDtoLetters}Car.class", "w");
            $conn->close();
            header( "Location: objectAndclasses.php" );
        ?>
    </body>
</html>
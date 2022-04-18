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

            $userIDtoLetters = num2alpha($userID); //convert the user id to a letter
            $userPoly = fopen("{$userIDtoLetters}Car.java", "w+"); //open the tempory user file 
            $current = file_get_contents("Car.txt", "w"); //get the contents of the base file
            $userPolyEdit = fopen("{$userIDtoLetters}Car.java", "w"); //open the tempory user file make it writable
            fwrite($userPolyEdit, $current); //put the contents of the base file into the user temporary file

            $holder = file_get_contents("{$userIDtoLetters}Car.java");
            $replace = str_replace("Car", "{$userIDtoLetters}Car",$holder); //replace all the words Car with userIDCar
            file_put_contents("{$userIDtoLetters}Car.java", $replace);
            fclose($userPolyEdit);
            $classPoly = fopen("{$userIDtoLetters}Car.class", "w");
            $conn->close();
            header( "Location: objectAndclasses.php" );
        ?>
    </body>
</html>
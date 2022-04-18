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
            $userPoly = fopen("{$userIDtoLetters}Polymorphism.java", "w+"); //open the tempory user file 
            $current = file_get_contents("Polymorphism.txt", "w"); //get the contents of the base file
            $userPolyEdit = fopen("{$userIDtoLetters}Polymorphism.java", "w"); //open the tempory user file make it writable
            fwrite($userPolyEdit, $current); //put the contents of the base file into the user temporary file

            $holder = file_get_contents("{$userIDtoLetters}Polymorphism.java");
            $replace = str_replace("Polymorphism", "{$userIDtoLetters}Polymorphism",$holder); //replace all the words interface with userIDinterface
            file_put_contents("{$userIDtoLetters}Polymorphism.java", $replace);
            fclose($userPolyEdit);
            $classPoly = fopen("{$userIDtoLetters}Polymorphism.class", "w");
            $conn->close();
            header( "Location: polymorphism.php" );
        ?>
    </body>
</html>
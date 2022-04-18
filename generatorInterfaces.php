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
            $userPoly = fopen("{$userIDtoLetters}Interfaces.java", "w+"); //open the tempory user file 
            $current = file_get_contents("Interfaces.txt", "w"); //get the contents of the base file
            $userPolyEdit = fopen("{$userIDtoLetters}Interfaces.java", "w"); //open the tempory user file make it writable
            fwrite($userPolyEdit, $current); //put the contents of the base file into the user temporary file

            $holder = file_get_contents("{$userIDtoLetters}Interfaces.java");
            $replace = str_replace("Interfaces", "{$userIDtoLetters}Interfaces",$holder); //replace all the words interface with userIDinterface
            file_put_contents("{$userIDtoLetters}Interfaces.java", $replace);
            fclose($userPolyEdit);
            $classPoly = fopen("{$userIDtoLetters}Interfaces.class", "w");
            $conn->close();
            header( "Location: Interfaces.php" );
        ?>
    </body>
</html>
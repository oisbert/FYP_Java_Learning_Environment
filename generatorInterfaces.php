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
            $userPoly = fopen("{$userIDtoLetters}Interfaces.java", "w+");
            $current = file_get_contents("Interfaces.txt", "w");
            $userPolyEdit = fopen("{$userIDtoLetters}Interfaces.java", "w");
            fwrite($userPolyEdit, $current);

            $holder = file_get_contents("{$userIDtoLetters}Interfaces.java");
            $replace = str_replace("Interfaces", "{$userIDtoLetters}Interfaces",$holder);
            file_put_contents("{$userIDtoLetters}Interfaces.java", $replace);
            fclose($userPolyEdit);
            $classPoly = fopen("{$userIDtoLetters}Interfaces.class", "w");
            $conn->close();
            header( "Location: Interfaces.php" );
        ?>
    </body>
</html>
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
            $userPoly = fopen("{$userIDtoLetters}Polymorphism.java", "w+");
            $current = file_get_contents("Polymorphism.java", "w");
            $userPolyEdit = fopen("{$userIDtoLetters}Polymorphism.java", "w");
            fwrite($userPolyEdit, $current);

            $holder = file_get_contents("{$userIDtoLetters}Polymorphism.java");
            $replace = str_replace("Polymorphism", "{$userIDtoLetters}Polymorphism",$holder);
            file_put_contents("{$userIDtoLetters}Polymorphism.java", $replace);
            fclose($userPolyEdit);
            $classPoly = fopen("{$userIDtoLetters}Polymorphism.class", "w");
            $conn->close();
            header( "Location: polymorphism.php" );
        ?>
    </body>
</html>
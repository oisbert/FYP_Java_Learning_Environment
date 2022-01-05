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
            $userPoly = fopen("{$userIDtoLetters}Dog.java", "w+");
            $current = file_get_contents("Dog.java", "w");
            $userPolyEdit = fopen("{$userIDtoLetters}Dog.java", "w");
            fwrite($userPolyEdit, $current);

            $holder = file_get_contents("{$userIDtoLetters}Dog.java");
            $replace = str_replace("Dog", "{$userIDtoLetters}Dog",$holder);
            file_put_contents("{$userIDtoLetters}Dog.java", $replace);
            fclose($userPolyEdit);
            $classPoly = fopen("{$userIDtoLetters}Dog.class", "w");
            $conn->close();
            header( "Location: objectAndclasses.php" );
        ?>
    </body>
</html>
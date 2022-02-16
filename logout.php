<?php
     include ("serverConfig.php");
     include ("unlinkFile.php");
     include ("IDtoLetter.php");
        
     $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
     if ($conn -> connect_error) {
         die("Connection failed:" .$conn -> connect_error);
    }

    session_start();

    $userID = $_SESSION['user'];
    $userIDtoLetters = num2alpha($userID);
    session_unset();

    $PolyDelete = "{$userIDtoLetters}Polymorphism.java";
    $PolyClassDelete = "{$userIDtoLetters}Polymorphism.class";

    $OCDelete = "{$userIDtoLetters}Car.java";
    $OCClassDelete = "{$userIDtoLetters}Car.class";

    $InterfacesDelete = "{$userIDtoLetters}Interfaces.java";
    $InterfacesClassDelete = "{$userIDtoLetters}Interfaces.class";

    $RandomDelete = "{$userIDtoLetters}Random.java";
    $RandomClassDelete = "{$userIDtoLetters}Random.class";

    unlinkFiles($PolyDelete, $PolyClassDelete);
    unlinkFiles($OCDelete, $OCClassDelete);
    unlinkFiles($InterfacesDelete,$InterfacesClassDelete);
    unlinkFiles($RandomDelete, $RandomClassDelete);

    session_destroy();

    header( "Location: login.php" );

?>
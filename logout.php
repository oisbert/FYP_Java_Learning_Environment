<?php
     include ("serverConfig.php");
     include ("unlinkFile.php");
     include ("IDtoLetter.php");
        
     $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
     if ($conn -> connect_error) {
         die("Connection failed:" .$conn -> connect_error);
    }
    //load the session variables 
    session_start();

    $userID = $_SESSION['user'];
    $userIDtoLetters = num2alpha($userID);
    
    session_unset();

    //load all temporary user files created during the session into variables
    $PolyDelete = "{$userIDtoLetters}Polymorphism.java";
    $PolyClassDelete = "{$userIDtoLetters}Polymorphism.class";

    $OCDelete = "{$userIDtoLetters}Car.java";
    $OCClassDelete = "{$userIDtoLetters}Car.class";

    $InterfacesDelete = "{$userIDtoLetters}Interfaces.java";
    $InterfacesClassDelete = "{$userIDtoLetters}Interfaces.class";

    $RandomDelete = "{$userIDtoLetters}Random.java";
    $RandomClassDelete = "{$userIDtoLetters}Random.class";
    //remove the files 
    //delete all the polymorphism lesson files related to the current user
    //delete all the Object and Classes lessons files related to the current user
    //delete all the Interface lesson files related to the current user 
    //delete the randomly generated file for the exercises class
    unlinkFiles($PolyDelete, $PolyClassDelete);
    unlinkFiles($OCDelete, $OCClassDelete);
    unlinkFiles($InterfacesDelete,$InterfacesClassDelete);
    unlinkFiles($RandomDelete, $RandomClassDelete);
    //destroy the user session
    session_destroy();
    //redirect to the login
    header( "Location: login.php" );

?>
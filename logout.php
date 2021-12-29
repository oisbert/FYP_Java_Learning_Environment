<?php
     include ("serverConfig.php");

     function num2alpha($n) {
        $r = '';
        for ($i = 1; $n >= 0 && $i < 10; $i++) {
        $r = chr(0x41 + ($n % pow(26, $i) / pow(26, $i - 1))) . $r;
        $n -= pow(26, $i);
        }
        return $r;
    }
        
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

    if (unlink($PolyDelete)) {
	    echo 'The file ' . $PolyDelete . ' was deleted successfully!';
    } else {
	    echo 'There was a error deleting the file ' . $PolyDelete;
    }

    if (unlink($PolyClassDelete)) {
	    echo 'The file ' . $PolyClassDelete . ' was deleted successfully!';
    } else {
	    echo 'There was a error deleting the file ' . $PolyClassDelete;
    }

    session_destroy();

    header( "Location: login.php" );

?>
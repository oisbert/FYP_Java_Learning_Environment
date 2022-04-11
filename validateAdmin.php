<?php
    //session to identify an admin
    session_start();

    if (!(isset($_SESSION["admin"])) || $_SESSION["admin"] == false) {
        header( "Location: login.php" );
    } 

?>
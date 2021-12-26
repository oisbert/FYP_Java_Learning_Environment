<?php
    session_start();

    if (!(isset($_SESSION["admin"])) || $_SESSION["admin"] == false) {
        header( "Location: login.php" );
    } 

?>
<?php
    include ("validateLoggedIn.php");
    $_SESSION['user'] = $userID;
    function num2alpha($n) {
       $r = '';
       for ($i = 1; $n >= 0 && $i < 10; $i++) {
       $r = chr(0x41 + ($n % pow(26, $i) / pow(26, $i - 1))) . $r;
       $n -= pow(26, $i);
       }
       return $r;
   }

   $userIDtoLetters = num2alpha($userID);

    $comment = $_POST["comment-editor"];
    $file = "{$userIDtoLetters}Polymorphism.java";
    file_put_contents($file,$comment);
    header('Location: polymorphism.php');
?>
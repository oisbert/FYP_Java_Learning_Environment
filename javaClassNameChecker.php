<?php
//this is a function used in the autograder to check if the letter of a java file is set to a capital letter
function checkCap($string)
{
    $result = preg_split('/class/', $string); //look for the word class get the string after it
    if (count($result) > 1) //if it is found
    {
        $result_split = explode(' ', $result[1]); //get the first letter in the string

        $answer = $result_split[1];
        if (preg_match('~^\p{Lu}~u', $answer)) //if the word starts with a capital letter return true
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>
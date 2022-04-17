<?php


//function to check for static methods in the autograder
function checkForStatic($string)
{
    $result = preg_split('/public/', $string);
    
    $foundNonStatic = 0;
    if (count($result) > 1)
    {
        $result_split = explode(' ', $result[1]);
        //if the word afer public is static
        $answer = $result_split[1];
        if ($answer == 'static' || $answer == 'class'){ //do nothing   
        }
        else
        {
            //else add 1 to found non static
            $foundNonStatic++;
            return false;
        }
    }

    if($foundNonStatic > 0){
        return false;
    }
    else{
        return true;
    }
    
}



?>
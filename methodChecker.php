<?php



function checkForStatic($string)
{
    $result = preg_split('/public/', $string);
    
    //$answerCheck = 0;
    //$foundStatic = 0;
    $foundNonStatic = 0;
    if (count($result) > 1)
    {
        $result_split = explode(' ', $result[1]);

        $answer = $result_split[1];
        if ($answer == 'static' || $answer == 'class')
        {
            //do nothing   
        }
        else
        {
            //echo "\"{$answer}\" no static method found. ";
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
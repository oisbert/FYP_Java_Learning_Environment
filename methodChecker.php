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
        if ($answer == 'static')
        {
            //echo "\"{$answer}\" correct static method found";
            //return true;
            
        }
        else if ($answer == 'class'){
            //echo "\"{$answer}\" no change public class method found not a method";
            //return true;
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
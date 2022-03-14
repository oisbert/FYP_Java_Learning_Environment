<?php 


function checkMethodName($fileOpen){
    $private = "private";
    $public = "public";
    //$publicClass = "public class";
    $count = 0;
    $holder = fopen($fileOpen,"r");
    while(!feof($holder)) {
        $line = fgets($holder);
        if(strpos($line, $public) !== false || strpos($line, $private) !== false){
            $result = preg_split('/public/', $line);
            $result_split = explode(' ', $result[1]);
            $answer = $result_split[1];
            if ($answer == 'class')
            {
            //echo "\"{$answer}\" correct static method found";
            //return true;
            
            }
            else{
                $first = strtok($line, '(');

                $pieces = explode(' ', $first);
                $last_word = array_pop($pieces);

                if (preg_match('~^\p{Ll}~u', $last_word))
                {
                    //null
                }
                else
                {
                    $count++;
                }
            } 
        }
    }
    if ($count > 0){
        return false;
    }
    else{
        return true;
    }
    fclose($fileOpen);
}

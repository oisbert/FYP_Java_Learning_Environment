<?php 


function checkMethodName($fileOpen){
    $private = "private";
    $public = "public";
    $publicClass = "public class";
    $file = fopen("taskUploads/Staticpolymorphism/2/{$fileOpen}", "r");
    $count = 0;
    while(!feof($file)) {
        $line = fgets($file);
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
                //echo $first;

                $pieces = explode(' ', $first);
                $last_word = array_pop($pieces);
                //echo $last_word;
                //echo " ";
                if (preg_match('~^\p{Ll}~u', $last_word))
                {
                 //echo "<br>\"{$last_word}\" starts with lower correct<br>";
            //return true;
                }
                else
                {
                    $count++;
                }
            } 
        }
    }
    if ($count > 0){
        //echo "false";
        return false;
    }
    else{
        //echo "true";
        return true;
    }
    fclose($file);
}
?> 
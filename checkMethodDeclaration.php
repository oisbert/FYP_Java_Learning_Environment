<?php 
/*
    function for test 3 in the autograder checks
    checks if the method name is declared with a lower case
*/
function checkMethodName($fileOpen,$filename){
    $private = "private";
    $public = "public";
    $x = pathinfo($filename, PATHINFO_FILENAME);
    //set count to 0 
    $count = 0;
    //open the file and store the contents in holder
    $holder = fopen($fileOpen,"r");
    //while its not the end of the file
    while(!feof($holder)) {
        //get each line of the file
        $line = fgets($holder);

        //if the line does contain public or private do the following..
        if(strpos($line, $public) !== false || strpos($line, $private) !== false){
            //make an array of substrings starting with the word public
            $result = preg_split('/public/', $line);

            if(isset($result[1])){
            //get the next word in the line after public
            $result_split = explode(' ', $result[1]);
            $answer = $result_split[1];
            //if the word is not class do the following
            if ($answer != 'class')
            {
                //get the last word iun the line before "("
                $first = strtok($line, '(');

                $pieces = explode(' ', $first);
                $last_word = array_pop($pieces);
                //if the word found does not start with a captital add 1 to the counter
                if (preg_match('~^\p{Ll}~u', $last_word) == 0)
                {
                    //if the word is the same as the class file ignore..this is a constructor
                    if($last_word == $x){

                    }else{
                    $count++;
                    }
                }
            
            } 
        }
    }
    }
    //if the counter is greater than 0 return false
    if ($count > 0){
        return false;
    }
    //else return true 
    else{
        return true;
    }
    //close the file that was opened
    fclose($fileOpen);
}

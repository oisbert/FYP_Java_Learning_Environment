<?php

$myfile = fopen("Staticpolymorphism.java", "r") or die("Unable to open file!");
$data = file_get_contents("Staticpolymorphism.java");



function checkForStatic($string)
{
    $result = preg_split('/public/', $string);
    
    $answerCheck = 0;

    if (count($result) > 1)
    {
        $result_split = explode(' ', $result[1]);

        $answer = $result_split[1];
        if ($answer == 'static')
        {
            echo "\"{$answer}\" correct static method found";
            
        }
        else if ($answer == 'class'){
            echo "\"{$answer}\" no change public class method found not a method";
        }
        else
        {
            echo "\"{$answer}\" no static method found. ";
            $answerCheck = 1;
        }
    }

    if ($answerCheck == 1){
        echo "issue in file";
    }
    else {
        echo " ";
    }
}


$lines = explode("\n", $data);

foreach($lines as $word) {
    echo checkForStatic($word) . "<br/>\n";
 
   
}
fclose($myfile);
?>
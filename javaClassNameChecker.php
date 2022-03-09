<?php
function checkCap($string)
{
    $result = preg_split('/class/', $string);
    if (count($result) > 1)
    {
        $result_split = explode(' ', $result[1]);

        $answer = $result_split[1];
        if (preg_match('~^\p{Lu}~u', $answer))
        {
            //echo "<br>\"{$answer}\" starts with uppercase correct<br>";
            return true;
        }
        else
        {
            //echo "\"{$answer}\" must start with an uppercase<br><br>";
            return false;
        }
    }
}

?>
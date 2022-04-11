
<?php
//This function converts the userID to a letter
//example 1--a,  12--AB, cd--34
function num2alpha($n) {
        $r = '';
        for ($i = 1; $n >= 0 && $i < 10; $i++) {
        $r = chr(0x41 + ($n % pow(26, $i) / pow(26, $i - 1))) . $r;
        $n -= pow(26, $i);
        }
        return $r;
    }
?>
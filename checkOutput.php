<?php

function OutputChecker($file1,$file2, &$FormatCheck, &$outputCheck){
    $file1trim = trim($file1, ".java");
    $file2trim = trim($file2, ".java");

    $file2trim = trim($file2, ".java");
    $output = shell_exec("javac {$file1trim}.java && java {$file1trim}");
     shell_exec("javac {$file1trim}.java > outputchecker.txt 2>&1");
     nl2br(file_get_contents( "outputchecker.txt" ));
    //$data1 = file_get_contents( "outputchecker.txt" );

    $output2 = shell_exec("javac {$file2trim}.java && java {$file2trim}");
     shell_exec("javac {$file2} > outputchecker.txt 2>&1");
     nl2br(file_get_contents( "outputchecker.txt" ));
   // $data2 = file_get_contents( "outputchecker.txt" );

    //remove white spaces
    $outputNoSpace1 = str_replace(' ', '', $output);

    $outputNoSpace2 = str_replace(' ', '', $output2);
    $FormatCheck = 0;
    if($output == $output2){
        //echo "Output format match";
    }
    else{
        //echo "Outputs do not match format as follows <br>";
        //echo "{$output2}<br>";
        //echo "Your output was<br>";
        //echo "{$output}<br>";
        $FormatCheck = 1;
    }

    $outputCheck = 0;
    if($outputNoSpace1 == $outputNoSpace2){
        //echo "Output is correct";
    }
    else{
        //echo "Outputs do not match<br>";
        //echo "{$outputNoSpace2}<br>";
        //echo "Your output was<br>";
        //echo "{$outputNoSpace1}<br>";
        $outputCheck = 1;
    }

    if($FormatCheck > 0){
        print "<H1>Test 4: Failed formatting was incorrect</H1>";
        print "<H3>Your Output: {$output}</H3>";
        print "<H3>Answer Output: {$output2}</H3>";
    }
    else{
        print "<H1>Test 4: Pass Answer format check</H1>";

    }

    if($outputCheck > 0){
        print "<H1>Test 5: Failed output was incorrect</H1>";
        print "<H3>Hint:check for any white spaces</H3>";
    }
    else{
        print "<H1>Test 5: Pass Answer output check</H1>";
        print "<H3>Your Output: {$outputNoSpace1}</H3>";
        print "<H3>Answer Output: {$outputNoSpace2}</H3>";
    }

}

?>
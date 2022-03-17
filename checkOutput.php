<?php

//Function to check the format and output tests 4 and 5 in the auto-grader
function OutputChecker($file1,$file2, &$FormatCheck, &$outputCheck){
    //delete the .java at the end of the files being read in 
    $file1trim = trim($file1, ".java");
    $file2trim = trim($file2, ".java");

    //execute the user file in the server shell and store in output 
    $output = shell_exec("javac {$file1trim}.java && java {$file1trim}");
     shell_exec("javac {$file1trim}.java > outputchecker.txt 2>&1");
     nl2br(file_get_contents( "outputchecker.txt" ));

     //execute the answer file in the server shell at the same time and store in output2 
    $output2 = shell_exec("javac {$file2trim}.java && java {$file2trim}");
     shell_exec("javac {$file2} > outputchecker.txt 2>&1");
     nl2br(file_get_contents( "outputchecker.txt" ));

    //remove white spaces
    $outputNoSpace1 = str_replace(' ', '', $output);

    $outputNoSpace2 = str_replace(' ', '', $output2);
    $FormatCheck = 0;
    if($output != $output2){
        $FormatCheck = 1;
    }

    $outputCheck = 0;
    if($outputNoSpace1 != $outputNoSpace2){
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
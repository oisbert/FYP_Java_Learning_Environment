<?php
//where file 1 is the attempt and file 2 is the answer
function OutputChecker($file1,$file2){
    if (file_exists("{$file1}")){
    $current = file_get_contents($file);
    $output = shell_exec("javac {$file1} && java {$file1}");
    echo shell_exec("javac {$file1}.java > outputchecker.txt 2>&1");
    echo nl2br(file_get_contents( "outputchecker.txt" ));
    $data1 = file_get_contents( "outputchecker.txt" );

    $current2 = file_get_contents("{$file2}");
    $output2 = shell_exec("javac {$file2} && java {$file2}");
    echo shell_exec("javac {$file2} > outputchecker.txt 2>&1");
    echo nl2br(file_get_contents( "outputchecker.txt" ));
    $data2 = file_get_contents( "outputchecker.txt" );

    //remove white spaces
    $outputNoSpace1 = str_replace(' ', '', $output);
    //echo $outputNoSpace1;

    $outputNoSpace2 = str_replace(' ', '', $output2);
    //echo $outputNoSpace2;

    if($output == $output2){
        echo "Output format match";
    }
    else{
        echo "Outputs do not match format as follows <br>";
        echo "{$output2}<br>";
        echo "Your output was<br>";
        echo "{$output}<br>";
        $checker = 1;
    }

    if($outputNoSpace1 == $outputNoSpace2){
        echo "Output is correct";
    }
    else{
        echo "Outputs do not match<br>";
        echo "{$outputNoSpace2}<br>";
        echo "Your output was<br>";
        echo "{$outputNoSpace1}<br>";
    }
}
}
?>
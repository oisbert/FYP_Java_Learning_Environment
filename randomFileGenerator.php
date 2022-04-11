
<?php
    //function to grab a random file from the bank of exercises in the exerciseFolder
    function randomFileGenerator(){
        $files = glob('exerciseFolder' . '/*.*');
    
        $randomExcercise = array_rand($files);
        
        return $files[$randomExcercise];
    }
?>

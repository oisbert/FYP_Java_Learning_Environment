
<?php
    function randomFileGenerator(){
        $files = glob('exerciseFolder' . '/*.*');
    
        $randomExcercise = array_rand($files);

        return $files[$randomExcercise];
    }
?>

<?php
function unlinkFiles($PolyDelete, $PolyClassDelete){
if (unlink($PolyDelete)) {
    //echo 'The file ' . $PolyDelete . ' was deleted successfully!';
} else {
    error_reporting( 0 );
}

if (unlink($PolyClassDelete)) {
    //echo 'The file ' . $PolyClassDelete . ' was deleted successfully!';
} else {
    error_reporting( 0 );
}
}

?>

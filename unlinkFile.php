<?php
//remove files from the server
function unlinkFiles($PolyDelete, $PolyClassDelete){
if (unlink($PolyDelete)) {
} else {
    error_reporting( 0 );
}

if (unlink($PolyClassDelete)) {

} else {
    error_reporting( 0 );
}
}

?>

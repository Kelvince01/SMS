<?php
/*function to remove htmlentities and preventing sql injection*/
function mysqli_entities_fix_string($string){
return htmlentities(mysqli_fix_string($string));
}
function mysqli_fix_string($string){
if(get_magic_quotes_gpc())$string=stipslashes($string);
return mysqli_real_escape_string($string);
}
?>
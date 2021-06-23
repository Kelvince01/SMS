<?php
$output=array();
$command= "C:\\wamp\\bin\\mysql\\mysql5.6.12\\bin\\mysqldump.exe --user root SMS fees_payment >C:\\SMSfees_payment". date("d-m-Y").".sql";
exec($command,$output,$worked);
switch($worked){
case 0:
echo 'Database <b>SMS</b> successfully exported to <b>C:\\SMS</b>';
break;
case 1:
echo 'There was a warning during the export of <b>SMS</b> to <b>C:\\SMS</b>';
break;
case 2:
echo 'There was an error during export.';
break;
}
?>


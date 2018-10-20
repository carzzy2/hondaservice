<?php

error_reporting( error_reporting() & ~E_NOTICE );
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$dbname="hondaservice";
$charset="utf8";
$connect = mysqli_connect($db_server, $db_user, $db_pass, $dbname) or die ("ติดต่อ Host ไม่ได้!!");
if(!$connect->set_charset($charset)) {
   printf("Error loading character set utf8: %sn", $connect->error);
}
$limit=10;
function getMillisecTime() {
    list($t1, $t2) = explode(' ', microtime());
    $mst = str_replace('.', '', $t2 . $t1);

    return $mst;
}
function FormatDay($mydate){
    $d=split("-",$mydate);
    $mydate=$d[2]."/".$d[1]."/".($d[0]+543);
    return "$mydate";
}

?>

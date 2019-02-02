<?php
session_start();
include "config.php";

$sql = "update reservation set rs_status='นำรถเข้ารับบริการแล้ว' where rs_id='" . $_POST['rs_id'] . "'";
$query = mysqli_query($connect, $sql);
if($query){
    $id1 = "Select Max(substr(gc_id,-6))+1 as MaxID from get_car";
    $id2 = mysqli_query($connect, $id1);
    $newid = mysqli_fetch_array($id2);
    if ($newid['MaxID'] == "") {
        $autoid = "GEC000001";
    } else {
        $autoid = "GEC" . sprintf("%06d", $newid['MaxID']);
    }
    $sql = "insert into get_car(gc_id,gc_date,gc_text,cus_id,rs_id,co_id,gc_status) 
            values('" . $autoid . "',NOW(),'" . $_POST['gc_text'] . "','" . $_POST['cus_id'] . "','" . $_POST['rs_id'] . "','" . $_POST['co_id'] . "',0)";
    mysqli_query($connect, $sql);
    echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');</script>";
}else{
    echo "<script>alert('ผิดพลาด ! มีบางอย่างเกิดขึ้นกับระบบ');</script>";
}
echo "<META http-equiv='refresh' Content='0; URL=get_car_list.php'> ";




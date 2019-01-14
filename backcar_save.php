<?php
session_start();
include "config.php";

$id1 = "Select Max(substr(bc_id,-6))+1 as MaxID from backcar";
$id2 = mysqli_query($connect, $id1);
$newid = mysqli_fetch_array($id2);
if ($newid['MaxID'] == "") {
    $autoid = "BAC000001";
} else {
    $autoid = "BAC" . sprintf("%06d", $newid['MaxID']);
}
$sqlpay = "select * from repair where re_id='" . $_GET['id'] . "'";
$querypay= mysqli_query($connect, $sqlpay);
$arraypay = mysqli_fetch_array($querypay);

$sql = "insert into backcar(bc_id,bc_date,emp_id,gc_id,rs_id,re_id)
        values('" . $autoid . "',NOW(),'" . $_SESSION['ss_emp_id'] . "','" . $arraypay['gc_id'] . "','" . $arraypay['rs_id'] . "','" . $arraypay['re_id'] . "')";
$query = mysqli_query($connect, $sql);
if ($query) {
    $sql2 = "update reservation set rs_status='รับรถแล้ว' where rs_id='" .$arraypay['rs_id']. "'";
    mysqli_query($connect, $sql2);

    $sql3 = "update get_car set gc_status =4 where gc_id='" . $arraypay['gc_id'] . "'";
    mysqli_query($connect, $sql3);

    echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=backcar_show.php?'> ";
} else {
    echo "<script>alert('ผิดพลาด ! มีบางอย่างเกิดขึ้นกับระบบ');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=backcar_show.php'> ";
    exit();
}
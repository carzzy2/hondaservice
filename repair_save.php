<?php
session_start();
include "config.php";

$id1 = "Select Max(substr(re_id,-6))+1 as MaxID from repair";
$id2 = mysqli_query($connect, $id1);
$newid = mysqli_fetch_array($id2);
if ($newid['MaxID'] == "") {
    $autoid = "REP000001";
} else {
    $autoid = "REP" . sprintf("%06d", $newid['MaxID']);
}
$sql = "insert into repair(re_id,re_date,emp_id,re_total,gc_id,rs_id) 
    values('" . $autoid . "',NOW(),'" . $_SESSION['ss_emp_id'] . "','" . $_POST['re_total'] . "','" . $_POST['gc_id'] . "','" . $_POST['rs_id'] . "')";
$query = mysqli_query($connect, $sql);
if ($query) {
    if(count($_SESSION['ss_ch_id'])> 0){
        foreach ($_SESSION['ss_ch_id'] as $key => $val) {

            $sqlch = "select * from checklist where ch_id='" . $_SESSION['ss_ch_id'][$key] . "'";
            $querych= mysqli_query($connect, $sqlch);
            $arraych = mysqli_fetch_array($querych);

            $sql_list1 = "insert into repair_checklist(re_id,ch_id,re_price)
                     values('" . $autoid . "','" . $_SESSION['ss_ch_id'][$key] . "','" . $arraych['ch_price'] . "')";
            $query_list1 = mysqli_query($connect, $sql_list1);
        }
    }
    if(count($_SESSION['ss_sp_id'])> 0) {
        foreach ($_SESSION['ss_sp_id'] as $key => $val) {

            $sqlsd = "select * from spareparts where sp_id='" . $_SESSION['ss_sp_id'][$key] . "'";
            $querysd = mysqli_query($connect, $sqlsd);
            $arraysd = mysqli_fetch_array($querysd);

            $sql_list1 = "insert into repair_spareparts(re_id,sp_id,re_num,re_price)
                     values('" . $autoid . "','" . $_SESSION['ss_sp_id'][$key] . "','" . $_SESSION['ss_sp_num'][$key] . "','" . $arraysd['sp_price'] . "')";
            $query_list1 = mysqli_query($connect, $sql_list1);

            $sql2 = "update spareparts set sp_num =sp_num-'" . $_SESSION['ss_sp_num'][$key] . "' where sp_id='" . $_SESSION['ss_sp_id'][$key] . "'";
            mysqli_query($connect, $sql2);
        }
    }
    $sql3 = "update get_car set gc_status =2 where gc_id='" . $_POST['gc_id'] . "'";
    mysqli_query($connect, $sql3);

    $sql4 = "update reservation set rs_status ='ซ่อมรถเสร็จแล้ว' where rs_id='" . $_POST['rs_id'] . "'";
    mysqli_query($connect, $sql4);
} else {
    echo "<script>alert('ผิดพลาด ! มีบางอย่างเกิดขึ้นกับระบบ');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=repair_show.php'> ";
    exit();
}
unset($_SESSION['ss_sp_id']);
unset($_SESSION['ss_sp_num']);
unset($_SESSION['ss_ch_id']);
echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
echo "<META http-equiv='refresh' Content='0; URL=repair_show.php'> ";


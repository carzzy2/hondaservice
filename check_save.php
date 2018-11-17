<?php
session_start();
include "config.php";

if($_POST['mode']=="add"){
    $sql = "insert into checklist(ch_id,ch_list,ch_price) values('" . $_POST['ch_id'] . "','" . $_POST['ch_list'] . "','" . $_POST['ch_price'] . "')";
    mysqli_query($connect, $sql);
    echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');</script>";
}elseif($_POST['mode']=="edit"){
    $sql = "update checklist set ch_list='" . $_POST['ch_list'] . "',ch_price='" . $_POST['ch_price'] . "' 
            where ch_id='" . $_POST['ch_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){

    $sql_id1 = "select * from repair_checklist where ch_id='".$_GET['id']."'";
    $query_id1 = mysqli_query($connect, $sql_id1);
    $num1 = mysqli_num_rows($query_id1);

    if($num1 >=1){
        echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลนี่ถูกใช้แล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=check_list.php'> ";
        exit();
    }

    $sql = "delete from checklist where ch_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
}
echo "<meta http-equiv='refresh' content='0;URL=check_list.php'>";
?>

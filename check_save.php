<?php
session_start();
include "config.php";

if($_POST['mode']=="add"){
    $sql = "insert into checklist(ch_id,ch_list,ch_price) values('" . $_POST['ch_id'] . "','" . $_POST['ch_list'] . "','" . $_POST['ch_price'] . "')";
    mysqli_query($connect, $sql);
}elseif($_POST['mode']=="edit"){
    $sql = "update checklist set ch_list='" . $_POST['ch_list'] . "',ch_price='" . $_POST['ch_price'] . "' 
            where ch_id='" . $_POST['ch_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){
    $sql = "delete from checklist where ch_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
}
echo "<meta http-equiv='refresh' content='0;URL=check_list.php'>";
?>

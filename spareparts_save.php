<?php
session_start();
include "config.php";

if($_POST['mode']=="add"){
    $sql = "insert into spareparts(sp_id,sp_name,sp_description,sp_price,sp_num) 
            values('" . $_POST['sp_id'] . "','" . $_POST['sp_name'] . "','" . $_POST['sp_description'] . "','" . $_POST['sp_price'] . "',0)";
    mysqli_query($connect, $sql);
}elseif($_POST['mode']=="edit"){
    $sql = "update spareparts set sp_name='" . $_POST['sp_name'] . "',sp_description='" . $_POST['sp_description'] . "' ,sp_price='" . $_POST['sp_price'] . "' 
            where sp_id='" . $_POST['sp_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){
    $sql = "delete from spareparts where sp_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
}
echo "<meta http-equiv='refresh' content='0;URL=spareparts_list.php'>";
?>

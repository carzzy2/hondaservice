<?php
session_start();
include "config.php";

if($_POST['mode']=="add"){
    $sql = "insert into spareparts(sp_id,sp_name,sp_description,sp_price,sp_num) 
            values('" . $_POST['sp_id'] . "','" . $_POST['sp_name'] . "','" . $_POST['sp_description'] . "','" . $_POST['sp_price'] . "',0)";
    mysqli_query($connect, $sql);
    echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');</script>";
}elseif($_POST['mode']=="edit"){
    $sql = "update spareparts set sp_name='" . $_POST['sp_name'] . "',sp_description='" . $_POST['sp_description'] . "' ,sp_price='" . $_POST['sp_price'] . "' 
            where sp_id='" . $_POST['sp_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){

    $sql_id1 = "select * from purchase_order_list where sp_id='".$_GET['id']."'";
    $query_id1 = mysqli_query($connect, $sql_id1);
    $num1 = mysqli_num_rows($query_id1);

    $sql_id2 = "select * from repair_spareparts where sp_id='".$_GET['id']."'";
    $query_id2 = mysqli_query($connect, $sql_id2);
    $num2 = mysqli_num_rows($query_id2);

    if($num1 >=1 or $num2 >=1){
        echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลนี่ถูกใช้แล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=spareparts_list.php'> ";
        exit();
    }

    $sql = "delete from spareparts where sp_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
}
echo "<meta http-equiv='refresh' content='0;URL=spareparts_list.php'>";
?>

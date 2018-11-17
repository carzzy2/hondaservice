<?php
session_start();
include "config.php";

if($_POST['mode']=="add"){
    $sql = "insert into carorder(co_id,co_carmodel,co_description) values('" . $_POST['co_id'] . "','" . $_POST['co_carmodel'] . "','" . $_POST['co_description'] . "')";
    mysqli_query($connect, $sql);
    echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');</script>";
}elseif($_POST['mode']=="edit"){
    $sql = "update carorder set co_carmodel='" . $_POST['co_carmodel'] . "',co_description='" . $_POST['co_description'] . "' 
            where co_id='" . $_POST['co_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){
    $sql_id1 = "select * from customer where co_id='".$_GET['id']."'";
    $query_id1 = mysqli_query($connect, $sql_id1);
    $num1 = mysqli_num_rows($query_id1);

    $sql_id2 = "select * from get_car where co_id='".$_GET['id']."'";
    $query_id2 = mysqli_query($connect, $sql_id2);
    $num2 = mysqli_num_rows($query_id2);

    if($num1 >=1 or $num2 >=1){
        echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลนี่ถูกใช้แล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=car_list.php'> ";
        exit();
    }

    $sql = "delete from carorder where co_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
}
echo "<meta http-equiv='refresh' content='0;URL=car_list.php'>";
?>

<?php
session_start();
include "config.php";

if($_POST['mode']=="add"){
    $sql = "insert into carorder(co_id,co_carmodel,co_description) values('" . $_POST['co_id'] . "','" . $_POST['co_carmodel'] . "','" . $_POST['co_description'] . "')";
    mysqli_query($connect, $sql);
}elseif($_POST['mode']=="edit"){
    $sql = "update carorder set co_carmodel='" . $_POST['co_carmodel'] . "',co_description='" . $_POST['co_description'] . "' 
            where co_id='" . $_POST['co_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){
    $sql = "delete from carorder where co_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
}
echo "<meta http-equiv='refresh' content='0;URL=car_list.php'>";
?>

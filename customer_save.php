<?php
session_start();
include "config.php";

if($_POST['mode']=="add"){
    $sqlck="select * from customer where cus_user ='" . $_POST['cus_user'] . "'";
    $queryck = mysqli_query($connect, $sqlck);
    $numck = mysqli_num_rows($queryck);
    if($numck>0){
        echo "<script>alert('username นี่มีอยุ่แล้วในระบบ');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=customer_list.php'>";
        exit();
    }
    $sql = "insert into customer(cus_id,cus_name,cus_add,cus_tel,cus_user,cus_pass,co_id) 
            values('" . $_POST['cus_id'] . "','" . $_POST['cus_name'] . "','" . $_POST['cus_add'] . "',
            '" . $_POST['cus_tel'] . "','" . $_POST['cus_user'] . "','" . $_POST['cus_pass'] . "','" . $_POST['co_id'] . "')";
    mysqli_query($connect, $sql);
    echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');</script>";
}elseif($_POST['mode']=="edit"){
    $sql = "update customer set cus_name='" . $_POST['cus_name'] . "',cus_add='" . $_POST['cus_add'] . "',
            cus_tel='" . $_POST['cus_tel'] . "',cus_user='" . $_POST['cus_user'] . "',cus_pass='" . $_POST['cus_pass'] . "',co_id='" . $_POST['co_id'] . "'
            where cus_id='" . $_POST['cus_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){

    $sql_id1 = "select * from reservation where cus_id='".$_GET['id']."'";
    $query_id1 = mysqli_query($connect, $sql_id1);
    $num1 = mysqli_num_rows($query_id1);

    $sql_id2 = "select * from get_car where cus_id='".$_GET['id']."'";
    $query_id2 = mysqli_query($connect, $sql_id2);
    $num2 = mysqli_num_rows($query_id2);

    if($num1 >=1 or $num2 >=1){
        echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลนี่ถูกใช้แล้ว');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=customer_list.php'> ";
        exit();
    }

    $sql = "delete from customer where cus_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
}
echo "<meta http-equiv='refresh' content='0;URL=customer_list.php'>";
?>

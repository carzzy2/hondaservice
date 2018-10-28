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
}elseif($_POST['mode']=="edit"){
    $sql = "update customer set cus_name='" . $_POST['cus_name'] . "',cus_add='" . $_POST['cus_add'] . "',
            cus_tel='" . $_POST['cus_tel'] . "',cus_user='" . $_POST['cus_user'] . "',cus_pass='" . $_POST['cus_pass'] . "',co_id='" . $_POST['co_id'] . "'
            where cus_id='" . $_POST['cus_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){
    $sql = "delete from customer where cus_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
}
echo "<meta http-equiv='refresh' content='0;URL=customer_list.php'>";
?>

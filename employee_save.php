<?php
session_start();
include "config.php";

if($_POST['mode']=="add"){
    $sqlck="select * from employee where emp_user ='" . $_POST['emp_user'] . "'";
    $queryck = mysqli_query($connect, $sqlck);
    $numck = mysqli_num_rows($queryck);
    if($numck>0){
        echo "<script>alert('username นี่มีอยุ่แล้วในระบบ');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=employee_list.php'>";
        exit();
    }
    $sql = "insert into employee(emp_id,emp_name,emp_add,emp_tel,emp_user,emp_pass) 
            values('" . $_POST['emp_id'] . "','" . $_POST['emp_name'] . "','" . $_POST['emp_add'] . "',
            '" . $_POST['emp_tel'] . "','" . $_POST['emp_user'] . "','" . $_POST['emp_pass'] . "')";
    mysqli_query($connect, $sql);
}elseif($_POST['mode']=="edit"){
    $sql = "update employee set emp_name='" . $_POST['emp_name'] . "',emp_add='" . $_POST['emp_add'] . "',
            emp_tel='" . $_POST['emp_tel'] . "',emp_user='" . $_POST['emp_user'] . "',emp_pass='" . $_POST['emp_pass'] . "'
            where emp_id='" . $_POST['emp_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){
    $sqlck="select * from employee where emp_position ='0' ";
    $queryck = mysqli_query($connect, $sqlck);
    $numck = mysqli_num_rows($queryck);
    if($numck <= 1){
        echo "<script>alert('ไม่สามารถลบได้');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=employee_list.php'>";
        exit();
    }
    $sql = "delete from employee where emp_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
}
echo "<meta http-equiv='refresh' content='0;URL=employee_list.php'>";
?>

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
    $sql = "insert into employee(emp_id,emp_name,emp_add,emp_tel,emp_user,emp_pass,emp_position) 
            values('" . $_POST['emp_id'] . "','" . $_POST['emp_name'] . "','" . $_POST['emp_add'] . "',
            '" . $_POST['emp_tel'] . "','" . $_POST['emp_user'] . "','" . $_POST['emp_pass'] . "','" . $_POST['emp_position'] . "')";
    mysqli_query($connect, $sql);
    echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');</script>";
}elseif($_POST['mode']=="edit"){
    $sql = "update employee set emp_name='" . $_POST['emp_name'] . "',emp_add='" . $_POST['emp_add'] . "',
            emp_tel='" . $_POST['emp_tel'] . "',emp_user='" . $_POST['emp_user'] . "',emp_pass='" . $_POST['emp_pass'] . "' ,emp_position='" . $_POST['emp_position'] . "'
            where emp_id='" . $_POST['emp_id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');</script>";
}elseif($_GET['mode']=="delete"){
    $sql1="select * from employee where emp_id='" . $_GET['id'] . "' ";
    $query1= mysqli_query($connect, $sql1);
    $array = mysqli_fetch_array($query1);
    if($array['emp_position']='1'){
        $sql_id1 = "select * from purchase_order where emp_id='".$_GET['id']."'";
        $query_id1 = mysqli_query($connect, $sql_id1);
        $num1 = mysqli_num_rows($query_id1);

        $sql_id2 = "select * from repair where emp_id='".$_GET['id']."'";
        $query_id2 = mysqli_query($connect, $sql_id2);
        $num2 = mysqli_num_rows($query_id2);

        if($num1 >=1 or $num2 >=1){
            echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลนี่ถูกใช้แล้ว');</script>";
            echo "<META http-equiv='refresh' Content='0; URL=employee_list.php'> ";
            exit();
        }

        $sql = "delete from employee where emp_id='" . $_GET['id'] . "'";
        mysqli_query($connect, $sql);
    }else{
        $sqlck="select * from employee where emp_position ='0' ";
        $queryck = mysqli_query($connect, $sqlck);
        $numck = mysqli_num_rows($queryck);
        if($numck <= 1){
            echo "<script>alert('ไม่สามารถลบได้');</script>";
            echo "<meta http-equiv='refresh' content='0;URL=employee_list.php'>";
            exit();
        }

        $sql_id1 = "select * from purchase_order where emp_id='".$_GET['id']."'";
        $query_id1 = mysqli_query($connect, $sql_id1);
        $num1 = mysqli_num_rows($query_id1);

        $sql_id2 = "select * from repair where emp_id='".$_GET['id']."'";
        $query_id2 = mysqli_query($connect, $sql_id2);
        $num2 = mysqli_num_rows($query_id2);

        if($num1 >=1 or $num2 >=1){
            echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากข้อมูลนี่ถูกใช้แล้ว');</script>";
            echo "<META http-equiv='refresh' Content='0; URL=employee_list.php'> ";
            exit();
        }

        $sql = "delete from employee where emp_id='" . $_GET['id'] . "'";
        mysqli_query($connect, $sql);
        echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
    }
}
echo "<meta http-equiv='refresh' content='0;URL=employee_list.php'>";
?>

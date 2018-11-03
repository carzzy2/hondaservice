<?php
session_start();
include "config.php";
if ($_GET['mode'] == 'add') {
    $id1 = "Select Max(substr(po_id,-6))+1 as MaxID from purchase_order";
    $id2 = mysqli_query($connect, $id1);
    $newid = mysqli_fetch_array($id2);
    if ($newid['MaxID'] == "") {
        $autoid = "POR000001";
    } else {
        $autoid = "POR" . sprintf("%06d", $newid['MaxID']);
    }
    $sql = "insert into purchase_order(po_id,po_date,po_agent,po_address,po_tel,po_total,emp_id,po_status) 
        values('" . $autoid . "',NOW(),'" . $_POST['po_agent'] . "','" . $_POST['po_address'] . "','" . $_POST['po_tel'] . "','" . $_POST['po_total'] . "','" . $_SESSION['ss_emp_id'] . "',0)";
    $query = mysqli_query($connect, $sql);
    if ($query) {
        foreach ($_SESSION['ss_sp_id'] as $key => $val) {

            $sqlsd = "select * from spareparts where sp_id='" . $_SESSION['ss_sp_id'][$key] . "'";
            $querysd= mysqli_query($connect, $sqlsd);
            $arraysd = mysqli_fetch_array($querysd);

            $sql_list = "insert into purchase_order_list(po_id,sp_id,po_num,po_price) 
                         values('" . $autoid . "','" . $_SESSION['ss_sp_id'][$key] . "','" . $_SESSION['ss_sp_num'][$key] . "','" . $arraysd['sp_price'] . "')";
            $query_list = mysqli_query($connect, $sql_list);
        }
    } else {
        echo "<script>alert('ผิดพลาด ! มีบางอย่างเกิดขึ้นกับระบบ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=purchase_show.php'> ";
        exit();
    }
    unset($_SESSION['ss_sp_id']);
    unset($_SESSION['ss_sp_num']);
    echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=purchase_show.php'> ";
} elseif ($_GET['mode'] == "delete") {
    $sql = "delete from purchase_order where po_id='" . $_GET['id'] . "'";
    $query = mysqli_query($connect, $sql);
    $sql2 = "delete from purchase_order_list where po_id='" . $_GET['id'] . "'";
    $query2 = mysqli_query($connect, $sql2);
    echo "<META http-equiv='refresh' Content='0; URL=purchase_show.php'> ";
}

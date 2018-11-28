<?php
session_start();
include "config.php";
if ($_GET['mode'] == 'add') {
    $sql = "update reservation set rs_status='ยืนยันการจองแล้ว' where rs_id='" . $_GET['id'] . "'";
    mysqli_query($connect, $sql);
    echo "<script>alert('ยืนยันการจองแล้ว');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=reservation_list.php'> ";
} elseif ($_GET['mode'] == "delete") {
    $sql = "update reservation set rs_status='ยกเลิกการจองแล้ว' where rs_id='" . $_GET['id'] . "'";
    $query = mysqli_query($connect, $sql);
    echo "<script>alert('ยกเลิกการจองเรียบร้อย');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=reservation_list.php'> ";
}

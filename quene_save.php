<?php
session_start();
include "config.php";

$sql = "update get_car set gc_status='1' where gc_id='" . $_GET['id'] . "'";
mysqli_query($connect, $sql);

echo "<script>alert('เข้าคิวเรียบร้อย');</script>";
echo "<META http-equiv='refresh' Content='0; URL=quene_list.php'> ";




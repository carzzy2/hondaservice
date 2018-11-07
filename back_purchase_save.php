<?php
session_start();
include "config.php";

$sql = "update purchase_order set po_status='1' where po_id='" . $_POST['po_id'] . "'";
$query = mysqli_query($connect, $sql);
if ($query) {
    $sql1 = "select * from purchase_order_list where po_id='" . $_POST['po_id'] . "'";
    $query1= mysqli_query($connect, $sql1);
    $array1 = mysqli_fetch_array($query1);

    while ($array1 = mysqli_fetch_array($query1)) {
        $sql2 = "update spareparts set sp_num =sp_num+'" . $array1['po_num'] . "' where sp_id='" . $array1['sp_id'] . "'";
        mysqli_query($connect, $sql2);
    }
    echo "<script>alert('รับอะไหล่เรียบร้อย');</script>";
} else {
    echo "<script>alert('ผิดพลาด ! มีบางอย่างเกิดขึ้นกับระบบ');</script>";
    echo "<META http-equiv='refresh' Content='0; URL=purchase_show.php'> ";
    exit();
}
echo "<meta http-equiv='refresh' content='0;URL=back_purchase_list.php'>";
?>

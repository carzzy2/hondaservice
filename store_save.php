<?php
session_start();
include "config.php";

$sql = "update store set sto_name='" . $_POST['sto_name'] . "',sto_tel='" . $_POST['sto_tel'] . "'"
    . ",sto_add='" . $_POST['sto_add'] . "',sto_description='" . $_POST['sto_description'] . "' "
    . "where sto_id='STO000001'";
mysqli_query($connect, $sql);

echo "<meta http-equiv='refresh' content='0;URL=store.php'>";
?>

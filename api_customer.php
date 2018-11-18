<?php
session_start();
include "config.php";

$id1 = "Select Max(substr(cus_id,-6))+1 as MaxID from customer";
$id2 = mysqli_query($connect, $id1);
$newid = mysqli_fetch_array($id2);
if ($newid['MaxID'] == "") {
    $autoid = "CUS000001";
} else {
    $autoid = "CUS" . sprintf("%06d", $newid['MaxID']);
}
echo json_encode($autoid);
?>

<?php
session_start();

include "config.php";
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select * from employee where emp_user='".$username."' and emp_pass='".$password."' ";
$query = mysqli_query($connect, $sql);
$row = mysqli_num_rows($query);
if ($row == 0) {
   echo "<script>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
   echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
} else {
    $data = mysqli_fetch_array($query);
    $_SESSION['ss_login'] = session_id();
    $_SESSION['ss_emp_id'] = $data['emp_id'];
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
}
?>

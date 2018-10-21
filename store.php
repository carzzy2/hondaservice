<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
$sql = "select * from store ";
$query = mysqli_query($connect, $sql);
$array = mysqli_fetch_array($query);
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>ข้อมูลร้าน</h4>
        <a data-toggle="tooltip" href="store_edit.php" class="btn btn-default btn-custon-rounded-two" data-original-title="แก้ไขข้อมูล"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข</a>
        <div class="clearfix"></div><br>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td scope="row">ชื่อร้าน</td>
                    <td><?=$array['sto_name']?></td>
                </tr>
                <tr>
                    <td scope="row">ที่อยู่</td>
                    <td><?=$array['sto_add']?></td>
                </tr>
                <tr>
                    <td scope="row">เบอร์โทรศัพท์</td>
                    <td><?=$array['sto_tel']?></td>
                </tr>
                <tr>
                    <td >Detail</td>
                    <td><?=$array['sto_description']?></td>
                </tr>
                <tr>
                    <td scope="row"></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
if ($_GET['mode'] == "") {
    $headtext="เพิ่ม";
    $mode = "add";
    $id1 = "Select Max(substr(ch_id,-6))+1 as MaxID from checklist";
    $id2 = mysqli_query($connect, $id1);
    $newid = mysqli_fetch_array($id2);
    if ($newid['MaxID'] == "") {
        $autoid = "CHK000001";
    } else {
        $autoid = "CHK" . sprintf("%06d", $newid['MaxID']);
    }
} else {
    $headtext="แก้ไข";
    $mode = "edit";
    $sql = "select * from checklist where ch_id='".$_GET['id']."'";
    $query = mysqli_query($connect, $sql);
    $array = mysqli_fetch_array($query);
    $autoid=$array['ch_id'];
}
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1><?=$headtext?>ข้อมูลรายการตรวจเช็ค</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form action="check_save.php" method="POST">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รหัสตรวจเช็ค</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="hidden" name="mode" value="<?=$mode?>">
                                                        <input type="text" value="<?=$autoid?>" name="ch_id" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รายการตรวจเช็ค</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['ch_list']?>" name="ch_list" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">ราคา</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="number" value="<?=$array['ch_price']?>" name="ch_price" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left">
                                                                <a class="btn btn-white" href="check_list.php">ยกเลิก</a>
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">บันทึก</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

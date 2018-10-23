<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
if ($_GET['mode'] == "") {
    $headtext="เพิ่ม";
    $mode = "add";
    $id1 = "Select Max(substr(co_id,-6))+1 as MaxID from carorder";
    $id2 = mysqli_query($connect, $id1);
    $newid = mysqli_fetch_array($id2);
    if ($newid['MaxID'] == "") {
        $autoid = "CAR000001";
    } else {
        $autoid = "CAR" . sprintf("%06d", $newid['MaxID']);
    }
} else {
    $headtext="แก้ไข";
    $mode = "edit";
    $sql = "select * from carorder where co_id='".$_GET['id']."'";
    $query = mysqli_query($connect, $sql);
    $array = mysqli_fetch_array($query);
    $autoid=$array['co_id'];
}
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1><?=$headtext?>ข้อมูลรถ</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form action="car_save.php" method="POST">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รหัสรถ</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="hidden" name="mode" value="<?=$mode?>">
                                                        <input type="text" value="<?=$autoid?>" name="co_id" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">ชื่อรุ่น</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['co_carmodel']?>" name="co_carmodel" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รายละเอียด</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea name="co_description" class="form-control"><?=$array['co_description']?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left">
                                                                <a class="btn btn-white" href="car_list.php">ยกเลิก</a>
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

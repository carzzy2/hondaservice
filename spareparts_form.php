<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
if ($_GET['mode'] == "") {
    $headtext="เพิ่ม";
    $mode = "add";
    $id1 = "Select Max(substr(sp_id,-6))+1 as MaxID from spareparts";
    $id2 = mysqli_query($connect, $id1);
    $newid = mysqli_fetch_array($id2);
    if ($newid['MaxID'] == "") {
        $autoid = "SPR000001";
    } else {
        $autoid = "SPR" . sprintf("%06d", $newid['MaxID']);
    }
} else {
    $headtext="แก้ไข";
    $mode = "edit";
    $sql = "select * from spareparts where sp_id='".$_GET['id']."'";
    $query = mysqli_query($connect, $sql);
    $array = mysqli_fetch_array($query);
    $autoid=$array['sp_id'];
}
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1><?=$headtext?>ข้อมูลอะไหล่</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form action="spareparts_save.php" method="POST">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รหัสอะไหล่</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="hidden" name="mode" value="<?=$mode?>">
                                                        <input type="text" value="<?=$autoid?>" name="sp_id" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">ชื่ออะไหล่<span style="color: red;">*</span></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['sp_name']?>" name="sp_name" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">ราคา<span style="color: red;">*</span></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="number" value="<?=$array['sp_price']?>" name="sp_price" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รายละเอียด</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea name="sp_description" class="form-control"><?=$array['sp_description']?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left">
                                                                <a class="btn btn-white" href="spareparts_list.php">ยกเลิก</a>
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

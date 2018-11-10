<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
$sql = "select * from reservation where rs_id='".$_GET['id']."'";
$query = mysqli_query($connect, $sql);
$array = mysqli_fetch_array($query);
$autoid=$array['rs_id'];

$sql2= "select * from customer where cus_id='" . $array['cus_id'] . "'";
$query2 = mysqli_query($connect, $sql2);
$array2 = mysqli_fetch_array($query2);

$sql3= "select * from carorder where co_id='" . $array2['co_id'] . "'";
$query3 = mysqli_query($connect, $sql3);
$array3 = mysqli_fetch_array($query3);
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <form action="get_car_save.php" method="POST">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>บันทึกนำรถเข้ารับบริการ</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="login2 pull-right pull-right-pro">ชื่อลูกค้า</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="hidden" value="<?=$autoid?>" name="rs_id">
                                                    <input type="hidden" value="<?=$array['cus_id']?>" name="cus_id">
                                                    <input type="hidden" value="<?=$array3['co_id']?>" name="co_id">
                                                    <input type="text" value="<?=$array2['cus_name']?>" name="cus_name" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="login2 pull-right pull-right-pro">วันที่จอง</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" value="<?=FormatDay($array['rs_date'])?>" name="rs_description" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="login2 pull-right pull-right-pro">รายละเอียด</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea  name="gc_text" class="form-control" rows="4" readonly><?=$array['rs_description']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="login2 pull-right pull-right-pro">ทะเบียนรถ<span style="color: red;">*</span></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="gc_doc" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="login2 pull-right pull-right-pro">อาการรถ<span style="color: red;">*</span></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea  name="gc_text" class="form-control" rows="4" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="login-btn-inner">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="login-horizental cancel-wp text-center">
                                                            <a class="btn btn-white" href="get_car_list.php">ยกเลิก</a>
                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit">บันทึก</button>
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
                </div>
            </div>
        </div>
        </form>

    </div>
</div>


<?php include "footer.php"; ?>

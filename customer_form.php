<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
if ($_GET['mode'] == "") {
    $headtext="เพิ่ม";
    $mode = "add";
    $id1 = "Select Max(substr(cus_id,-6))+1 as MaxID from customer";
    $id2 = mysqli_query($connect, $id1);
    $newid = mysqli_fetch_array($id2);
    if ($newid['MaxID'] == "") {
        $autoid = "CUS000001";
    } else {
        $autoid = "CUS" . sprintf("%06d", $newid['MaxID']);
    }
} else {
    $headtext="แก้ไข";
    $mode = "edit";
    $sql = "select * from customer where cus_id='".$_GET['id']."'";
    $query = mysqli_query($connect, $sql);
    $array = mysqli_fetch_array($query);
    $autoid=$array['cus_id'];
}
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1><?=$headtext?>ข้อมูลลูกค้า</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form action="customer_save.php" method="POST">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รหัสลูกค้า</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="hidden" name="mode" value="<?=$mode?>">
                                                        <input type="text" value="<?=$autoid?>" name="cus_id" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">ชื่อลูกค้า<span style="color: red;">*</span></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['cus_name']?>" name="cus_name" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">ที่อยู่</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea name="cus_add" class="form-control"><?=$array['cus_add']?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">เบอร์โทรศัพท์</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['cus_tel']?>" name="cus_tel" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รถ<span style="color: red;">*</span></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="chosen-select-single mg-b-20">
                                                            <select data-placeholder="เลือกรถ..." name="co_id" class="chosen-select" tabindex="-1" style="display: none;" required>
                                                                <?php
                                                                $sql2 = "select * from carorder order by co_id asc";
                                                                $query2 = mysqli_query($connect, $sql2);
                                                                $select = '';
                                                                while ($array2 = mysqli_fetch_array($query2)) {
                                                                    if($array2['co_id']==$array['co_id']){
                                                                        $select ='selected';
                                                                    }else{
                                                                        $select='';
                                                                    }
                                                                    ?>
                                                                    <option value="<?=$array2['co_id']?>" <?=$select?> ><?=$array2['co_carmodel']?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">Username<span style="color: red;">*</span></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['cus_user']?>" name="cus_user" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">Password<span style="color: red;">*</span></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" value="<?=$array['cus_pass']?>" name="cus_pass" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left">
                                                                <a class="btn btn-white" href="customer_list.php">ยกเลิก</a>
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

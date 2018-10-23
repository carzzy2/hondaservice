<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
if ($_GET['mode'] == "") {
    $headtext="เพิ่ม";
    $mode = "add";
    $id1 = "Select Max(substr(emp_id,-6))+1 as MaxID from employee";
    $id2 = mysqli_query($connect, $id1);
    $newid = mysqli_fetch_array($id2);
    if ($newid['MaxID'] == "") {
        $autoid = "EMP000001";
    } else {
        $autoid = "EMP" . sprintf("%06d", $newid['MaxID']);
    }
} else {
    $headtext="แก้ไข";
    $mode = "edit";
    $sql = "select * from employee where emp_id='".$_GET['id']."'";
    $query = mysqli_query($connect, $sql);
    $array = mysqli_fetch_array($query);
    $autoid=$array['emp_id'];
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
                                        <form action="employee_save.php" method="POST" id="formsave">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">รหัสพนักงาน</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="hidden" name="mode" value="<?=$mode?>">
                                                        <input type="text" value="<?=$autoid?>" name="emp_id" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">ชื่อพนักงาน</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['emp_name']?>" name="emp_name" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">ที่อยู่</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea name="emp_add" class="form-control"><?=$array['emp_add']?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">เบอร์โทรศัพท์</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['emp_tel']?>" maxlength="10" name="emp_tel" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-9 col-sm-9 col-xs-9">
                                                        <label class="login2 pull-right pull-right-pro"><span class="basic-ds-n">ตำแหน่ง</span></label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-3 col-sm-3 col-xs-3">
                                                        <div class="bt-df-checkbox">
                                                            <input class="radio-checked" type="radio" value="option1" id="optionsRadios1" name="optionsRadios">พนักงาน
                                                            <input class="radio-checked" type="radio" value="option1" id="optionsRadios1" name="optionsRadios">ผู้ดูแลระบบ
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">Username</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?=$array['emp_user']?>" name="emp_user" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">Password</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" value="<?=$array['emp_pass']?>" name="emp_pass" id="pass1" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="login2 pull-right pull-right-pro">กรอก Password อีกครั้ง</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" value="<?=$array['emp_pass']?>" name="emp_pass2" id="pass2" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left">
                                                                <a class="btn btn-white" href="employee_list.php">ยกเลิก</a>
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
<script>
    $( document ).ready(function() {
        $( "#formsave" ).submit(function( event ) {
            var pass1 =  $('#pass1').val();
            var pass2 =  $('#pass2').val();
            if(pass1 != pass2){
                alert('กรอก password ไม่ตรงกัน!');
                $('#pass2').focus();
                return false;

            }
        });
    });
</script>
<br><br><br><br><br>
<?php include "footer.php"; ?>

<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
$sql = "select * from get_car where gc_id='".$_GET['id']."'";
$query = mysqli_query($connect, $sql);
$array = mysqli_fetch_array($query);
$autoid=$array['gc_id'];

$sql2 = "select * from customer where cus_id='".$array['cus_id']."'";
$query2 = mysqli_query($connect, $sql2);
$cus = mysqli_fetch_array($query2);
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>บันทึกการซ่อม</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <form action="repair_save.php" method="POST">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="login2 pull-right-pro">วันที่บันทึก</label>
                                                        <input type="text" value="<?= date("d/m/") . (date("Y") + 543) ?>" name="re_date" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-3" style="padding-top: 9px">
                                                        <label class="login2-right-pro">ลูกค้า</label>
                                                        <input type="text" value="<?=$cus['cus_name']?>" name="cus_name" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="login2 pull-right-pro">ทะเบียนรถ</label>
                                                        <input type="text" value="<?= $array['gc_doc'] ?>" name="gc_doc" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="login2 pull-right-pro">อาการ</label>
                                                        <input type="text" value="<?=$array['gc_text']?>" name="gc_text" class="form-control" readonly>
                                                        <input type="hidden" value="<?=$autoid?>" name="gc_id" >
                                                        <input type="hidden" value="<?=$array['rs_id']?>" name="rs_id" >
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 ">
                                    <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-block">เพิ่มรายการตรวจเช็ค</button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-info  btn-block">เพิ่มอะไหล่</button>
                                </div>
                                <div class="clearfix"></div><br>
                                <div id="data-list"></div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 id="exampleModalLabel" class="modal-title">รายการอะไหล่</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">รหัสตรวจเช็ค</th>
                                <th class="text-center">รายการตรวจเช็ค</th>
                                <th class="text-center">ราคา</th>
                                <th class="text-center">จัดการข้อมูล</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $n = 0;
                            $sql = "select * from checklist order by ch_id asc";
                            $query = mysqli_query($connect, $sql);
                            $row = mysqli_num_rows($query);
                            if ($row > 0 ) {
                                while ($array = mysqli_fetch_array($query)) {
                                    $n++;
                                    ?>
                                    <tr>
                                        <td class="text-center" scope="row"><?= $n; ?></td>
                                        <td><?= $array['ch_id'] ?></td>
                                        <td><?= $array['ch_list'] ?></td>
                                        <td class="text-right"><?= number_format($array['ch_price']) ?> บาท</td>
                                        <td class="text-center">
                                            <a data-dismiss="modal" class="btn btn-default addList" href="#" data-url="repair_form_list.php?ch=1&mode=add&id=<?= $array['ch_id'] ?>">
                                                เลือก
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <th style="text-align: center;color: red;" colspan="5"> ไม่พบข้อมูล</th>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 id="exampleModalLabel" class="modal-title">รายการอะไหล่</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">รหัสอะไหล่</th>
                                <th class="text-center">ชื่ออะไหล่</th>
                                <th class="text-center">รายละเอียด</th>
                                <th class="text-center">ราคา</th>
                                <th class="text-center">จำนวน</th>
                                <th class="text-center">จัดการข้อมูล</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $n = 0;
                            $sql = "select * from spareparts where sp_num > 0 order by sp_id asc";
                            $query = mysqli_query($connect, $sql);
                            $row = mysqli_num_rows($query);
                            if ($row > 0 ) {
                                while ($array = mysqli_fetch_array($query)) {
                                    $n++;
                                    ?>
                                    <tr>
                                        <td class="text-center" scope="row"><?= $n; ?></td>
                                        <td><?= $array['sp_id'] ?></td>
                                        <td><?= $array['sp_name'] ?></td>
                                        <td><?= $array['sp_description'] ?></td>
                                        <td class="text-right"><?= number_format($array['sp_price']) ?> บาท</td>
                                        <td class="text-right"><?= number_format($array['sp_num']) ?> ชิ้น</td>
                                        <td class="text-center">
                                            <a data-dismiss="modal" class="btn btn-default addList" href="#" data-url="repair_form_list.php?ch=2&mode=add&id=<?= $array['sp_id'] ?>">
                                                เลือก
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <th style="text-align: center;color: red;" colspan="7"> ไม่พบข้อมูล</th>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: "repair_form_list.php", success: function (result) {
                $("#data-list").html(result);
            }
        });
        $(".addList").click(function () {
            var url = $(this).attr('data-url');
            var data = $('form').serializeArray();
            $.ajax({
                type: "POST",
                data:data,
                url: url,
                success: function (result) {
                    $("#data-list").html(result);
                }
            });
        });
    });
</script>
<?php include "footer.php"; ?>

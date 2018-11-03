<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php

$id1 = "Select Max(substr(po_id,-6))+1 as MaxID from purchase_order";
$id2 = mysqli_query($connect, $id1);
$newid = mysqli_fetch_array($id2);
if ($newid['MaxID'] == "") {
    $autoid = "POR000001";
} else {
    $autoid = "POR" . sprintf("%06d", $newid['MaxID']);
}
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>สั่งซื้ออะไหล่</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <form action="purchase_form2.php" method="POST">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="login2-right-pro">รหัสสั่งซื้อ</label>
                                                        <input type="text" value="<?=$autoid?>" name="po_id" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="login2 pull-right-pro">วันที่สั่งซื้อ</label>
                                                        <input type="text" value="<?= date("d/m/") . (date("Y") + 543) ?>" name="po_date" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="login2 pull-right-pro">พนักงาน</label>
                                                        <input type="text" value="<?=$login['emp_name']?>" name="emp_id" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2  pull-right">
                                    <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-block">เพิ่มข้อมูล</button>
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
                            $sql = "select * from spareparts   order by sp_id asc";
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
                                            <a data-dismiss="modal" class="btn btn-default addList" href="#" data-url="purchase_form_list.php?mode=add&id=<?= $array['sp_id'] ?>">
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
            url: "purchase_form_list.php", success: function (result) {
                $("#data-list").html(result);
            }
        });
        $(".addList").click(function () {
            var url = $(this).attr('data-url');
            $.ajax({
                type: "GET",
                url: url,
                success: function (result) {
                    $("#data-list").html(result);
                }
            });
        });
    });
</script>
<?php include "footer.php"; ?>

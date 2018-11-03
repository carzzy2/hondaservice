<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
$sql = "select * from purchase_order where po_id='".$_GET['id']."'";
$query = mysqli_query($connect, $sql);
$array = mysqli_fetch_array($query);
$autoid=$array['po_id'];
$sql2= "select * from employee where emp_id='" . $array['emp_id'] . "'";
$query2 = mysqli_query($connect, $sql2);
$array2 = mysqli_fetch_array($query2);
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <form action="back_purchase_save.php" method="POST">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>รายการสั่งซื้อเลขที่ <?=$autoid?></h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
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
                                                    <input type="text" value="<?=FormatDay($array['po_date']) ?>" name="po_date" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="login2 pull-right-pro">พนักงาน</label>
                                                    <input type="text" value="<?= $array2['emp_name'] ?>" name="emp_id" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="login2-right-pro">ตัวแทนจำหน่าย</label>
                                                        <input type="text" value="<?= $array['po_agent'] ?>"  name="po_agent" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="login2 pull-right-pro">เบอร์โทรศัพท์</label>
                                                        <input type="text" value="<?= $array['po_tel'] ?>" name="po_tel" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="login2 pull-right-pro">ที่อยู่</label>
                                                        <textarea name="po_address" class="form-control" readonly><?= $array['po_address'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover">
                                        <thead >
                                        <tr>
                                            <th class="text-center" >#</th>
                                            <th class="text-center" >รหัสอะไหล่</th>
                                            <th class="text-center" >รายการ</th>
                                            <th class="text-center" >รายละเอียด</th>
                                            <th class="text-center">ราคา(ต่อชิ้น)</th>
                                            <th class="text-center" width="200px">จำนวน</th>
                                            <th class="text-center">ราคารวม</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $n = 0;
                                        $sql_list= "select * from purchase_order_list where po_id='".$_GET['id']."'";
                                        $query_list = mysqli_query($connect, $sql_list);
                                        if (mysqli_num_rows($query_list) > 0 ) {
                                            while ($array_list = mysqli_fetch_array($query_list)) {
                                                $n++;
                                                $sqlsp= "select * from spareparts where sp_id='".$array_list['sp_id']."'";
                                                $querysp = mysqli_query($connect, $sqlsp);
                                                $arraysp = mysqli_fetch_array($querysp);
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $n; ?></td>
                                                    <td><?= $arraysp['sp_id'] ?></td>
                                                    <td><?= $arraysp['sp_name'] ?></td>
                                                    <td><?= $arraysp['sp_description'] ?></td>
                                                    <td class="text-right"><?= number_format($array_list['po_price']) ?> บาท</td>
                                                    <td class="text-right"><?= $array_list['po_num']?> ชิ้น</td>
                                                    <td class="text-right"><?= number_format($array_list['po_price']*$array_list['po_num'] ) ?> บาท</td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <th style="text-align: center;color: red;" colspan="6"> ไม่พบข้อมูล</th>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group-inner">
                                        <div class="login-btn-inner">
                                            <div class="login-horizental cancel-wp text-center">
                                                <a class="btn btn-white" href="back_purchase_list.php">ย้อนกลับ</a>
                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">ยืนยัน</button>
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

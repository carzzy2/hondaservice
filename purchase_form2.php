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
foreach ($_SESSION['ss_sp_id'] as $key => $val) {
    $_SESSION['ss_sp_num'][$key] = $_POST['po_count'][$key];
}
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <form action="puchase_save.php?mode=add" method="POST">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>สั่งซื้ออะไหล่เลขที่<?=$autoid?></h1>
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
                                                        <label class="login2-right-pro">ตัวแทนจำหน่าย</label>
                                                        <input type="text"  name="po_agent" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="login2 pull-right-pro">เบอร์โทรศัพท์</label>
                                                        <input type="text"  name="po_tel" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="login2 pull-right-pro">ที่อยู่</label>
                                                        <textarea name="po_address" class="form-control" required></textarea>
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
                                        if (count($_SESSION['ss_sp_id']) == 0) {
                                            ?>
                                            <tr>
                                                <th style="text-align: center;" colspan="7"> ยังไม่มีรายการ</th>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($_SESSION['ss_sp_id'] as $key => $val) {
                                                $n++;
                                                $sqlsp= "select * from spareparts where sp_id='".$_SESSION['ss_sp_id'][$key]."'";
                                                $querysp = mysqli_query($connect, $sqlsp);
                                                $arraysp = mysqli_fetch_array($querysp);
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $n; ?></td>
                                                    <td><?= $_SESSION['ss_sp_id'][$key] ?></td>
                                                    <td><?= $arraysp['sp_name'] ?></td>
                                                    <td><?= $arraysp['sp_description'] ?></td>
                                                    <td class="text-right"><?= $arraysp['sp_price'] ?> บาท</td>
                                                    <td class="text-right"><?= $_SESSION['ss_sp_num'][$key] ?> ชิ้น</td>
                                                    <td class="text-right"><?= number_format($_SESSION['ss_sp_num'][$key]*$arraysp['sp_price'] ) ?> บาท</td>

                                                </tr>
                                                <?php
                                                $i++;
                                                $total+= $arraysp['sp_price'] *$_SESSION['ss_sp_num'][$key];
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td class="text-right" colspan="6"><b>รวม</b></td>

                                            <td class="text-right"><input type="hidden" name="po_total" value="<?=$total ?>"><?=number_format($total) ?> บาท</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group-inner">
                                        <div class="login-btn-inner">
                                            <div class="login-horizental cancel-wp text-center">
                                                <a class="btn btn-white" href="purchase_form.php">ย้อนกลับ</a>
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
        </form>

    </div>
</div>


<?php include "footer.php"; ?>

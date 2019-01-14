<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
$sql = "select * from repair where re_id='".$_GET['id']."'";
$query = mysqli_query($connect, $sql);
$array = mysqli_fetch_array($query);

$sql3 = "select * from get_car where gc_id='".$array['gc_id']."'";
$query3 = mysqli_query($connect, $sql3);
$array3 = mysqli_fetch_array($query3);

$sql2 = "select * from customer where cus_id='".$array3['cus_id']."'";
$query2 = mysqli_query($connect, $sql2);
$cus = mysqli_fetch_array($query2);

$id1 = "Select Max(substr(pa_id,-6))+1 as MaxID from payment";
$id2 = mysqli_query($connect, $id1);
$newid = mysqli_fetch_array($id2);
if ($newid['MaxID'] == "") {
    $autoid = "PAY000001";
} else {
    $autoid = "PAY" . sprintf("%06d", $newid['MaxID']);
}
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>บันทึกการจ่ายค่าซ่อม</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="login2 pull-right-pro">รหัสชำระ</label>
                                                        <input type="text" value="<?= $autoid ?>" name="re_date" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="login2 pull-right-pro">วันที่ชำระ</label>
                                                        <input type="text" value="<?= date("d/m/") . (date("Y") + 543) ?>" name="po_date" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-3" style="padding-top: 9px">
                                                        <label class="login2-right-pro">ลูกค้า</label>
                                                        <input type="text" value="<?=$cus['cus_name']?>" name="cus_name" class="form-control" readonly>
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
                                            <th class="text-center" >รหัส</th>
                                            <th class="text-center" >รายการ</th>
                                            <th class="text-center">ราคา</th>
                                            <th class="text-center" width="200px">จำนวน</th>
                                            <th class="text-center">ราคารวม</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $n = 0;
                                        $sql_list2= "select * from repair_checklist where re_id='".$_GET['id']."' ";
                                        $query_list2 = mysqli_query($connect, $sql_list2);
                                        if (mysqli_num_rows($query_list2) > 0 ) {
                                            while ($array_list2 = mysqli_fetch_array($query_list2)) {
                                                $n++;
                                                $sqlch= "select * from checklist where ch_id='".$array_list2['ch_id']."'";
                                                $querych = mysqli_query($connect, $sqlch);
                                                $arraych = mysqli_fetch_array($querych);
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $n; ?></td>
                                                    <td><?= $arraych['ch_id'] ?></td>
                                                    <td><?= $arraych['ch_list'] ?></td>
                                                    <td class="text-right"><?= number_format($array_list2['re_price']) ?> บาท</td>
                                                    <td class="text-right">-</td>
                                                    <td class="text-right"><?= number_format($array_list2['re_price'] ) ?> บาท</td>
                                                </tr>
                                                <?php
                                            $alltotal+= $array_list2['re_price'];
                                            }
                                        }
                                        $sql_list= "select * from repair_spareparts where re_id='".$_GET['id']."'";
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
                                                    <td class="text-right"><?= number_format($array_list['re_price']) ?> บาท</td>
                                                    <td class="text-right"><?= $array_list['re_num']?> ชิ้น</td>
                                                    <td class="text-right"><?= number_format($array_list['re_price']*$array_list['re_num'] ) ?> บาท</td>
                                                </tr>
                                                <?php
                                                $alltotal+= $array_list['re_price']*$array_list['re_num'];
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td class="text-right" colspan="5">
                                                รวม
                                            </td>
                                            <td class="text-right" ><?=number_format($alltotal)?> บาท</td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group-inner">
                                        <div class="login-btn-inner">
                                            <div class="login-horizental cancel-wp text-center">
                                                <a class="btn btn-white" href="pay_show.php">ย้อนกลับ</a>
                                                <a class="btn btn-sm btn-primary login-submit-cs" href="pay_save.php?id=<?=$_GET['id']?>">บันทึก</a>
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
<br><br><br><br><br><br><br><br>

<?php include "footer.php"; ?>

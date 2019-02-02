<?php include "sitebar.php"; ?>
<?php
include "header.php";

unset($_SESSION['ss_sp_id']);
unset($_SESSION['ss_sp_num']);
unset($_SESSION['ss_ch_id']);
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>ชำระค่าซ่อมรถ</h4>
        <div class="col-md-12">
            <div class="pull-right">
                <a data-toggle="tooltip" href="pay_show.php" class="btn btn-success" data-original-title="ย้อนกลับ">ย้อนกลับ</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รหัสใบเสร็จ</th>
                        <th class="text-center">วันที่ชำระ</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">ยอดรวม(บาท)</th>
                        <th class="text-center">จัดการข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    $sql = "select * from `payment` order by pa_id asc";
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            $sql2 = "select * from get_car where gc_id='".$array['gc_id']."'";
                            $query2 = mysqli_query($connect, $sql2);
                            $array2 = mysqli_fetch_array($query2);

                            $sql3 = "select * from customer where cus_id='".$array2['cus_id']."'";
                            $query3 = mysqli_query($connect, $sql3);
                            $array3 = mysqli_fetch_array($query3);

                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td style="max-width: 200px"><?= $array['re_id'] ?></td>
                                <td style="max-width: 200px" class="text-center"><?= FormatDay($array['pa_date']) ?></td>
                                <td style="max-width: 200px">คุณ<?= $array3['cus_name'] ?></td>
                                <td class="text-right"><?= number_format($array['pa_total']) ?></td>
                                <td class="text-center">
                                    <a data-toggle="tooltip"  href="pay_view.php?id=<?= $array['pa_id'] ?>" class="btn btn-default" data-original-title="ดูรายละเอียด"><i class="fa  fa-search-plus" aria-hidden="true"></i> ดูรายละเอียด</a>
                                    <a data-toggle="tooltip"  href="pay_print.php?id=<?= $array['pa_id'] ?>&option=p" class="btn btn-warning" target="_blank" data-original-title="ดูรายละเอียด"><i class="fa  fa-print" aria-hidden="true"></i> ปริ้น</a>
                                </td>
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
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

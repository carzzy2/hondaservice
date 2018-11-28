<?php include "sitebar.php"; ?>
<?php
include "header.php";

unset($_SESSION['ss_sp_id']);
unset($_SESSION['ss_sp_num']);
unset($_SESSION['ss_ch_id']);
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>รายการซ่อม</h4>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รหัส</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">วันทีนำรถเข้ารับบริการ</th>
                        <th class="text-center">ทะเบียนรถ</th>
                        <th class="text-center">อาการ</th>
                        <th class="text-center">จัดการข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    if (isset($_GET['search'])) {
                        $sql = "select * from get_car where gc_status='1' and  gc_id like '%" . $_GET['search'] . "%' order by gc_id asc";
                    } else {
                        $sql = "select * from get_car where gc_status='1' order by gc_id asc";
                    }
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            $sql2 = "select * from customer where cus_id='".$array['cus_id']."'";
                            $query2 = mysqli_query($connect, $sql2);
                            $array2 = mysqli_fetch_array($query2);
                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td style="max-width: 200px"><?= $array['gc_id'] ?></td>
                                <td style="max-width: 200px">คุณ<?= $array2['cus_name'] ?></td>
                                <td style="max-width: 200px" class="text-center"><?= FormatDay($array['gc_date']) ?></td>
                                <td><?= $array['gc_doc'] ?></td>
                                <td><?= $array['gc_text'] ?></td>
                                <td class="text-center">
                                    <a data-toggle="tooltip"  href="repair_form.php?id=<?= $array['gc_id'] ?>" class="btn btn-default" data-original-title="Confirm"><i class="fa fa-check-circle" aria-hidden="true"> บันทึก</i></a>
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
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

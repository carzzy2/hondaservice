<?php include "sitebar.php"; ?>
<?php
include "header.php";
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>รายการรถที่ชำระเงินเสร็จสิ้น</h4>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รหัส</th>
                        <th class="text-center">วันที่ซ่อม</th>
                        <th class="text-center">วันที่ชำระเงิน</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">ชื่อรุ่น</th>
                        <th class="text-center">ทะเบียนรถ</th>
                        <th class="text-center">จัดการข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    $sql = "select * from `repair`  re INNER JOIN get_car gc on re.gc_id = gc.gc_id where gc_status = '3' order by re_id asc";
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

                            $sqlcar = "select * from carorder where co_id= '".$array2['co_id']."' ";
                            $querycar = mysqli_query($connect, $sqlcar);
                            $arraycar = mysqli_fetch_array($querycar);
                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td style="max-width: 200px"><?= $array['re_id'] ?></td>
                                <td style="max-width: 200px" class="text-center"><?= FormatDay($array['re_date']) ?></td>
                                <td style="max-width: 200px" class="text-center"><?= FormatDay($array['pa_date']) ?></td>
                                <td style="max-width: 200px">คุณ<?= $array3['cus_name'] ?></td>
                                <td class="text-right"><?= $array['gc_doc'] ?></td>
                                <td class="text-right"><?= $arraycar['co_carmodel'] ?></td>
                                <td class="text-center">
                                    <a data-toggle="tooltip"  href="backcar_save.php?id=<?= $array['re_id'] ?>" onclick="return confirm('ยืนยันการรับรถ ? ')" class="btn btn-default" data-original-title="รับรถ">รับรถ</a>
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

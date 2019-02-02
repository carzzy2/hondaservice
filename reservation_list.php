<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>ยืนยันการจอง</h4>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">วัน-เวลา ที่บันทึกข้อมูล</th>
                        <th class="text-center">วัน-เวลา ที่จอง</th>
                        <th class="text-center">รายละเอียด</th>
                        <th class="text-center">จัดการข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    $sql = "select *,date(rs_date) as `date`,time(rs_date) as `time`,date(rs_datereal) as `datereal`,time(rs_datereal) as `timereal`
                                from reservation where rs_status='ยังไม่ยืนยันการจอง' order by rs_id asc";
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            $sql2 = "select * from customer where cus_id='".$array['cus_id']."'";
                            $query2 = mysqli_query($connect, $sql2);
                            $array2 = mysqli_fetch_array($query2);
                            if($array['date'] <>date("Y-m-d")){
                                $disable = "disabled";
                            }else{
                                $disable = "";
                            }
                            $id =$array['rs_id'];
                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td style="max-width: 200px">คุณ<?= $array2['cus_name'] ?></td>
                                <td class="text-center"><?= FormatDay($array['datereal']) ?> <?= $array['timereal'] ?></td>
                                <td class="text-center"><?= FormatDay($array['date']) ?> <?= $array['time'] ?></td>
                                <td><?= $array['rs_description'] ?></td>
                                <td class="text-center">
                                    <button onclick="window.location.href='reservation_save.php?mode=add&id=<?=$id ?>'" data-toggle="tooltip" href="" class="btn btn-default" data-original-title="Confirm" <?=$disable?> ><i class="fa fa-check-circle" aria-hidden="true"></i> ยืนยัน</button>
                                    <a data-toggle="tooltip" href="reservation_cancel.php?&id=<?= $array['rs_id'] ?>"  class="btn btn-default" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i> ยกเลิก</a>
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

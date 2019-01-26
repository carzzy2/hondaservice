<?php include "sitebar.php"; ?>
<?php
include "header.php";

?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <div class="col-md-12">
                <form  method="get"  onSubmit="JavaScript:return Reportcheck();"  >
                    <div class="text-center"><h2>รายงานการจอง</h2></div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <p align="right">
                                <b>ตั้งแต่วันที่: </b>
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt "></span></span>
                                <input type="date" name="fromdate" id="date1" class="form-control" value="<?=$_GET['fromdate'] ? $_GET['fromdate'] : date("Y-m").'-01';?>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <p align="right">
                                <b>ถึงวันที่:</b>
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt "></span></span>
                                <input type="date" name="todate" id="date2" class="form-control" value="<?=$_GET['todate'] ? $_GET['todate'] : date("Y-m-d");?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><p align="center">
                                    <b>สถานะ:</b>
                                    <label class="radio-inline"><input type="radio" name="status" value = "9" <?php if($_GET['status']==9 or empty($_GET['status'])){echo 'checked';}?>>ทั้งหมด</label>
                                    <label class="radio-inline"><input type="radio"  name="status" value="0" <?php if($_GET['status']=='0' ){echo 'checked';}?>>ยังไม่ยืนยันการจอง</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="1" <?php if($_GET['status']=='1' ){echo 'checked';}?>>ยืนยันการจองแล้ว</label>

                                </p>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span> เรียกดูรายงาน</button>
                    </center>
                </form>
            </div>
        </div>
        <br><br><br>
        <?php
        $fromdate = $_GET['fromdate'];
        $todate = $_GET['todate'];
        $status = $_GET['status'];
        if(isset($fromdate) and isset($todate)){

        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <a download="Report.xls" class="btn btn-warning" onclick="return ExcellentExport.excel(this, 'export', 'Report');">Export to Excel</a>
                </div>
            </div>
            <div class="col-md-12" id="export">
                <h4>รายงานการจอง ตั้งแต่วันที่ <?=FormatDay($fromdate)?> ถึงวันที่ <?=FormatDay($todate)?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">วัน-เวลา ที่บันทึกข้อมูล</th>
                        <th class="text-center">วัน-เวลา ที่จอง</th>
                        <th class="text-center">รายละเอียด</th>
                        <th class="text-center">สถานะ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    if($status=='0'){
                        $where ="and rs_status='ยังไม่ยืนยันการจอง' ";
                    }elseif($status=='1'){
                        $where ="and rs_status='ยืนยันการจองแล้ว' ";
                    }else{
                        $where ="and rs_status in ('ยังไม่ยืนยันการจอง','ยืนยันการจองแล้ว')";
                    }
                    $sql = "select *,date(rs_date) as `date`,time(rs_date) as `time`,date(rs_datereal) as `datereal`,time(rs_datereal) as `timereal`
                            from reservation where  date(rs_datereal) between '$fromdate' and '$todate' $where order by rs_datereal asc";
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            $sql2 = "select * from customer where cus_id='".$array['cus_id']."'";
                            $query2 = mysqli_query($connect, $sql2);
                            $array2 = mysqli_fetch_array($query2);
                            if($array['rs_status']=='ยืนยันการจองแล้ว'){
                                $color='blue';
                            }else{
                                $color='red';
                            }
                            ?>
                            <tr>
                            <td class="text-center" scope="row"><?= $n; ?></td>
                            <td style="max-width: 200px">คุณ<?= $array2['cus_name'] ?></td>
                            <td class="text-center"><?= FormatDay($array['rs_datereal']) ?> <?= $array['timereal'] ?></td>
                            <td class="text-center"><?= FormatDay($array['date']) ?> <?= $array['time'] ?></td>
                            <td><?= $array['rs_description'] ?></td>
                            <td class="text-center" style="color:<?=$color ?>"><?= $array['rs_status'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <?php
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
        <?php } ?>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

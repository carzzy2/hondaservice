<?php include "sitebar.php"; ?>
<?php
include "header.php";

?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <div class="col-md-12">
                <form  method="get"  onSubmit="JavaScript:return Reportcheck();"  >
                    <div class="text-center"><h2>รายงานการสั่งซื้ออะไหล่</h2></div>
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
                                    <label class="radio-inline"><input type="radio"  name="status" value="0" <?php if($_GET['status']=='0' ){echo 'checked';}?>>ยังไม่ได้รับของ</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="1" <?php if($_GET['status']=='1' ){echo 'checked';}?>>รับของแล้ว</label>

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
                <h4>รายงานการสั่งซื้ออะไหล่ ตั้งแต่วันที่ <?=FormatDay($fromdate)?> ถึงวันที่ <?=FormatDay($todate)?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รหัสสั่งซื้อ</th>
                        <th class="text-center">วันที่สั่งซื้อ</th>
                        <th class="text-center">พนักงาน</th>
                        <th class="text-center">ตัวแทน</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center">จำนวนเงิน</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    if($status=='0'){
                        $where ="and po_status='0' ";
                    }elseif($status=='1'){
                        $where ="and po_status='1' ";
                    }else{
                        $where ="";
                    }
                    $sql = "select * from purchase_order where  po_date between '$fromdate' and '$todate' $where order by po_date asc";
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            $sql2= "select * from employee where emp_id='" . $array['emp_id'] . "'";
                            $query2 = mysqli_query($connect, $sql2);
                            $array2 = mysqli_fetch_array($query2);
                            if($array['po_status']=='1'){
                                $status='รับของแล้ว';
                                $color='blue';
                            }else{
                                $status='ยังไม่ได้รับของ';
                                $color='red';
                            }
                            $total+=$array['po_total'];
                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td ><?= $array['po_id'] ?></td>
                                <td><?= FormatDay($array['po_date']) ?></td>
                                <td><?= $array2['emp_name'] ?></td>
                                <td><?= $array['po_agent'] ?></td>
                                <td class="text-center" style="color:<?=$color ?>"><?=$status ?></td>
                                <td class="text-right"><?= number_format($array['po_total']) ?> บาท</td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="6" class="text-right">รวมทั้งสิ้น</td>
                            <td  class="text-right"><?= number_format($total) ?> บาท</td>
                        </tr>
                        <?php
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
        <?php } ?>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

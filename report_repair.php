<?php include "sitebar.php"; ?>
<?php
include "header.php";

?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <div class="row">
            <div class="col-md-12">
                <form  method="get"  onSubmit="JavaScript:return Reportcheck();"  >
                    <div class="text-center"><h2>รายงานการซ่อม</h2></div>
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
        if(isset($fromdate) and isset($todate)){

        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <a download="Report.xls" class="btn btn-warning" onclick="return ExcellentExport.excel(this, 'export', 'Report');">Export to Excel</a>
                </div>
            </div>
            <div class="col-md-12" id="export">
                <h4>รายงานการซ่อม ตั้งแต่วันที่ <?=FormatDay($fromdate)?> ถึงวันที่ <?=FormatDay($todate)?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รหัส</th>
                        <th class="text-center">วันที่ซ่อม</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">ทะเบียนรถ</th>
                        <th class="text-center">อาการรถ</th>
                        <th class="text-right">ยอดรวม</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;

                    $sql = "select * from repair where  re_date between '$fromdate' and '$todate'  order by re_date asc";
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

                            $total+=$array['re_total'];
                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td style="max-width: 200px"><?= $array['re_id'] ?></td>
                                <td style="max-width: 200px" class="text-center"><?= FormatDay($array['re_date']) ?></td>
                                <td style="max-width: 200px"><?= $array3['cus_name'] ?></td>
                                <td style="max-width: 200px"><?= $array2['gc_doc'] ?></td>
                                <td style="max-width: 200px"><?= $array2['gc_text'] ?></td>
                                <td class="text-right"><?= number_format($array['re_total']) ?> บาท</td>
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

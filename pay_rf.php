<?php include "sitebar.php"; ?>
<?php
include "header.php";
?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>ใบเสร็จชำระเงิน</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <a data-toggle="tooltip" href="pay_print.php?option=p&id=<?=$_GET['id']?>" target="_blank" class="btn btn-info" data-original-title="คลิกเพื่อพิมพ์">คลิกเพื่อพิมพ์</a>
                </div>
            </div>
        </div>
        <div class="clearfix"><br></div>
        <div class="row">
            <div class="col-md-12">
                <iframe  src="pay_print.php?id=<?=$_GET['id']?>"  width="100%" style="height: 658px;"></iframe>
            </div>
        </div>
        <div class="clearfix"><br></div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <a data-toggle="tooltip" href="pay_show.php"  class="btn btn-default">กลับหน้าแรก</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

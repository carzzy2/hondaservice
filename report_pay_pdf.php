<?php
@session_start();
include "config.php";
ob_start();
require_once('mpdf/mpdf.php');
$sqlst = "select * from store where sto_id= 'STO000001' ";
$queryst = mysqli_query($connect, $sqlst);
$arrayst = mysqli_fetch_array($queryst);

$fromdate = $_GET['fromdate'];
$todate = $_GET['todate'];
$status = $_GET['status'];
?>
<table width="100%" border="0" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px; font-size: 13px;" >
    <tr>
        <td><center><img src="img/Honda-Motorcycle-Logo.png" width="150px"></center></td>
        <td colspan="2" style="font-size: 18px">
            <h3><b><?=$arrayst['sto_name']?></b></h3>
            <?=$arrayst['sto_add']?><br>
            Tel: <?=$arrayst['sto_tel']?>
        </td>
    </tr>
</table>
<h3 style="text-align: center">รายงานการชำระเงิน</h3>
<h4  style="text-align: center">ตั้งแต่วันที่ <?=FormatDay($fromdate)?> ถึงวันที่ <?=FormatDay($todate)?></h4>
    <table width="100%" border="1" align="center" style="padding: 5px; border-collapse:inherit; border:1px  #666666; line-height: 20px; font-size: 12px;" >
        <thead>
        <tr>
            <th  style="text-align: center">#</th>
            <th  style="text-align: center">รหัสใบเสร็จ</th>
            <th  style="text-align: center">วันที่ชำระ</th>
            <th  style="text-align: center">ชื่อลูกค้า</th>
            <th  style="text-align: center">ยอดรวม</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n = 0;
        $sql = "select * from payment where  pa_date between '$fromdate' and '$todate'  order by pa_date asc";
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

                $total+=$array['pa_total'];
                ?>
                <tr>
                    <td  style="text-align: center" scope="row"><?= $n; ?></td>
                    <td style="max-width: 200px"><?= $array['re_id'] ?></td>
                    <td style="max-width: 200px"  style="text-align: center"><?= FormatDay($array['pa_date']) ?></td>
                    <td style="max-width: 200px">คุณ<?= $array3['cus_name'] ?></td>
                    <td  style="text-align:right"><?= number_format($array['pa_total']) ?> บาท</td>
                </tr>
                
                <?php
            }
            ?>
            <tr>
                <td colspan="4"  style="text-align:right">ทั้งหมด</td>
                <td   style="text-align:right"><?= number_format($n) ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="4"  style="text-align:right">รวมทั้งหมด</td>
                <td   style="text-align:right"><?= number_format($total) ?> บาท</td>
            </tr>
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
    <h5  style="text-align: right">วันที่พิมพ์ <?= date("d/m/") . (date("Y")) ?></h5>

<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->autoScriptToLang = false;
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
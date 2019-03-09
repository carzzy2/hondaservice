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
<h3 style="text-align: center">รายงานการจอง</h3>
<h4  style="text-align: center">ตั้งแต่วันที่ <?=FormatDay($fromdate)?> ถึงวันที่ <?=FormatDay($todate)?></h4>
    <table width="100%" border="1" align="center" style="padding: 5px; border-collapse:inherit; border:1px  #666666; line-height: 20px; font-size: 12px;" >
        <thead>
        <tr>
            <th style="text-align: center">#</th>
            <th style="width: 100px">ชื่อลูกค้า</th>
            <th  style="width: 150px">วัน-เวลา ที่บันทึกข้อมูล</th>
            <th  style="width: 150px">วัน-เวลา ที่จอง</th>
            <th  style="width: 120px">รายละเอียด</th>
            <th style="text-align: center">สถานะ</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n = 0;
        $count1 = 0;
        $count2 = 0;
        $count3 = 0;
        $count4 = 0;
        if($status=='0'){
            $where ="and rs_status='ยกเลิกการจองแล้ว' ";
        }elseif($status=='1'){
            $where ="and rs_status='ยืนยันการจองแล้ว' ";
        }elseif($status=='2'){
            $where ="and rs_status='นำรถเข้ารับบริการแล้ว'";
        }elseif($status=='3'){
            $where ="and rs_status='ยังไม่ยืนยันการจอง'";
        }else{
            $where ="";
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
                if($array['rs_status']=='ยกเลิกการจองแล้ว'){
                    $color='red';
                }else{
                    $color='blue';
                }
                if($array['rs_status']=='ยกเลิกการจองแล้ว'){
                    $count1+=1;
                }elseif($array['rs_status']=='ยืนยันการจองแล้ว'){
                    $count2+=1;
                }elseif($array['rs_status']=='นำรถเข้ารับบริการแล้ว'){
                    $count3+=1;
                }elseif($array['rs_status']=='ยังไม่ยืนยันการจอง'){
                    $count4+=1;
                }
                ?>
                <tr>
                    <td  style="text-align: center" scope="row"><?= $n; ?></td>
                    <td style="max-width: 200px"> คุณ<?= $array2['cus_name'] ?></td>
                    <td  style="text-align: center"> <?= FormatDay($array['rs_datereal']) ?> <?= $array['timereal'] ?></td>
                    <td  style="text-align: center"> <?= FormatDay($array['date']) ?> <?= $array['time'] ?></td>
                    <td> <?= $array['rs_description'] ?></td>
                    <td  style="text-align: center" style="color:<?=$color ?>"> <?= $array['rs_status'] ?></td>
                </tr>
                
                <?php
            }
            ?>
            <tr>
                <td colspan="5"  style="text-align: right">ยกเลิกการจองแล้ว</td>
                <td   style="text-align: right"><?= $count1 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="5"  style="text-align: right">ยืนยันการจองแล้ว</td>
                <td   style="text-align: right"><?= $count2 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="5"  style="text-align: right">นำรถเข้ารับบริการแล้ว</td>
                <td   style="text-align: right"><?= $count3 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="5"  style="text-align: right">ยังไม่ยืนยันการจอง</td>
                <td   style="text-align: right"><?= $count4 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="5"  style="text-align: right">ทั้งหมด</td>
                <td   style="text-align: right"><?= $n ?> รายการ</td>
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
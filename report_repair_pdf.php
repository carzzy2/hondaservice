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
<h3 style="text-align: center">รายงานการซ่อม</h3>
<h4>ตั้งแต่วันที่ <?=FormatDay($fromdate)?> ถึงวันที่ <?=FormatDay($todate)?></h4>
    <table width="100%" border="1" align="center" style="padding: 5px; border-collapse:inherit; border:1px  #666666; line-height: 20px; font-size: 12px;" >
        <thead>
        <tr>
            <th style="text-align: center">#</th>
            <th >รหัส</th>
            <th >วันที่ซ่อม</th>
            <th  style="width: 150px">ชื่อลูกค้า</th>
            <th  style="width: 120px">ทะเบียนรถ</th>
            <th style="text-align: center">อาการรถ</th>
            <th style="text-align: center">สถานะ</th>
            <th style="text-align: center">ยอดรวม</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n = 0;
        $count1 = 0;
        $count2 = 0;
        $count3 = 0;
        if($status=='0'){
            $where ="and rs_status='ซ่อมรถเสร็จแล้ว' ";
        }elseif($status=='1'){
            $where ="and rs_status='ชำระเงินแล้ว' ";
        }elseif($status=='2'){
            $where ="and rs_status='รับรถแล้ว'";
        }else{
            $where ="";
        }
        $sql = "select * from repair a INNER JOIN reservation b on a.rs_id = b.rs_id where re_date between '$fromdate' and '$todate' $where order by re_date asc";
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

                $sqlres = "select * from reservation where rs_id='".$array['rs_id']."'";
                $queryres = mysqli_query($connect, $sqlres);
                $arrayres = mysqli_fetch_array($queryres);
                if($array['rs_status']=='ซ่อมรถเสร็จแล้ว'){
                    $count1+=1;
                }elseif($array['rs_status']=='ชำระเงินแล้ว'){
                    $count2+=1;
                }elseif($array['rs_status']=='รับรถแล้ว'){
                    $count3+=1;
                }
                $total+=$array['re_total'];
                ?>
                <tr>
                    <td  style="text-align: center" scope="row"><?= $n; ?></td>
                    <td style="max-width: 200px"><?= $array['re_id'] ?></td>
                    <td style="max-width: 200px"  style="text-align: center"><?= FormatDay($array['re_date']) ?></td>
                    <td style="max-width: 200px"><?= $array3['cus_name'] ?></td>
                    <td><?= $arrayres['rs_doc'] ?></td>
                    <td ><?= $array2['gc_text'] ?></td>
                    <td  style="text-align: center"><?= $array['rs_status'] ?></td>
                    <td  style="text-align: right"><?= number_format($array['re_total']) ?> บาท</td>
                </tr>
                
                <?php
            }
            ?>
            <tr>
                <td colspan="7"  style="text-align: right">รวมทั้งสิ้น</td>
                <td   style="text-align: right"><?= number_format($total) ?> บาท</td>
            </tr>

            <tr>
                <td colspan="7"  style="text-align: right">ซ่อมรถเสร็จแล้ว</td>
                <td   style="text-align: right"><?= $count1 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="7"  style="text-align: right">ชำระเงินแล้ว</td>
                <td   style="text-align: right"><?= $count2 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="7"  style="text-align: right">รับรถแล้ว</td>
                <td   style="text-align: right"><?= $count3 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="7"  style="text-align: right">ทั้งหมด</td>
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
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->autoScriptToLang = false;
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
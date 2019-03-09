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
<h3 style="text-align: center">รายงานการสั่งซื้ออะไหล่</h3>
<h4  style="text-align: center">ตั้งแต่วันที่ <?=FormatDay($fromdate)?> ถึงวันที่ <?=FormatDay($todate)?></h4>
    <table width="100%" border="1" align="center" style="padding: 5px; border-collapse:inherit; border:1px  #666666; line-height: 20px; font-size: 12px;" >
        <thead>
        <tr>
            <th style="text-align: center">#</th>
            <th style="width: 100px">รหัสสั่งซื้อ</th>
            <th  style="width: 100px">วันที่สั่งซื้อ</th>
            <th  style="width: 180px">พนักงาน</th>
            <th  style="width: 120px">ตัวแทน</th>
            <th style="text-align: center">จำนวนเงิน</th>
            <th>สถานะ</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $n = 0;
        $count1=0;
        $count2=0;
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
                    $count1+= 1;

                }else{
                    $status='ยังไม่ได้รับของ';
                    $color='red';
                    $count2+= 1;
                }
                $total+=$array['po_total'];

                ?>
                <tr>
                    <td scope="row"><?= $n; ?></td>
                    <td ><?= $array['po_id'] ?></td>
                    <td><?= FormatDay($array['po_date']) ?></td>
                    <td><?= $array2['emp_name'] ?></td>
                    <td><?= $array['po_agent'] ?></td>
                    <td style="text-align: right"><?= number_format($array['po_total']) ?> บาท</td>
                    <td style="color:<?=$color ?>"><?=$status ?></td>
                </tr>
                <?php
            }
            ?>

            <tr>
                <td colspan="6"  style="text-align: right">ทั้งหมด</td>
                <td   style="text-align: right"><?= $n ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="6"  style="text-align: right">รับของแล้ว</td>
                <td   style="text-align: right"><?= $count1 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="6"  style="text-align: right">ยังไม่ได้รับของ</td>
                <td   style="text-align: right"><?= $count2 ?> รายการ</td>
            </tr>
            <tr>
                <td colspan="6"  style="text-align: right">รวมทั้งหมด</td>
                <td   style="text-align: right"><?= number_format($total) ?> บาท</td>
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
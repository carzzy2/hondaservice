<?php
session_start();
include 'config.php';
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('สวัสดี');

?>
<table width="100%" border="1" align="center" style=" border-collapse:inherit; border:1px  #666666; line-height: 20px; font-size: 13px;" >
<tr>
        <td width="70px" style="border-right-color: white;">
            <img  src="img/lo.png" width="70" >
        </td>
        <td valign="top" align="center"  width="335px" style="padding-top:7px;">
            <b>การไฟฟ้าส่วนภูมิภาค<br>
            200 ถนนงามวงส์วาน จตุจักร กรุงเทพฯ 10900<br>
            คำร้องขอใช้ไฟฟ้า</b>
        </td>
        <td valign="top" style="padding-top:7px;" colspan="2">
            เลขที่คำร้อง <?=$array_print[re_id]?><br>
            กฟฟ. <?=$array_print[re_branch]?><br>
            ผู้รับคำร้อง <?=$array_print[user_name]?> <?=$array_print[user_last]?><br>
        </td>
</tr>
</table>
<?Php
//$mpdf->SetAutoFont();
//$mpdf->SetDisplayMode('fullpage');
$mpdf->Output();
?>
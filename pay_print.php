<?php
session_start();
include 'config.php';



$sql = "select * from payment where pa_id= '".$_GET['id']."' ";
$query = mysqli_query($connect, $sql);
$array = mysqli_fetch_array($query);

$sqlgc = "select * from get_car where gc_id= '".$array['gc_id']."' ";
$querygc = mysqli_query($connect, $sqlgc);
$arraygc = mysqli_fetch_array($querygc);

$sqlcus = "select * from customer where cus_id= '".$arraygc['cus_id']."' ";
$querycus = mysqli_query($connect, $sqlcus);
$arraycus = mysqli_fetch_array($querycus);

$sqlcar = "select * from carorder where co_id= '".$arraygc['co_id']."' ";
$querycar = mysqli_query($connect, $sqlcar);
$arraycar = mysqli_fetch_array($querycar);

$sql_login = "select * from employee where emp_id='".$array['emp_id']."'";
$result_login = mysqli_query($connect, $sql_login);
$login = mysqli_fetch_array($result_login);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>HONDA Service</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/Honda-Motorcycle-Logo.png">
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <link rel="stylesheet" href="css/chosen/bootstrap-chosen.css">
    <link rel="stylesheet" href="css/select2/select2.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/buttons.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
</head>
<body  <?php if($_GET['option']=="p"){ echo "onload='window.print();' ";} ?> >
    <!--onload="window.print();"-->
    <?php
    $sqlst = "select * from store where sto_id= 'STO000001' ";
    $queryst = mysqli_query($connect, $sqlst);
    $arrayst = mysqli_fetch_array($queryst);
    ?>
<div class="row">
    <div class="col-md-12">
        <table class="table" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
                <td><center><img src="img/Honda-Motorcycle-Logo.png" width="150px"></center></td>
                <td colspan="2">
                    <h3><b><?=$arrayst['sto_name']?></b></h3>
                    <?=$arrayst['sto_add']?><br>
                     Tel: <?=$arrayst['sto_tel']?>
                </td>
            </tr>
        </table>
        <center><h3>ใบเสร็จรับเงิน</h3></center>
<br>
        <div class="col-md-12">
            <b>รหัสใบเสร็จ: </b><?=$array['pa_id']?>
        </div>
        <div class="col-md-12" >
            <b>วันที่ชำระ: </b><?=$array['pa_date']?>
        </div>
        <div class="col-md-12">
            <b>ลูกค้า: </b><?=$arraycus['cus_name']?>
        </div>
        <div class="col-md-12">
            <b>รุ่นรถ: </b><?=$arraycar['co_carmodel']?>
        </div>
    </div>
</div>
<div class="box-header " data-original-title="">
        <h2>รายการซ่อม</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead class="well">
                <tr>
                    <th class="text-center" >#</th>
                    <th class="text-center" >รหัส</th>
                    <th class="text-center" >รายการ</th>
                    <th class="text-center">ราคา</th>
                    <th class="text-center" width="200px">จำนวน</th>
                    <th class="text-center">ราคารวม</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $n = 0;
                $sql_list2= "select * from repair_checklist where re_id='".$array['re_id']."' ";
                $query_list2 = mysqli_query($connect, $sql_list2);
                if (mysqli_num_rows($query_list2) > 0 ) {
                    while ($array_list2 = mysqli_fetch_array($query_list2)) {
                        $n++;
                        $sqlch= "select * from checklist where ch_id='".$array_list2['ch_id']."'";
                        $querych = mysqli_query($connect, $sqlch);
                        $arraych = mysqli_fetch_array($querych);
                        ?>
                        <tr>
                            <td class="text-center"><?= $n; ?></td>
                            <td><?= $arraych['ch_id'] ?></td>
                            <td><?= $arraych['ch_list'] ?></td>
                            <td class="text-right"><?= number_format($array_list2['re_price']) ?> บาท</td>
                            <td class="text-right">-</td>
                            <td class="text-right"><?= number_format($array_list2['re_price'] ) ?> บาท</td>
                        </tr>
                        <?php
                        $alltotal+= $array_list2['re_price'];
                    }
                }
                $sql_list= "select * from repair_spareparts where re_id='".$array['re_id']."'";
                $query_list = mysqli_query($connect, $sql_list);
                if (mysqli_num_rows($query_list) > 0 ) {
                    while ($array_list = mysqli_fetch_array($query_list)) {
                        $n++;
                        $sqlsp= "select * from spareparts where sp_id='".$array_list['sp_id']."'";
                        $querysp = mysqli_query($connect, $sqlsp);
                        $arraysp = mysqli_fetch_array($querysp);
                        ?>
                        <tr>
                            <td class="text-center"><?= $n; ?></td>
                            <td><?= $arraysp['sp_id'] ?></td>
                            <td><?= $arraysp['sp_name'] ?></td>
                            <td class="text-right"><?= number_format($array_list['re_price']) ?> บาท</td>
                            <td class="text-right"><?= $array_list['re_num']?> ชิ้น</td>
                            <td class="text-right"><?= number_format($array_list['re_price']*$array_list['re_num'] ) ?> บาท</td>
                        </tr>
                        <?php
                        $alltotal+= $array_list['re_price']*$array_list['re_num'];
                    }
                }
                ?>
                <tr>
                    <td class="text-right" colspan="5">
                        รวม
                    </td>
                    <td class="text-right" ><?=number_format($alltotal)?> บาท</td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="clearfix"></div><br><br><br>
    <div style=" max-width: 500px">
        <center>
            ผู้ออกใบเสร็จ............................................................................<br><br>
            (คุณ<?=$login['emp_name']?>)
        </center>
    </div>
    <div class="clearfix"></div><br>
    <div style=" max-width: 500px">
        <center>
            ลูกค้า............................................................................<br><br>
            (คุณ<?=$arraycus['cus_name']?>)
        </center>
    </div>
    </div>
</body>
</html>
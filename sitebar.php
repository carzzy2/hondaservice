<?php
session_start();
include "config.php";
if($_SESSION['ss_login'] != session_id() or $_SESSION['ss_emp_id']==NULL ){
    echo "<script>alert('กรุณาลงชื่อเข้าสู่ระบบก่อน');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
    exit();
}
?>
<!doctype html>
<html class="no-js" lang="en">
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
    <script src="dist/excellentexport.js"></script>
</head>
<body>
<style>
    .text-center {
        text-align: center!important;
    }
    .text-right {
        text-align: right!important;
    }
    .container-fluid{
        padding-left: 0px;
        padding-right: 0px;
    }
    .btn-white{
        border-color: #ccc;
        color: black;
    }
    #custom-search-input{
        border: solid 1px #E4E4E4;
        border-radius: 6px;
        background-color: #fff;
    }

    #custom-search-input input{
        border: 0;
        box-shadow: none;
    }

    #custom-search-input button{
        margin: 2px 0 0 0;
        background: none;
        box-shadow: none;
        border: 0;
        color: #666666;
        padding: 0 8px 0 10px;
        border-left: solid 1px #ccc;
    }

    #custom-search-input button:hover{
        border: 0;
        box-shadow: none;
        border-left: solid 1px #ccc;
    }

    #custom-search-input .glyphicon-search{
        font-size: 23px;
    }
</style>
<?php
$sql_login = "select * from employee where emp_id='".$_SESSION['ss_emp_id']."'";
$result_login = mysqli_query($connect, $sql_login);
$login = mysqli_fetch_array($result_login);
if ($login['emp_position'] == "0") {
    $loginposition = "ผู้ดูแลระบบ";
} elseif ($login['emp_position'] == "1") {
    $loginposition = "พนักงาน";
}
?>
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="index.php"><img class="main-logo" src="img/Honda-Motorcycle-Logo.png" width="75px" alt="" /></a>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">

                    <li>
                        <a class="has-arrow" href="index.php">
                            <i class="fa big-icon fa-home icon-wrap"></i>
                            <span class="mini-click-non">ข้อมูลพื้นฐาน</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <?php if ($login['emp_position'] == "0") { ?>
                                <li><a href="employee_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลพนักงาน</span></a></li>
                            <?php } ?>
                            <li><a href="store.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลร้าน</span></a></li>
                            <li><a href="customer_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลลูกค้า</span></a></li>
                            <li><a href="car_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลรถ</span></a></li>
                            <li><a href="check_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลรายการตรวจเช็ค</span></a></li>
                            <li><a href="spareparts_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลอะไหล่</span></a></li>
                        </ul>
                    </li>
                    <li><a href="purchase_show.php" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">สั่งซื้ออะไหล่</span></a></li>
                    <li><a href="back_purchase_list.php" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">รับอะไหล่</span></a></li>
                    <li><a href="reservation_list.php" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">ยืนยันการจอง</span></a></li>

                    <li><a href="get_car_list.php" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">นำรถเข้ารับบริการ</span></a></li>
                    <li><a href="quene_list.php" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">จัดคิวเข้ารับบริการ</span></a></li>
                    <li><a href="repair_show.php" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">บันทึกการซ่อม</span></a></li>
                    <li><a href="pay_show.php" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">ชำระค่าซ่อมรถ</span></a></li>
                    <li><a href="backcar_show.php" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">รับรถ</span></a></li>
                </ul>
            </nav>
        </div>
    </nav>
</div>
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li><a data-toggle="collapse" data-target="#Charts" href="#">ข้อมูลพื้นฐาน <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul class="collapse dropdown-header-top">
                                    <?php if ($login['emp_position'] == "0") { ?>
                                        <li><a href="employee_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลพนักงาน</span></a></li>
                                    <?php } ?>
                                    <li><a href="store.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลร้าน</span></a></li>
                                    <li><a href="customer_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลลูกค้า</span></a></li>
                                    <li><a href="car_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลรถ</span></a></li>
                                    <li><a href="check_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลรายการตรวจเช็ค</span></a></li>
                                    <li><a href="spareparts_list.php"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">ข้อมูลอะไหล่</span></a></li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Pagemob" href="purchase_form.php">สั่งซื้ออะไหล่</a></li>
                            <li><a data-toggle="collapse" data-target="#Pagemob" href="#">รับอะไหล่</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
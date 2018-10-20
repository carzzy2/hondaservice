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
    <!-- favicon
		============================================ -->
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<style>
    .container-fluid{
        padding-left: 0px;
        padding-right: 0px;
    }
</style>
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
                            <li><a title="Dashboard v.1" href="index.html"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Dashboard v.1</span></a></li>
                            <li><a title="Dashboard v.1" href="index.html"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Dashboard v.1</span></a></li>
                            <li><a title="Dashboard v.1" href="index.html"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Dashboard v.1</span></a></li>
                            <li><a title="Dashboard v.1" href="index.html"><i class="fa fa-bullseye sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Dashboard v.1</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#" aria-expanded="false"><i class="fa big-icon fa-table icon-wrap" aria-hidden="true"></i><span class="mini-click-non">Data Tables</span></a></li>
                    <li><a href="#" aria-expanded="false"><i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Landing Page</span></a></li>
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
                            <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul class="collapse dropdown-header-top">
                                    <li><a href="index.html">Dashboard v.1</a></li>
                                    <li><a href="index-1.html">Dashboard v.2</a></li>
                                    <li><a href="index-3.html">Dashboard v.3</a></li>
                                    <li><a href="product-list.html">Product List</a></li>
                                    <li><a href="product-edit.html">Product Edit</a></li>
                                    <li><a href="product-detail.html">Product Detail</a></li>
                                    <li><a href="product-cart.html">Product Cart</a></li>
                                    <li><a href="product-payment.html">Product Payment</a></li>
                                    <li><a href="analytics.html">Analytics</a></li>
                                    <li><a href="widgets.html">Widgets</a></li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#demo" href="#">Mailbox <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul id="demo" class="collapse dropdown-header-top">
                                    <li><a href="mailbox.html">Inbox</a>
                                    </li>
                                    <li><a href="mailbox-view.html">View Mail</a>
                                    </li>
                                    <li><a href="mailbox-compose.html">Compose Mail</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#others" href="#">Miscellaneous <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul id="others" class="collapse dropdown-header-top">
                                    <li><a href="file-manager.html">File Manager</a></li>
                                    <li><a href="contacts.html">Contacts Client</a></li>
                                    <li><a href="projects.html">Project</a></li>
                                    <li><a href="project-details.html">Project Details</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                    <li><a href="404.html">404 Page</a></li>
                                    <li><a href="500.html">500 Page</a></li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">Interface <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul id="Miscellaneousmob" class="collapse dropdown-header-top">
                                    <li><a href="google-map.html">Google Map</a>
                                    </li>
                                    <li><a href="data-maps.html">Data Maps</a>
                                    </li>
                                    <li><a href="pdf-viewer.html">Pdf Viewer</a>
                                    </li>
                                    <li><a href="x-editable.html">X-Editable</a>
                                    </li>
                                    <li><a href="code-editor.html">Code Editor</a>
                                    </li>
                                    <li><a href="tree-view.html">Tree View</a>
                                    </li>
                                    <li><a href="preloader.html">Preloader</a>
                                    </li>
                                    <li><a href="images-cropper.html">Images Cropper</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Chartsmob" href="#">Charts <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul id="Chartsmob" class="collapse dropdown-header-top">
                                    <li><a href="bar-charts.html">Bar Charts</a>
                                    </li>
                                    <li><a href="line-charts.html">Line Charts</a>
                                    </li>
                                    <li><a href="area-charts.html">Area Charts</a>
                                    </li>
                                    <li><a href="rounded-chart.html">Rounded Charts</a>
                                    </li>
                                    <li><a href="c3.html">C3 Charts</a>
                                    </li>
                                    <li><a href="sparkline.html">Sparkline Charts</a>
                                    </li>
                                    <li><a href="peity.html">Peity Charts</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Tablesmob" href="#">Tables <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul id="Tablesmob" class="collapse dropdown-header-top">
                                    <li><a href="static-table.html">Static Table</a>
                                    </li>
                                    <li><a href="data-table.html">Data Table</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#formsmob" href="#">Forms <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul id="formsmob" class="collapse dropdown-header-top">
                                    <li><a href="basic-form-element.html">Basic Form Elements</a>
                                    </li>
                                    <li><a href="advance-form-element.html">Advanced Form Elements</a>
                                    </li>
                                    <li><a href="password-meter.html">Password Meter</a>
                                    </li>
                                    <li><a href="multi-upload.html">Multi Upload</a>
                                    </li>
                                    <li><a href="tinymc.html">Text Editor</a>
                                    </li>
                                    <li><a href="dual-list-box.html">Dual List Box</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Appviewsmob" href="#">App views <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul id="Appviewsmob" class="collapse dropdown-header-top">
                                    <li><a href="basic-form-element.html">Basic Form Elements</a>
                                    </li>
                                    <li><a href="advance-form-element.html">Advanced Form Elements</a>
                                    </li>
                                    <li><a href="password-meter.html">Password Meter</a>
                                    </li>
                                    <li><a href="multi-upload.html">Multi Upload</a>
                                    </li>
                                    <li><a href="tinymc.html">Text Editor</a>
                                    </li>
                                    <li><a href="dual-list-box.html">Dual List Box</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                <ul id="Pagemob" class="collapse dropdown-header-top">
                                    <li><a href="login.html">Login</a>
                                    </li>
                                    <li><a href="register.html">Register</a>
                                    </li>
                                    <li><a href="lock.html">Lock</a>
                                    </li>
                                    <li><a href="password-recovery.html">Password Recovery</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
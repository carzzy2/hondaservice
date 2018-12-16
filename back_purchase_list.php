<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<?php
unset($_SESSION['ss_sp_id']);
unset($_SESSION['ss_sp_num']);
?>

<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>รับอะไหล่</h4>
        <div class="row">
            <div class="col-md-4">
                <div id="custom-search-input" >
                    <form method="GET"  name="frmSearch">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-lg" name="search" value="<?=$_GET['search']?>" placeholder="Search..." />
                            <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                        </div>
                    </form>
                </div>
            </div>
        </div><div class="clearfix"></div><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รหัสสั่งซื้อ</th>
                        <th class="text-center">วันที่สั่งซื้อ</th>
                        <th class="text-center">พนักงาน</th>
                        <th class="text-center">ตัวแทน</th>
                        <th class="text-center">จำนวนเงิน</th>
                        <th class="text-center">จัดการข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    if (isset($_GET['search'])) {
                        $sql = "select * from purchase_order where po_status = 0  and po_id like '%" . $_GET['po_id'] . "%'  order by po_id desc";
                    } else {
                        $sql = "select * from purchase_order where po_status = 0 order by po_id desc";
                    }
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            $sql2= "select * from employee where emp_id='" . $array['emp_id'] . "'";
                            $query2 = mysqli_query($connect, $sql2);
                            $array2 = mysqli_fetch_array($query2);

                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td ><?= $array['po_id'] ?></td>
                                <td><?= FormatDay($array['po_date']) ?></td>
                                <td><?= $array2['emp_name'] ?></td>
                                <td><?= $array['po_agent'] ?></td>
                                <td class="text-right"><?= number_format($array['po_total']) ?> บาท</td>
                                <td style="padding-left: 25px" class="text-center">
                                    <a data-toggle="tooltip" href="back_purchase_form.php?id=<?= $array['po_id'] ?>" class="btn btn-default" data-original-title="GetBack"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
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
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

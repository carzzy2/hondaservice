<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>ช้อมูลลูกค้า</h4>
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
<!--            <div class="col-md-8">-->
<!--                <div class="pull-right">-->
<!--                    <a data-toggle="tooltip" href="customer_form.php" class="btn btn-primary btn-custon-rounded-two" data-original-title="เพิ่มข้อมูล">-->
<!--                        <i class="fa fa-sign-in "></i> เพิ่มข้อมูล-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
        </div><div class="clearfix"></div><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รหัสสมาชิก</th>
                        <th class="text-center">ชื่อ-นามสกุล</th>
                        <th class="text-center">ที่อยู่</th>
                        <th class="text-center">เบอร์โทรศัพท์</th>
                        <th class="text-center">จัดการข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    if (isset($_GET['search'])) {
                        $sql = "select * from customer where  cus_id like '%" . $_GET['search'] . "%' "
                            . "or cus_name like '%" . $_GET['search'] . "%' "
                            . "or cus_add like '%" . $_GET['search'] . "%' "
                            . "or cus_tel like '%" . $_GET['search'] . "%' order by cus_id asc";
                    } else {
                        $sql = "select * from customer order by cus_id asc";
                    }
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td ><?= $array['cus_id'] ?></td>
                                <td><?= $array['cus_name'] ?></td>
                                <td><?= $array['cus_add'] ?></td>
                                <td><?= $array['cus_tel'] ?></td>
                                <td class="text-center">
                                    <a data-toggle="tooltip" href="customer_form.php?mode=edit&id=<?= $array['cus_id'] ?>" class="btn btn-default" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a data-toggle="tooltip" href="customer_save.php?mode=delete&id=<?= $array['cus_id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลนี่ ? ')" class="btn btn-default" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
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
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

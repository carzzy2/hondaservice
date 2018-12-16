<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>ช้อมูลรถ</h4>
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
            <div class="col-md-8">
                <div class="pull-right">
                    <a data-toggle="tooltip" href="car_form.php" class="btn btn-primary btn-custon-rounded-two" data-original-title="เพิ่มข้อมูล">
                        <i class="fa fa-sign-in "></i> เพิ่มข้อมูล
                    </a>
                </div>
            </div>
        </div><div class="clearfix"></div><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รหัสรถ</th>
                        <th class="text-center">ชื่อรุ่น</th>
                        <th class="text-center">รายละเอียด</th>
                        <th class="text-center">จัดการข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    if (isset($_GET['search'])) {
                        $sql = "select * from carorder where  co_id like '%" . $_GET['search'] . "%' "
                            . "or co_carmodel like '%" . $_GET['search'] . "%' "
                            . "or co_description like '%" . $_GET['search'] . "%'  order by co_id asc";
                    } else {
                        $sql = "select * from carorder order by co_id asc";
                    }
                    $query = mysqli_query($connect, $sql);
                    $row = mysqli_num_rows($query);
                    if ($row > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td ><?= $array['co_id'] ?></td>
                                <td><?= $array['co_carmodel'] ?></td>
                                <td><?= $array['co_description'] ?></td>
                                <td  style="padding-left: 25px">
                                    <a data-toggle="tooltip" href="car_form.php?mode=edit&id=<?= $array['co_id'] ?>" class="btn btn-default" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a data-toggle="tooltip" href="car_save.php?mode=delete&id=<?= $array['co_id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลนี่ ? ')" class="btn btn-default" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <th style="text-align: center;color: red;" colspan="5"> ไม่พบข้อมูล</th>
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
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

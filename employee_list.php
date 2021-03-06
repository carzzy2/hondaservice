<?php include "sitebar.php"; ?>
<?php include "header.php"; ?>
<div class="container-fluid">
    <div class="product-status-wrap">
        <h4>ช้อมูลพนักงาน</h4>
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
                    <a data-toggle="tooltip" href="employee_form.php" class="btn btn-primary btn-custon-rounded-two" data-original-title="เพิ่มข้อมูล">
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
                        <th class="text-center">รหัสพนักงาน</th>
                        <th class="text-center">ชื่อ-นามสกุล</th>
                        <th class="text-center">ที่อยู่</th>
                        <th class="text-center">เบอร์โทรศัพท์</th>
                        <th class="text-center">ตำแหน่ง</th>
                        <th class="text-center">จัดการข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    if (isset($_GET['search'])) {
                        $sql = "select * from employee where  emp_id like '%" . $_GET['search'] . "%' "
                            . "or emp_name like '%" . $_GET['search'] . "%' "
                            . "or emp_add like '%" . $_GET['search'] . "%' "
                            . "or emp_tel like '%" . $_GET['search'] . "%' order by emp_id asc";
                    } else {
                        $sql = "select * from employee order by emp_id asc";
                    }
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) > 0 ) {
                        while ($array = mysqli_fetch_array($query)) {
                            $n++;
                            if($array['emp_position']=='0'){
                                $status='ผู้ดูแลระบบ';
                            }elseif($array['emp_position']=='2'){
                                $status='ผู้บริหาร';
                            }else{
                                $status='พนักงาน';
                            }
                            ?>
                            <tr>
                                <td class="text-center" scope="row"><?= $n; ?></td>
                                <td ><?= $array['emp_id'] ?></td>
                                <td><?= $array['emp_name'] ?></td>
                                <td><?= $array['emp_add'] ?></td>
                                <td><?= $array['emp_tel'] ?></td>
                                <td><?= $status ?></td>
                                <td style="padding-left: 25px">
                                    <a data-toggle="tooltip" href="employee_form.php?mode=edit&id=<?= $array['emp_id'] ?>" class="btn btn-default" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <?php if($array['emp_id'] != $_SESSION['ss_emp_id']){ ?>
                                        <a  data-toggle="tooltip" href="employee_save.php?mode=delete&id=<?= $array['emp_id'] ?>" onclick="return confirm('คุณต้องการลบข้อมูลนี่ ? ')" class="btn btn-default" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    <?php } ?>
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

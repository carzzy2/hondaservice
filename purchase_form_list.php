<?php
session_start();
include "config.php";
if($_GET['mode']=="add"){
    if (count($_SESSION['ss_sp_id']) == 0) {
        $_SESSION['ss_sp_id'][]=$_GET['id'];
        $_SESSION['ss_sp_num'][]=1;
    }else{
        if(in_array($_GET['id'], $_SESSION['ss_sp_id'])){
            echo "<script>alert('คุณได้เลือกรายการซ้ำ');</script>";
        }
        if (!in_array($_GET['id'], $_SESSION['ss_sp_id'])) {
            $_SESSION['ss_sp_id'][]=$_GET['id'];
            $_SESSION['ss_sp_num'][]=1;
        }

    }
}elseif($_GET['mode']=="del"){// delete listdata
    foreach ($_SESSION['ss_sp_id'] as $key => $val){
        if($val==$_GET['id']){
            unset($_SESSION['ss_sp_id'][$key]);
            unset($_SESSION['ss_sp_num'][$key]);
        }
    }
}
?>

<div class="row">
<div class="col-md-12">
    <table class="table table-striped table-hover">
        <thead >
        <tr>
            <th class="text-center" >#</th>
            <th class="text-center" >รหัสอะไหล่</th>
            <th class="text-center" >รายการ</th>
            <th class="text-center" >รายละเอียด</th>
            <th class="text-center">ราคา</th>
            <th class="text-center" width="200px">จำนวน</th>
            <th class="text-center">จัดการข้อมูล</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n = 0;
        if (count($_SESSION['ss_sp_id']) == 0) {
            ?>
            <tr>
                <th style="text-align: center;" colspan="7"> ยังไม่มีรายการ</th>
            </tr>
            <?php
        } else {
            foreach ($_SESSION['ss_sp_id'] as $key => $val) {
                $n++;
                $sqlsp= "select * from spareparts where sp_id='".$_SESSION['ss_sp_id'][$key]."'";
                $querysp = mysqli_query($connect, $sqlsp);
                $arraysp = mysqli_fetch_array($querysp);
                ?>
                <tr>
                    <td class="text-center"><?= $n; ?></td>
                    <td><?= $_SESSION['ss_sp_id'][$key] ?></td>
                    <td><?= $arraysp['sp_name'] ?></td>
                    <td><?= $arraysp['sp_description'] ?></td>
                    <td class="text-right"><?= $arraysp['sp_price'] ?> บาท</td>
                    <td class="text-right"><input class="form-control text-right" name="po_count[<?=$key?>]" type="number" min="1" value="<?= $_SESSION['ss_sp_num'][$key] ?>"></td>
                    <td class="text-center">
                        <a href="#" class="btn btn-danger DelList" data-url="purchase_form_list.php?mode=del&id=<?=$_SESSION['ss_sp_id'][$key]?>">ลบข้อมูล</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </tbody>
    </table>
</div>
<div class="col-md-12">
    <div class="form-group-inner">
        <div class="login-btn-inner">
            <div class="login-horizental cancel-wp text-center">
                <a class="btn btn-white" href="purchase_show.php">ยกเลิก</a>
                <?php
                if (count($_SESSION['ss_sp_id']) == 0) {
                    $dis = 'disabled';
                }else{
                    $dis = '';
                }
                    ?>
                <button class="btn btn-sm btn-primary login-submit-cs" type="submit" <?=$dis?>>ถัดไป</button>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $(".DelList").click(function(){
            var url = $(this).attr('data-url');
            $.ajax({
                type: "GET",
                url: url,
                success: function(result){
                    $("#data-list").html(result);
                }
            });
        });

    });
</script>


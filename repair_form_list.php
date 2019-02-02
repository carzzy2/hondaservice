<?php
session_start();
include "config.php";
if(!empty($_POST['sp_count'])){
    foreach ($_SESSION['ss_sp_id'] as $key => $val) {
        $_SESSION['ss_sp_num'][$key] = $_POST['sp_count'][$key];
    }
}
if($_GET['mode']=="add"){// add item
    if($_GET['ch']=="1"){
        if (count($_SESSION['ss_ch_id']) == 0) {
            $_SESSION['ss_ch_id'][]=$_GET['id'];
        }else{
            if(in_array($_GET['id'], $_SESSION['ss_ch_id'])){
                echo "<script>alert('คุณได้เลือกรายการซ้ำ');</script>";
            }
            if (!in_array($_GET['id'], $_SESSION['ss_ch_id'])) {
                $_SESSION['ss_ch_id'][]=$_GET['id'];
            }
        }
    }elseif($_GET['ch']=="2"){
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
    }
}elseif($_GET['mode']=="del"){// delete item
    if($_GET['ch']=="1"){
        foreach ($_SESSION['ss_ch_id'] as $key => $val){
            if($val==$_GET['id']){
                unset($_SESSION['ss_ch_id'][$key]);
            }
        }
    }elseif($_GET['ch']=="2"){
        foreach ($_SESSION['ss_sp_id'] as $key => $val){
            if($val==$_GET['id']){
                unset($_SESSION['ss_sp_id'][$key]);
                unset($_SESSION['ss_sp_num'][$key]);
            }
        }
    }
}
?>

<div class="container">
<div class="col-md-12">
    <table class="table table-bordered table-hover">
        <thead >
        <tr>
            <th class="text-center" >#</th>
            <th class="text-center" >รหัส</th>
            <th class="text-center" >รายการ</th>
            <th class="text-center">ราคา(บาท)</th>
            <th class="text-center" width="200px">จำนวน</th>
            <th class="text-center">จัดการข้อมูล</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n = 0;
        if (count($_SESSION['ss_ch_id']) == 0 and count($_SESSION['ss_sp_id']) == 0) {
            ?>
            <tr>
                <th style="text-align: center;" colspan="6"> ยังไม่มีรายการ</th>
            </tr>
            <?php
        } else {

            if (count($_SESSION['ss_ch_id']) > 0) {

                foreach ($_SESSION['ss_ch_id'] as $key => $val) {
                    $n++;
                    $sqlch = "select * from checklist where ch_id='" . $_SESSION['ss_ch_id'][$key] . "'";
                    $querych = mysqli_query($connect, $sqlch);
                    $arraych = mysqli_fetch_array($querych);
                    ?>
                    <tr>
                        <td class="text-center"><?= $n; ?></td>
                        <td class="text-center"><?= $_SESSION['ss_ch_id'][$key] ?></td>
                        <td><?= $arraych['ch_list'] ?></td>
                        <td class="text-right">
                            <?= $arraych['ch_price'] ?>
                            <input type="hidden" name="ch_price[<?=$key?>]" value="<?= $arraych['ch_price'] ?>" >
                        </td>
                        <td class="text-right">-</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-danger DelList"
                               data-url="repair_form_list.php?ch=1&mode=del&id=<?= $_SESSION['ss_ch_id'][$key] ?>">ลบข้อมูล</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            if(count($_SESSION['ss_sp_id'])> 0){
                foreach ($_SESSION['ss_sp_id'] as $key => $val) {
                    $n++;
                    $sqlsp= "select * from spareparts where sp_id='".$_SESSION['ss_sp_id'][$key]."'";
                    $querysp = mysqli_query($connect, $sqlsp);
                    $arraysp = mysqli_fetch_array($querysp);
                    ?>
                    <tr>
                        <td class="text-center"><?= $n; ?></td>
                        <td class="text-center"><?= $_SESSION['ss_sp_id'][$key] ?></td>
                        <td><?= $arraysp['sp_name'] ?></td>
                        <td class="text-right">
                            <?= $arraysp['sp_price'] ?>
                            <input type="hidden" name="sp_price[<?=$key?>]" value="<?= $arraysp['sp_price'] ?>">
                        </td>
                        <td class="text-right">
                            <input class="form-control text-right count" name="sp_count[<?=$key?>]" type="number" min="1" max="<?= $arraysp['sp_num'] ?>" value="<?= $_SESSION['ss_sp_num'][$key] ?>">
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-danger DelList" data-url="repair_form_list.php?ch=2&mode=del&id=<?=$_SESSION['ss_sp_id'][$key]?>">ลบข้อมูล</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr>
                <td class="text-right" colspan="5">
                    รวม
                    <input type="hidden" id="texttotal" name="re_total">
                </td>
                <td class="text-right" id="alltotal"></td>

            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<div class="col-md-12">
    <div class="form-group-inner">
        <div class="login-btn-inner">
            <div class="login-horizental cancel-wp text-center">
                <a class="btn btn-white" href="repair_show.php">ยกเลิก</a>
                <?php
                if (count($_SESSION['ss_sp_id']) == 0 and count($_SESSION['ss_ch_id']) == 0) {
                    $dis = 'disabled';
                }else{
                    $dis = '';
                }
                    ?>
                <button class="btn btn-sm btn-primary login-submit-cs" type="submit" <?=$dis?>>บันทึก</button>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        gettotal();
        $(".count").bind('keyup mouseup change', function () {
            gettotal();
        });
        function gettotal(){
            var data = $('form').serializeArray();
            $.ajax({
                type: "POST",
                url: 'repair_con.php',
                data:data,
                success: function(result){
                    $("#alltotal").html(result+' บาท');
                    $("#texttotal").val(result);
                }
            });
        }
        $(".DelList").click(function(){
            var url = $(this).attr('data-url');
            var data = $('form').serializeArray();
            $.ajax({
                type: "GET",
                url: url,
                data:data,
                success: function(result){
                    $("#data-list").html(result);
                }
            });
        });

    });
</script>


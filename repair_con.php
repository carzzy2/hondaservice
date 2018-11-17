<?php
$total = 0;
if(isset($_POST['ch_price']) and count($_POST['ch_price'])>0) {
    foreach ($_POST['ch_price'] as $key => $val) {
        $total += $_POST['ch_price'][$key];
    }
}
if(isset($_POST['sp_price']) and count($_POST['sp_price'])>0){
    foreach ($_POST['sp_price'] as $key => $val) {
        $total+= $_POST['sp_price'][$key] * $_POST['sp_count'][$key];
    }
}

echo $total;
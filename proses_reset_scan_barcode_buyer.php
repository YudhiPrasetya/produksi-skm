<?php 

require_once 'core/init.php';

    if($_POST['type'] == 'reset'){
        $trx_kenzin = $_POST['trx_kenzin'];
        $trx_packing = $_POST['trx_packing'];
        $username = $_SESSION['username'];

        if(kirim_data_transaksi_delete_kenzin_packing($trx_kenzin, $username)){
            if($trx_packing != ''){
                if(delete_transaksi_kenzin($trx_kenzin) && delete_transaksi_packing($trx_kenzin)){
                    echo "success";
                }else{
                    echo "errorDB";
                }
            }else{
                if(delete_transaksi_kenzin($trx_kenzin)){
                    echo "success";
                }else{
                    echo "errorDB";
                }
            }
        }else{
            "gagal_backup";
        }
        

    }
?>
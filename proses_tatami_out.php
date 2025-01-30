<?php

  require_once 'core/init.php';

    $kode_barcode = $_POST['isi_barcode'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
    $qty     = 1;
    $user = $_POST['user'];
     
    $data1 = tampilkan_data_temp_tatami_out($user);
    $temp = mysqli_fetch_array($data1);
    if($temp['data_no'] > 0){
      $data3 = tampilkan_no_transaksi_tatami_out0($user);
        $trx2 = mysqli_fetch_array($data3);
        $no_trx=$trx2['no_trx'];
    }else{
      $data2 = tampilkan_no_transaksi_tatami_out($user);
      $trx = mysqli_fetch_array($data2);
        $no_trx=$trx['no_trx'];
        $no_trx+=1;
    }
  

    // tampilkan detail qty order 
    $totalQty = tampilkanQtyOrder($kode_barcode);
    $dataQtyOrder = mysqli_fetch_array($totalQty);
    $qtyOrder = $dataQtyOrder['qty_order'];

    //mencari qty kenzin
    $transaksi = tampilkanQtyTatamiInFull($kode_barcode);
    $datatrx = mysqli_fetch_array($transaksi);
    $data_tatami_in = $datatrx['qty_tatami_in'];

     //mencari qty kenzin
     $transaksi = tampilkanQtyTatamiOutFull($kode_barcode);
     $datatrx2 = mysqli_fetch_array($transaksi);
     $data_tatami_out = $datatrx2['qty_tatami_out'];

    if($data_tatami_out < $qtyOrder){
        if($data_tatami_out < $data_tatami_in){    
            if(tambah_data_temp_tatami_out($tanggal, $jam, $kode_barcode, $qty, $no_trx, $user)){
                $pesan = "success";
            }else {
                $pesan = "errorDb";
            }
        }else{
            $pesan = "errorQtyPrev";
        }    
    }else{
        $pesan = "errorQtyOrder";
    }

echo $pesan;

 
?>

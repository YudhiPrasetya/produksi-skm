<?php

  require_once 'core/init.php';

    $kode_barcode = $_POST['isi_barcode'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
    $qty     = 1;
    $user = $_POST['user'];
     
    $data1 = tampilkan_data_temp_reject_tatami($user);
    $temp = mysqli_fetch_array($data1);
    if($temp['data_no'] > 0){
        $no_trx=$temp['data_no'];
    }else{
      $data2 = tampilkan_no_transaksi_reject_tatami($user);
      $trx = mysqli_fetch_array($data2);
        $no_trx=$trx['no_trx'];
        $no_trx+=1;
    }
    
  

    // tampilkan detail qty order 
    $dataOrder = tampilkanDataOrder($kode_barcode);
    $data2 = mysqli_fetch_array($dataOrder);
    $barcode_costomer = $data2['barcode_costomer'];
    $style = $data2['id_style'];
    $orc = $data2['orc'];
    $size = $data2['size'];

    // if($barcode_costomer == 'y'){

    // }else{

    // }

    //mencari transaksi scan tatami in
    $transaksi = tampilkanQtyRejectTatamiFull($kode_barcode);
    $datatrx = mysqli_fetch_array($transaksi);
    $data_tatami_reject = $datatrx['qty_tatami_reject'];

    //mencari qty kenzin
    $transaksi = tampilkanQtyTatamiIn($kode_barcode);
    $datatrx = mysqli_fetch_array($transaksi);
    $data_tatami_in = $datatrx['qty_tatami_in'];

    if($data_tatami_reject < $data_tatami_in){  
      if(tambah_data_temp_tatami_reject($tanggal, $jam, $kode_barcode, $qty, $no_trx, $user)){
        $pesan = "success";
      }else {
        $pesan = "errorDb";
      }
    }else{
      $pesan = "errorQtyOrder";
    }

echo $pesan;

 
?>

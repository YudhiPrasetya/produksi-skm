<?php

  require_once 'core/init.php';

    $kode_barcode = $_POST['isi_barcode'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
    $orc = $_POST['orc']; 
    $qty     = 1;
    $user = $_POST['user'];
     
    $data1 = tampilkan_data_temp_qcfinal($user);
    $temp = mysqli_fetch_array($data1);
    if($temp['data_no'] > 0){
      $data3 = tampilkan_no_transaksi_qcfinal0($user);
        $trx2 = mysqli_fetch_array($data3);
        $no_trx=$trx2['no_trx'];
    }else{
      $data2 = tampilkan_no_transaksi_qcfinal($user);
      $trx = mysqli_fetch_array($data2);
        $no_trx=$trx['no_trx'];
        $no_trx+=1;
    }
  

    // tampilkan detail barang dari kode barcode
    $barang = tampilkanBarangStyleSize($kode_barcode);
    $dataBarang = mysqli_fetch_array($barang);
    $style = $dataBarang['id_style'];
    $size = $dataBarang ['size'];

    // tampilkan detail qty order label
    $totalQty = tampilkanQtyOrderBarcodeBuyer($orc, $style, $size);
    $dataQtyOrder = mysqli_fetch_array($totalQty);
    $qtyOrder = $dataQtyOrder['qty_order'];

    //mencari qty kenzin
    $qcfinal = tampilkanQtyQcFinalfull($orc, $kode_barcode);
    $dataQcFinal = mysqli_fetch_array($qcfinal);
    $qtyQcFinal = $dataQcFinal['qty_qcfinal'];

    if($qtyQcFinal < $qtyOrder){  
      if(tambah_data_temp_qcfinal($tanggal, $jam, $kode_barcode, $orc, $qty, $no_trx, $user)){
        $pesan = "success";
      }else {
        $pesan = "errorDb";
      }
    }else{
      $pesan = "errorQtyOrder";
    }

echo $pesan;

 
?>

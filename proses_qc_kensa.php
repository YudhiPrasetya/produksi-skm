<?php

  require_once 'core/init.php';

    $kode_barcode = $_POST['isi_barcode'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
    $qty     = 1;
    $user = $_POST['user'];
     
    $data1 = tampilkan_data_temp_qc_kensa($user);
    $temp = mysqli_fetch_array($data1);
    if($temp['data_no'] > 0){
        $no_trx=$temp['data_no'];
    }else{
      $data2 = tampilkan_no_transaksi_qc_kensa($user);
      $trx = mysqli_fetch_array($data2);
        $no_trx=$trx['no_trx'];
        $no_trx+=1;
    }
  

    // tampilkan detail qty order 
    $totalQty = tampilkanQtyOrder($kode_barcode);
    $dataQtyOrder = mysqli_fetch_array($totalQty);
    $qtyOrder = $dataQtyOrder['qty_order'];

    //mencari qty qc_kensa full
    $transaksi = tampilkanQtyQcKensaFull($kode_barcode);
    $datatrx = mysqli_fetch_array($transaksi);
    $data_qc_kensa = $datatrx['qty_qc_kensa'];

    //mencari qty temp_qc_kensa_user
    $temp_qc_kensa = tampilkanQtyTempQCKensaUser($kode_barcode, $user);
    $datatrx2 = mysqli_fetch_array($temp_qc_kensa);
    $qty_temp = $datatrx2['qty_qc_kensa'];
    $update_qty_tambah = $qty_temp + 1;
    // $pesan = $update_qty_tambah;

    if($data_qc_kensa < $qtyOrder){ 
      if(cek_scan_qc_kensa($kode_barcode, $user) == 0){  
        if(tambah_data_temp_qc_kensa($tanggal, $jam, $kode_barcode, $qty, $no_trx, $user)){
          $pesan = "success";
        }else {
          $pesan = "errorDb";
        }
      }else{
        if(update_tambah_qty_temp_qc_kensa($tanggal, $jam, $kode_barcode, $user, $update_qty_tambah)){
          $pesan = "success";
        }else {
          $pesan = "errorDb";
        }
      }
    }else{
      $pesan = "errorQtyOrder";
    }

echo $pesan;

 
?>

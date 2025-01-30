<?php

  require_once 'core/init.php';

    $kode_barcode = $_POST['isi_barcode'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
    $qty     = 1;
    $user = $_POST['user'];
     
    $data1 = tampilkan_data_temp_tatami_in($user);
    $temp = mysqli_fetch_array($data1);
    if($temp['data_no'] > 0){
      $data3 = tampilkan_no_transaksi_tatami_in0($user);
        $trx2 = mysqli_fetch_array($data3);
        $no_trx=$trx2['no_trx'];
    }else{
      $data2 = tampilkan_no_transaksi_tatami_in($user);
      $trx = mysqli_fetch_array($data2);
        $no_trx=$trx['no_trx'];
        $no_trx+=1;
    }
  

    // tampilkan detail qty order 
    $totalQty = tampilkanQtyOrder($kode_barcode);
    $dataQtyOrder = mysqli_fetch_array($totalQty);
    $qtyOrder = $dataQtyOrder['qty_order'];

    //mencari qty qc kensa
    $qtyBefore = tampilkanQtyScanQCKensa($kode_barcode);
    $dataBefore = mysqli_fetch_array($qtyBefore);
    $qtyQcKensa = $dataBefore['qty_qc_kensa'];

    //mencari qty before kecuali ganti label
    $qtyReject1 = tampilkanQtyToRejectQcKensa($kode_barcode);
    $dataReject1 = mysqli_fetch_array($qtyReject1);
    $qtyRejectToKensa = $dataReject1['qty_reject_tatami'];

    //mencari qty before kecuali ganti label
    $qtyReject2 = tampilkanQtyToRejectQcKensaGantiLabel($kode_barcode);
    $dataReject2 = mysqli_fetch_array($qtyReject2);
    $qtyQcGantiLabel = $dataReject2['qty_reject_tatami'];

    $qtyBeforeAll = $qtyQcKensa + $qtyRejectToKensa - $qtyQcGantiLabel;

    //mencari qty kenzin
    $transaksi = tampilkanQtyTatamiInFull($kode_barcode);
    $datatrx = mysqli_fetch_array($transaksi);
    $data_tatami_in = $datatrx['qty_tatami_in'];

     //mencari qty temp_qc_kensa_user
     $temp_tatami_in = tampilkanQtyTempTatamiInUser($kode_barcode, $user);
     $datatrx2 = mysqli_fetch_array($temp_tatami_in);
     $qty_temp = $datatrx2['qty_tatami_in'];
     $update_qty_tambah = $qty_temp + 1;
     // $pesan = $update_qty_tambah;
    
      if($data_tatami_in < $qtyBeforeAll){
        if($data_tatami_in < $qtyOrder){
          if(cek_scan_tatami_in($kode_barcode, $user) == 0){    
            if(tambah_data_temp_tatami_in($tanggal, $jam, $kode_barcode, $qty, $no_trx, $user)){
              $pesan = "success";
            }else {
              $pesan = "errorDb";
            }
          }else{
            if(update_tambah_qty_temp_qc_tatami_in($tanggal, $jam, $kode_barcode, $user, $update_qty_tambah)){
              $pesan = "success";
            }else {
              $pesan = "errorDb";
            }
          }
        }else{
          $pesan = "errorQtyOrder";
        }
      }else{
        $pesan = "errorQtyBefore";
      }
  

echo $pesan;

 
?>

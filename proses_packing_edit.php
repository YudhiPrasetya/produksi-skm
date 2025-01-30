<?php

  require_once 'core/init.php';

    $kode_barcode = $_POST['isi_barcode'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
    $orc = $_POST['orc']; 
    $qty     = 1;
    $user = $_POST['user'];
    $trx = $_POST['trx'];


    $kelompok = cekKelompokTrx($trx);
    $dataKelompok = mysqli_fetch_array($kelompok);
    $kelompokTrx = $dataKelompok['kelompok'];

    // tampilkan detail barang dari kode barcode
    $barang = tampilkanBarangStyleSize($kode_barcode);
    $dataBarang = mysqli_fetch_array($barang);
    $style = $dataBarang['id_style'];
    $size = $dataBarang ['size'];

    // tampilkan detail qty order label
    $totalQty = tampilkanQtyOrderBarcodeBuyer($orc, $style, $size);
    $dataQtyOrder = mysqli_fetch_array($totalQty);
    $qtyOrder = $dataQtyOrder['qty_order'];

    //mencari qty Kenzin
    $qtyBefore = tampilkanQtykenzin($orc, $kode_barcode);
    $dataBefore = mysqli_fetch_array($qtyBefore);
    $qtyKenzin = $dataBefore['qty_kenzin'];

    //mencari qty packing
    $qcPacking = tampilkanQtyPackingfull($orc, $kode_barcode);
    $dataPacking = mysqli_fetch_array($qcPacking);
    $qtyPacking = $dataPacking['qty_packing'];

    //mencari qty packing no trx
    $edit_packing = tampilkanQtyPackingNoTrx($orc, $kode_barcode, $trx);
    $datatrx2 = mysqli_fetch_array($edit_packing);
    $qty_temp = $datatrx2['qty_packing'];
    $update_qty_tambah = $qty_temp + 1;
    // $pesan = $update_qty_tambah;

    if($qtyPacking < $qtyKenzin){  
      if($qtyPacking < $qtyOrder){
        if(cek_scan_packing_edit($orc, $kode_barcode, $trx) == 0){
          if(tambah_data_packing($tanggal, $jam, $kode_barcode, $orc, $qty, $trx, $user, $kelompokTrx)){
            $pesan = "success";
          }else {
            $pesan = "errorDb";
          }
        }else{
          if(update_tambah_qty_transaksi_packing($tanggal, $jam, $orc, $kode_barcode, $trx, $update_qty_tambah)){
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

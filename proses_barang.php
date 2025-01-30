<?php
  require_once 'core/init.php';

  $kode_barcode = $_POST['isi_barcode'];
  $style = $_POST['id_style'];
  $warna = $_POST['warna'];
  $size = $_POST['size']; 
  $cup = $_POST['cup']; 
  $qty_barcode = $_POST['qty_barcode'];

if(!empty(trim($kode_barcode)) && !empty(trim($style)) && !empty(trim($warna)) && !empty(trim($size)) && !empty(trim($qty_barcode))){
  if(cek_kode_barcode_barang($kode_barcode) == 0){
    if(tambah_data_barang($kode_barcode, $style, $warna, $size, $cup, $qty_barcode)){
      echo "true";
    }else {
      echo "error";
    }
  }else{
    echo "duplicate";
  }
}else{
  echo "kosong";
}

?>

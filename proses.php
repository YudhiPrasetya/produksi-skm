<?php
  require_once 'core/init.php';

  $kode_barcode = $_POST['isi_barcode'];
    $tanggal = date("Y-m-d");;
    $jam     = date("H:i:s");
    $no_po = $_POST['id_po'];
    $qty     = 1;


  if(tambah_data_temp_kenzin($tanggal, $jam, $kode_barcode, $no_po, $qty )){
  echo "true";
  }else {
  echo "error";
}

?>

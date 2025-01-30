<?php

  require_once 'core/init.php';

  $kode_barcode = $_POST['isi_barcode'];
    $tanggal = date("Y-m-d");;
    $jam     = date("H:i:s");
    $orc = $_POST['orc'];
    $tolabel = $_POST['to_label'];
    $qty     = 1; 

    //mencari qty kenzin
    $kenzin = tampilkanQtykenzin($orc, $kode_barcode);
    $dataKenzin = mysqli_fetch_array($kenzin);
    $qtyKenzin = $dataKenzin['qty_kenzin'];

    //mencari qty ganti label
    $gantiLabel = tampilkanQtyGantiLabelfull($orc, $kode_barcode);
    $dataGantiLabel = mysqli_fetch_array($gantiLabel);
    $QtyGantiLabel = $dataGantiLabel['qty_gantilabel'];
    //totalscankenzin
    $totalKenzin = $qtyKenzin - $QtyGantiLabel;

    //tampilkan detail qty packing 
    $totalScan = tampilkanQtyScanLabel($orc, $kode_barcode);
    $dataScanPacking = mysqli_fetch_array($totalScan);
    $totalQtyScanPacking = $dataScanPacking['totalpacking'];
    $sisaStokKenzin = $totalKenzin - $totalQtyScanPacking;

    if(!empty(trim($orc)) && !empty(trim($tolabel)) ){
      if($sisaStokKenzin > 0){
          if(tambah_data_temp_ganti_label($tanggal, $jam, $kode_barcode, $orc, $tolabel, $qty)){
            $pesan = "success";
          }else{
            $pesan = "errorDb";
          }
        }else{
          $pesan = "errorQty";
        }
    }else{
      $pesan = "label";
    }
    
    echo $pesan;

?>

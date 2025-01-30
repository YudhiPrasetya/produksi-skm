<?php

  require_once 'core/init.php';
 
  //proses insert 
  if($_POST['type'] == 'insert'){
        $kode_barcode = $_POST['isi_barcode'];
        $tanggal = date("Y-m-d");
        $jam     = date("H:i:s");
        $orc = $_POST['orc']; 
       
        $user = $_POST['user'];
        $kelompok = $_POST['kelompok'];
        $qty_karton = $_POST['qty_karton'];
        $isi_karton = $_POST['isi_karton'];
        $no_kenzin = $_POST['no_kenzin'];

        $data1 = tampilkan_data_temp_packing($user);
        $temp = mysqli_fetch_array($data1);
        if($temp['data_no'] > 0){
          $data3 = tampilkan_no_transaksi_packing0($user);
            $trx2 = mysqli_fetch_array($data3);
            $no_trx=$trx2['no_trx'];
        }else{
          $data2 = tampilkan_no_transaksi_packing($user);
          $trx = mysqli_fetch_array($data2);
            $no_trx=$trx['no_trx'];
            $no_trx+=1; 
        }

      

        // tampilkan detail barang dari kode barcode
        $barang = tampilkanBarangStyleSize($kode_barcode);
        $dataBarang = mysqli_fetch_array($barang);
        $style = $dataBarang['id_style'];
        $size = $dataBarang ['size'];
        $cup = $dataBarang ['cup'];
        $warna = $dataBarang ['warna'];
        $qty     = $dataBarang['qty_barcode'];

        // tampilkan detail qty order label
        $totalQty = tampilkanQtyOrderBarcodeBuyer($orc, $size, $cup);
        $dataOrder = mysqli_fetch_array($totalQty);
        $qtyOrder = $dataOrder['qty_order'];

        $sql2 = tampilkanOrderBarcodeBuyer($orc);
        $row = mysqli_fetch_array($sql2);
        $styleOrder = $row['id_style'];
        $colorOrder = $row['color'];
        $costomerOrder = $row['id_costomer'];


        if(cek_jumlah_buyer_temp_packing($user) > 1 ){
          echo "error_buyer";
          die();
        }elseif(cek_jumlah_buyer_temp_packing($user) == 1 ){
          $sql6 = tampilkanBuyerTempPackingUser($user);
          $row6 = mysqli_fetch_array($sql6);
          if($row6['id_costomer'] != $costomerOrder){
            echo "error_buyer";
            die();
          }
        }

    if($styleOrder != $style) {
          $pesan = "style";
      }else{
        if($warna != $colorOrder){
          $pesan = "color";
        }else{

          $sql5 = tampilkanQtyTempPackingKarton($user); 
          $row5 = mysqli_fetch_array($sql5);

        if($row5['total_qty'] < $isi_karton){
          if($row5['total_qty'] < $qty_karton){
            if(($kelompok == 'full') || ($kelompok == 'ecer') ){
              
                if(cek_scan_packing_kelompok_user_orc($user) > 1){         
                      echo "error_mix_style";
                      die();
                }elseif(cek_scan_packing_kelompok_user_orc($user) == 1){
                  
                  $sql3 = tampilkanOrcTempPackingUser($user);
                  $row3 = mysqli_fetch_array($sql3);
                  if($row3['orc'] != $orc){
                      echo "error_2orc";
                      die();
                  }else{
                    if(cek_scan_packing_kelompok_user_orc_size($user, $orc) > 1){ 
                      echo "error_mix_size";
                    }elseif(cek_scan_packing_kelompok_user_orc_size($user, $orc) == 1){
                      $sql4 = tampilkanBarangTempPackingUserOrc($user, $orc);
                      $row4 = mysqli_fetch_array($sql4);
                        if(($row4['orc'] == $orc) && ($row4['kode_barcode'] != $kode_barcode)){
                          echo "error_mix_size";
                          die();
                        }
                    }
                  }
                }
              
            }elseif($kelompok == 'mix'){
              if(cek_scan_packing_kelompok_user_orc($user) > 1){         
                echo "error_mix_style";
                die();
              }elseif(cek_scan_packing_kelompok_user_orc($user) == 1){
                  $sql3 = tampilkanOrcTempPackingUser($user);
                  $row3 = mysqli_fetch_array($sql3);
                  if($row3['orc'] != $orc){
                      echo "error_2orc";
                      die();
                  } 
              }
          }
        }else{
            echo "error_over_carton";
            die();
        }
      }else{
        echo "error_over_isi_carton";
        die();
      } 

        // mencari qty Kenzin
          $qtyBefore = tampilkanQtykenzin($orc, $kode_barcode);
          $dataBefore = mysqli_fetch_array($qtyBefore);
          $qtyKenzin = $dataBefore['qty_kenzin'];

          //mencari qty packing
          $qcPacking = tampilkanQtyPackingfull($orc, $kode_barcode);
          $dataPacking = mysqli_fetch_array($qcPacking);
          $qtyPacking = $dataPacking['qty_packing'];

          //mencari qty temp_packing
          $temp_packing = tampilkanQtyTempPackingUser($orc, $kode_barcode, $user);
          $datatrx2 = mysqli_fetch_array($temp_packing);
          $qty_temp_packing = $datatrx2['qty_packing'];
          $update_qty_tambah = $qty_temp_packing + $qty;
          // $pesan = $update_qty_tambah;

          // mencari qty Kenzin
          $qtyBeforeTrx = tampilkanQtykenzinNoTrx($orc, $kode_barcode, $no_kenzin);
          $dataBeforeTrx = mysqli_fetch_array($qtyBeforeTrx);
          $qtyKenzinTrx = $dataBeforeTrx['qty_kenzin_trx'];
          
          if($qty_temp_packing < $qtyKenzinTrx ){
            
            if($qtyPacking < $qtyOrder){
            
              if($qtyPacking < $qtyKenzin){  
               
                  if(cek_scan_packing($orc, $kode_barcode, $user) == 0){
                    if(tambah_data_temp_packing($tanggal, $jam, $kode_barcode, $orc, $qty, $no_trx, $user)){
                      $pesan = "success";
                    }else {
                      $pesan = "errorDb";
                    }
                  }else{
                    if(update_tambah_qty_temp_packing($tanggal, $jam, $orc, $kode_barcode, $user, $update_qty_tambah)){
                      $pesan = "success";
                    }else {
                      $pesan = "errorDb";
                    }
                  }
              }else{
                $pesan = "errorQtyBefore";
              }
           

         
          }elseif(($qtyKenzin >= $qtyOrder) && ($qtyOrder != 0)){
            $pesan = "errorQtyOrder";
          
          }else{
            $pesan = "errorQtyOrder_notsize";
          } 

        
        }elseif(($qty_temp_packing >= $qtyKenzinTrx) && ($qtyKenzinTrx != 0)) {
          $pesan = "errorQtyKenzinTrx";
        }else{
          $pesan = "errorQtyKenzinTrx_not";
        }

        }
      }
    echo $pesan;
  }
        

    
  

  
  // proses edit

    if($_POST['type'] == 'edit'){

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
  }

 
  if($_POST['type'] == 'simpan'){
    $kelompok = $_POST['kelompok'];
    $qty_karton = $_POST['qty_karton'];
    $user = $_SESSION['username'];
    $isi_karton = $_POST['isi_karton'];
    $no_kenzin = $_POST['no_kenzin'];

    if(cek_jumlah_buyer_temp_packing($user) > 1){
      echo "error_buyer";
      die();
    }

    if(cek_no_before_in_packing($no_kenzin) > 0){
      echo "error_no_kenzin";
      die();
    }

    $data = tampilkan_data_temp_scan_packing($user, $no_kenzin);
    while($row=mysqli_fetch_assoc($data))
    {

      
      if(($row['total_temp'] > $row['total_before_trx']) && ($row['total_before_trx'] != 0)){
        echo "over_before_trx";
        die();
      }elseif(($row['total_temp'] < $row['total_before_trx']) && ($row['total_before_trx'] != 0)){
        echo "kurang_before_trx";
        die();
      }elseif($row['total_before_trx'] == 0){
        echo "no_scan_kenzin_trx";
        die();
      }

      if((($row['total_temp'] + $row['total']) > $row['qty_order']) && ($row['qty_order'] != 0)){
        echo "over_order";
        die();
      }else if($row['qty_order'] == 0){
        echo "no_order";
        die();
      }

      if(($row['total_temp'] + $row['total']) > $row['total_before']){
        echo "over_before";
        die();
      }

    }

      $data1 = tampilkan_data_temp_packing($user);
      $temp = mysqli_fetch_array($data1);
      $qty_scan = $temp['total'];

             if($qty_scan > $isi_karton){
              echo "error_over_isi_carton";
            }elseif($qty_scan < $isi_karton){
              echo "error_kurang_isi_carton";
            }elseif($qty_scan > $qty_karton){
              echo "over_carton";
            }elseif($kelompok == 'full' && cek_jumlah_size_temp_packing_orc_barcode($user) == 1 &&  cek_jumlah_orc_temp_packing($user) == 1 && $qty_scan < $qty_karton){
              echo "error_full_ecer";
            }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_packing_orc_barcode($user) == 1 && cek_jumlah_orc_temp_packing($user) == 1 && $qty_scan == $qty_karton){
              echo "error_ecer_full";
            }elseif($kelompok == 'mix' && cek_jumlah_size_temp_packing_orc_barcode($user) == 1 && cek_jumlah_orc_temp_packing($user) == 1 && $qty_scan == $qty_karton){
              echo "error_mix_full";
            }elseif($kelompok == 'mix' && cek_jumlah_size_temp_packing_orc_barcode($user) == 1 && cek_jumlah_orc_temp_packing($user) == 1 && $qty_scan < $qty_karton){
                echo "error_mix_ecer";
            }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_packing_orc_barcode($user) == 1 && cek_jumlah_orc_temp_packing($user) == 1 && $qty_scan < $qty_karton){
              echo "error_mixstyle_ecer";
            }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_packing_orc_barcode($user) == 1 && cek_jumlah_orc_temp_packing($user) == 1 && $qty_scan == $qty_karton){
              echo "error_mixstyle_full";
            }elseif($kelompok == 'full' && cek_jumlah_size_temp_packing_orc_barcode($user) > 1 && cek_jumlah_orc_temp_packing($user) == 1){
              echo "error_full_mix";
            }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_packing_orc_barcode($user) > 1 && cek_jumlah_orc_temp_packing($user) == 1){
              echo "error_ecer_mix";
            }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_packing_orc_barcode($user) > 1 && cek_jumlah_orc_temp_packing($user) == 1){
              echo "error_mixstyle_mix";
            }elseif($kelompok == 'full' && cek_jumlah_size_temp_packing_orc_barcode($user) > 1 && cek_jumlah_orc_temp_packing($user) > 1){
              echo "error_full_mixstyle";
            }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_packing_orc_barcode($user) > 1 && cek_jumlah_orc_temp_packing($user) > 1){
              echo "error_ecer_mixstyle";
            }elseif($kelompok == 'mix' && cek_jumlah_size_temp_packing_orc_barcode($user) > 1 && cek_jumlah_orc_temp_packing($user) > 1){
              echo "error_mix_mixstyle";
            }else{ 
                if(kirim_data_master_packing($kelompok, $_SESSION['username'], $no_kenzin) && reset_temp_packing($_SESSION['username']) ) {
                  update_status_kenzin($no_kenzin);
                  echo "success";  
                }else{
                  echo "errorDb";
                }
            }        
        // }
    // }
  }

  if($_POST['type'] == 'reset'){
    $user = $_SESSION['username'];
    if(reset_temp_packing($user)) {
      echo "success";
    }else{
        echo "errorDb";
    }
  }
 
  if($_POST['type'] == 'kurangi'){
    $id = $_POST['id'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
  // $dataid = explode(",", $data);
  // $id = max($dataid);
 
  
  $temp_packing = tampilkanQtyTempPackingID($id);
  $datatrx2 = mysqli_fetch_array($temp_packing);
  $qty_temp = $datatrx2['qty_packing'];
  $kode_barcode = $datatrx2['kode_barcode'];

  $barang = tampilkanBarangStyleSize($kode_barcode);
  $dataBarang = mysqli_fetch_array($barang);
  $qty     = $dataBarang['qty_barcode'];

    if($qty_temp <= 1){

      if(hapus_data_temp_packing_grup($id)) {
        echo "success";
      }else{
        echo "errorDb";
      } 
    }else{
      $update_qty_delete = $qty_temp - $qty;
      if(update_kurangi_qty_temp_packing($tanggal, $jam, $id, $update_qty_delete)) {
        echo "success";
      }else{
        echo "errorDb";
      }
    }
  }

  if($_POST['type'] == 'simpan_packing_bundle'){
    $user = $_SESSION['username'];
    $temp_table = $_POST['temp_table'];
    $table = $_POST['table'];
    $proses = $_POST['proses'];
    $kelompok = $_POST['kelompok']; 
    $qty_karton = $_POST['qty_karton']; 

    if(cek_jumlah_buyer_temp_packing_bundle($user) > 1){
      echo "error_buyer";
      die();
    }

    $data = tampilkan_data_temp_scan_produksi_bundle_cek_scan($user, $temp_table, $table);
    while($row=mysqli_fetch_assoc($data))
    {
        //mencari proses transaksi sebelumnya
      $data2 = mencari_no_urutan_proses_kode_barcode($proses, $row['barcode_bundle']);
      $dataproses = mysqli_fetch_array($data2);
      $urutan = $dataproses['urutan'];
      $id_order = $dataproses['id_order'];

      $proses_before = $urutan-1; 
      $proses2 = mencari_nama_tabel_transaksi_sebelum($proses_before, $id_order);
      $dataproses2 = mysqli_fetch_array($proses2);
      $table_transaksi_sebelum = $dataproses2['table_transaksi'];

      $data_before = mencari_qty_transaksi_sebelum($table_transaksi_sebelum, $row['barcode_bundle']);
      $data_before2 = mysqli_fetch_array($data_before);
      $qty_before = $data_before2['qty_before'];
      
      if(($row['total_temp'] + $row['total']) >  $qty_before ){
        echo "over_before";
        die();
      }else if(($row['total_temp'] + $row['total']) > $row['qty_isi_bundle']){
        echo "over_bundle";
        die();
      }
    }

    $data1 = tampilkan_data_produksi_bundle($user, $temp_table);
    $temp = mysqli_fetch_array($data1);
    $no_trx=$temp['data_no'];
    $qty_scan = $temp['total'];
    $barcode_ctn = "SKM".sprintf("%010d", $no_trx);
    


    if($qty_scan > $qty_karton){
      echo "over_carton";
    }elseif($kelompok == 'full' && cek_jumlah_size_temp_packing_bundle_style_size($user) == 1 &&  cek_jumlah_style_temp_packing_bundle($user) == 1 && $qty_scan < $qty_karton){
      echo "error_full_ecer";
    }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_packing_bundle_style_size($user) == 1 && cek_jumlah_style_temp_packing_bundle($user) == 1 && $qty_scan == $qty_karton){
      echo "error_ecer_full";
    }elseif($kelompok == 'mix' && cek_jumlah_size_temp_packing_bundle_style_size($user) == 1 && cek_jumlah_style_temp_packing_bundle($user) == 1 && $qty_scan == $qty_karton){
      echo "error_mix_full";
    }elseif($kelompok == 'mix' && cek_jumlah_size_temp_packing_bundle_style_size($user) == 1 && cek_jumlah_style_temp_packing_bundle($user) == 1 && $qty_scan < $qty_karton){
        echo "error_mix_ecer";
    }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_packing_bundle_style_size($user) == 1 && cek_jumlah_style_temp_packing_bundle($user) == 1 && $qty_scan < $qty_karton){
      echo "error_mixstyle_ecer";
    }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_packing_bundle_style_size($user) == 1 && cek_jumlah_style_temp_packing_bundle($user) == 1 && $qty_scan == $qty_karton){
      echo "error_mixstyle_full";
    }elseif($kelompok == 'full' && cek_jumlah_size_temp_packing_bundle_style_size($user) > 1 && cek_jumlah_style_temp_packing_bundle($user) == 1){
      echo "error_full_mix";
    }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_packing_bundle_style_size($user) > 1 && cek_jumlah_style_temp_packing_bundle($user) == 1){
      echo "error_ecer_mix";
    }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_packing_bundle_style_size($user) > 1 && cek_jumlah_style_temp_packing_bundle($user) == 1){
      echo "error_mixstyle_mix";
    }elseif($kelompok == 'full' && cek_jumlah_size_temp_packing_bundle_style_size($user) > 1 && cek_jumlah_style_temp_packing_bundle($user) > 1){
      echo "error_full_mixstyle";
    }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_packing_bundle_style_size($user) > 1 && cek_jumlah_style_temp_packing_bundle($user) > 1){
      echo "error_ecer_mixstyle";
    }elseif($kelompok == 'mix' && cek_jumlah_size_temp_packing_bundle_style_size($user) > 1 && cek_jumlah_style_temp_packing_bundle($user) > 1){
      echo "error_mix_mixstyle";
    }else{
      if(kirim_data_transaksi_produksi_bundle_packing($user, $no_trx, $barcode_ctn, $kelompok)){
        kirim_data_transaksi_produksi_bundle_packing2($user, $temp_table, $table, $no_trx); 
        reset_temp_produksi_bundle($user, $temp_table);
        echo "success";  
      }else{
        echo "error_db";
    }
  }        
  
  }


?>

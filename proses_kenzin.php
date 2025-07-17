<?php

  require_once 'core/init.php';

  if($_POST['type'] == 'scan'){ 
        $kode_barcode = $_POST['isi_barcode'];
        $tanggal = date("Y-m-d");
        $jam     = date("H:i:s");
        $orc = $_POST['orc']; 
        
        $user = $_POST['user'];
        $kelompok = $_POST['kelompok'];
        $qty_karton = $_POST['qty_karton'];
        $isi_karton = $_POST['isi_karton'];

        $data1 = tampilkan_data_temp_kenzin($user);
        $temp = mysqli_fetch_array($data1);
        if($temp['data_no'] > 0){
          $data3 = tampilkan_no_transaksi_kenzin0($user);
            $trx2 = mysqli_fetch_array($data3);
            $no_trx=$trx2['no_trx'];
        }else{
          $data2 = tampilkan_no_transaksi_kenzin($user);
          $trx = mysqli_fetch_array($data2);
            $no_trx=$trx['no_trx'];
            $no_trx+=1;
        }
      

        // tampilkan detail barang dari kode barcode
        $barang = tampilkanBarangStyleSize($kode_barcode);
        $dataBarang = mysqli_fetch_array($barang);
        $style = $dataBarang['id_style'];
        $size = $dataBarang['size'];
        $cup = $dataBarang['cup'];
        $warna = $dataBarang['warna'];
        $qty     = $dataBarang['qty_barcode'];
        // tampilkan detail qty order label
        // $totalQty = tampilkanQtyOrderBarcodeBuyer($orc, $style, $size);
        // $dataQtyOrder = mysqli_fetch_array($totalQty);
        // $barcode_number = $dataQtyOrder['barcode_number'];
        // $qtyOrder = $dataQtyOrder['qty_order'];

        //mencari qty tatami_in
        // $qtyBefore = tampilkanQtyTatamiIn($barcode_number);
        // $dataBefore = mysqli_fetch_array($qtyBefore);
        // $qtyTatamiIn = $dataBefore['qty_tatami_in'];

        //mencari qty tatami_reject
        // $qtyReject = tampilkanQtyTatamiReject($barcode_number);
        // $dataReject = mysqli_fetch_array($qtyReject);
        // $qtyReject = $dataReject['qty_reject_tatami'];

        // $Tatamifull = $qtyTatamiIn - $qtyReject;

        $totalQty = tampilkanQtyOrderBarcodeBuyer($orc, $size, $cup);
        $dataOrder = mysqli_fetch_array($totalQty);
        $qtyOrder = $dataOrder['qty_order'];
    
        $sql2 = tampilkanOrderBarcodeBuyer($orc);
        $row = mysqli_fetch_array($sql2);
        $styleOrder = $row['id_style'];
        $colorOrder = $row['color'];
        $costomerOrder = $row['id_costomer'];

    if(cek_jumlah_buyer_temp_kenzin($user) > 1 ){
      echo "error_buyer";
      die();
    }elseif(cek_jumlah_buyer_temp_kenzin($user) == 1 ){
      $sql6 = tampilkanBuyerTempKenzinUser($user);
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
          $sql5 = tampilkanQtyTempKenzinKarton($user);
          $row5 = mysqli_fetch_array($sql5);

        if($row5['total_qty'] < $isi_karton){
          if($row5['total_qty'] < $qty_karton){
            if(($kelompok == 'full') || ($kelompok == 'ecer') ){
              
                if(cek_scan_kenzin_kelompok_user_orc($user) > 1){         
                      echo "error_mix_style";
                      die();
                }elseif(cek_scan_kenzin_kelompok_user_orc($user) == 1){
                  
                  $sql3 = tampilkanOrcTempKenzinUser($user);
                  $row3 = mysqli_fetch_array($sql3);
                  if($row3['orc'] != $orc){
                      echo "error_2orc";
                      die();
                  }else{
                    if(cek_scan_kenzin_kelompok_user_orc_size($user, $orc) > 1){ 
                      echo "error_mix_size";
                    }elseif(cek_scan_kenzin_kelompok_user_orc_size($user, $orc) == 1){
                      $sql4 = tampilkanBarangTempKenzinUserOrc($user, $orc);
                      $row4 = mysqli_fetch_array($sql4);
                        if(($row4['orc'] == $orc) && ($row4['kode_barcode'] != $kode_barcode)){
                          echo "error_mix_size";
                          die();
                        }
                    }
                  }
                }
              
            }elseif($kelompok == 'mix'){
              if(cek_scan_kenzin_kelompok_user_orc($user) > 1){         
                echo "error_mix_style";
                die();
              }elseif(cek_scan_kenzin_kelompok_user_orc($user) == 1){
                  $sql3 = tampilkanOrcTempKenzinUser($user);
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

          //mencari qty kenzin
          $kenzin = tampilkanQtykenzinfull($orc, $kode_barcode);
          $dataKenzin = mysqli_fetch_array($kenzin);
          $qtyKenzin = $dataKenzin['qty_kenzin'];
         
          //mencari qty temp_kenzin
          $temp_kenzin = tampilkanQtyTempKenzinUser($orc, $kode_barcode, $user);
          $datatrx2 = mysqli_fetch_array($temp_kenzin);
          $qty_temp = $datatrx2['qty_kenzin'];
          $update_qty_tambah = $qty_temp + $qty;
          // $pesan = $update_qty_tambah;


          // if($qtyKenzin < $Tatamifull){  
            if(($qtyKenzin < $qtyOrder)){ 
              if(($qtyOrder-$qtyKenzin) >= $qty){
                if(cek_scan_kenzin($orc, $kode_barcode, $user) == 0){  
                  if(tambah_data_temp_kenzin($tanggal, $jam, $kode_barcode, $orc, $qty, $no_trx, $user)){
                    $pesan = "success";
                  }else {
                    $pesan = "errorDb";
                  }
                }else{
                  if(update_tambah_qty_temp_kenzin($tanggal, $jam, $orc, $kode_barcode, $user, $update_qty_tambah)){
                    $pesan = "success";
                  }else {
                    $pesan = "errorDb";
                  }
                }
              }else{
                $pesan = "errorQtyOrder"; // kurang dari pack / hubungan sama qty pack
              }    
            }elseif(($qtyKenzin >= $qtyOrder) && ($qtyOrder != 0)){
              $pesan = "errorQtyOrder";
            }else{
              $pesan = "errorQtyOrder_notsize";
            }  
        // }else{
        //   $pesan = "errorQtyBefore";
        // }
        }
      }
    echo $pesan;
  }

  if($_POST['type'] == 'simpan'){ 
    $user = $_SESSION['username'];
    $kelompok = $_POST['kelompok'];
    $qty_karton = $_POST['qty_karton'];
    $isi_karton = $_POST['isi_karton'];

    if(cek_jumlah_buyer_temp_kenzin($user) > 1){
      echo "error_buyer";
      die();
    }

    $data = tampilkan_data_temp_scan_kenzin($user);
    while($row=mysqli_fetch_assoc($data))
    {
      if((($row['total_temp'] + $row['total']) < $row['qty_order']) && ($row['qty_order'] != 0) ){
        echo "over_order";
        die();
      }elseif($row['qty_order'] == 0){
        echo "no_order";
      }

      // if($row['qty_order'] == 0){
      //   echo 'no_order';
      // }
    }

   $data1 = tampilkan_data_temp_kenzin($user);
   $temp = mysqli_fetch_array($data1);
   $qty_scan = $temp['total'];

    if($qty_scan > $isi_karton){
      echo "error_over_isi_carton";
    }elseif($qty_scan < $isi_karton){
      echo "error_kurang_isi_carton";
    }elseif($qty_scan > $qty_karton){
      echo "over_carton";
    }elseif($kelompok == 'full' && cek_jumlah_size_temp_kenzin_orc_barcode($user) == 1 &&  cek_jumlah_orc_temp_kenzin($user) == 1 && $qty_scan < $qty_karton){
      echo "error_full_ecer";
    }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_kenzin_orc_barcode($user) == 1 && cek_jumlah_orc_temp_kenzin($user) == 1 && $qty_scan == $qty_karton){
      echo "error_ecer_full";
    }elseif($kelompok == 'mix' && cek_jumlah_size_temp_kenzin_orc_barcode($user) == 1 && cek_jumlah_orc_temp_kenzin($user) == 1 && $qty_scan == $qty_karton){
      echo "error_mix_full";
    }elseif($kelompok == 'mix' && cek_jumlah_size_temp_kenzin_orc_barcode($user) == 1 && cek_jumlah_orc_temp_kenzin($user) == 1 && $qty_scan < $qty_karton){
        echo "error_mix_ecer";
    }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_kenzin_orc_barcode($user) == 1 && cek_jumlah_orc_temp_kenzin($user) == 1 && $qty_scan < $qty_karton){
      echo "error_mixstyle_ecer";
    }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_kenzin_orc_barcode($user) == 1 && cek_jumlah_orc_temp_kenzin($user) == 1 && $qty_scan == $qty_karton){
      echo "error_mixstyle_full";
    }elseif($kelompok == 'full' && cek_jumlah_size_temp_kenzin_orc_barcode($user) > 1 && cek_jumlah_orc_temp_kenzin($user) == 1){
      echo "error_full_mix";
    }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_kenzin_orc_barcode($user) > 1 && cek_jumlah_orc_temp_kenzin($user) == 1){
      echo "error_ecer_mix";
    }elseif($kelompok == 'mix_style' && cek_jumlah_size_temp_kenzin_orc_barcode($user) > 1 && cek_jumlah_orc_temp_kenzin($user) == 1){
      echo "error_mixstyle_mix";
    }elseif($kelompok == 'full' && cek_jumlah_size_temp_kenzin_orc_barcode($user) > 1 && cek_jumlah_orc_temp_kenzin($user) > 1){
      echo "error_full_mixstyle";
    }elseif($kelompok == 'ecer' && cek_jumlah_size_temp_kenzin_orc_barcode($user) > 1 && cek_jumlah_orc_temp_kenzin($user) > 1){
      echo "error_ecer_mixstyle";
    }elseif($kelompok == 'mix' && cek_jumlah_size_temp_kenzin_orc_barcode($user) > 1 && cek_jumlah_orc_temp_kenzin($user) > 1){
      echo "error_mix_mixstyle";
    }else{ 
      if(kirim_data_master_kenzin($user, $kelompok, $qty_karton) && reset_temp_kenzin($user) ) {
        echo "success";
      }else{
        echo "errorDb";
      }
    }
  }

  if($_POST['type'] == 'reset'){
    $user = $_SESSION['username'];
  

    if(reset_temp_kenzin($user) ) {
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
  
    $temp_kenzin = tampilkanQtyTempKenzinID($id);
    $datatrx2 = mysqli_fetch_array($temp_kenzin);
    $qty_temp = $datatrx2['qty_kenzin']; 
    $kode_barcode = $datatrx2['kode_barcode']; 

    $barang = tampilkanBarangStyleSize($kode_barcode);
    $dataBarang = mysqli_fetch_array($barang);
    $qty     = $dataBarang['qty_barcode'];
  
    if($qty_temp <= $qty){    

      if(hapus_data_temp_kenzin_grup($id)) {
        echo "success";
      }else{
        echo "errorDb"; 
      }
    }else{
      $update_qty_delete = $qty_temp - $qty;
      if(update_kurangi_qty_temp_kenzin($tanggal, $jam, $id, $update_qty_delete)) {
        echo "success";
      }else{
        echo "errorDb"; 
      }
    }  
  }

 
?>

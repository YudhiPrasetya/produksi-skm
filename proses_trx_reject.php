<?php

  require_once 'core/init.php';
    
    if(ISSET($_SESSION['username'])){
    $user = $_SESSION['username'];
    $kode_barcode = trim($_POST['isi_barcode']);
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
   

    $order = mencari_id_order($kode_barcode);
    $dataorder = mysqli_fetch_array($order);
    $id_order = $dataorder['id_order'];

    if(cek_ketersediaan_proses($id_order, $proses) != 0){

        $data1 = tampilkan_data_produksi_bundle($user, $temp_table);
        $temp = mysqli_fetch_array($data1);
        if($temp['data_no'] > 0){
            $no_trx=$temp['data_no'];
        }else{
        $data2 = tampilkan_no_transaksi_production_bundle($user, $temp_table, $table);
        $trx = mysqli_fetch_array($data2);
            $no_trx=$trx['no_trx'];
            $no_trx+=1;
        }
    
        // tampilkan detail qty bundle 
        $totalQty = tampilkanQtyOrderBarcodeBundle($kode_barcode);
        $dataQtyBundle = mysqli_fetch_array($totalQty);
        $qtyIsiBundle = $dataQtyBundle['qty_isi_bundle'];

        //qty ouput
        $qty_output = tampilkanQtyProductionBundleFull($kode_barcode, $temp_table, $table);
        $datatrx = mysqli_fetch_array($qty_output);
        $qty_production = $datatrx['qty_production'];

        //mencari proses transaksi sebelumnya
        $proses = mencari_no_urutan_proses($proses, $id_order);
        $dataproses = mysqli_fetch_array($proses);
        $urutan = $dataproses['urutan'];

        if($urutan != 1 AND $tipe == 'normal'){
            
            $proses_before = $urutan-1; 
            $proses2 = mencari_nama_tabel_transaksi_sebelum($proses_before, $id_order);
            $dataproses2 = mysqli_fetch_array($proses2);
            $table_transaksi_sebelum = $dataproses2['table_transaksi'];

            $data_before = mencari_qty_transaksi_sebelum($table_transaksi_sebelum, $kode_barcode);
            $data_before2 = mysqli_fetch_array($data_before);
            $qty_before = $data_before2['qty_before'];

            if($qty_production != 0){
                $qty_scan = $qty_before - $qty_production;
            }else{
                $qty_scan = $qty_before;
            }

            // if($proses == 'packing_under'){

            // }



        }elseif($urutan == 1){
            $qty_before = $qtyIsiBundle;
            if($qty_production != 0){
                $qty_scan = $qtyIsiBundle - $qty_production;
            }else{
                $qty_scan = $qtyIsiBundle;
            }
        }

        if($tipe == 'pecahan'){
            $proses2 = mencari_nama_tabel_transaksi_sebelum(1, $id_order);
            $dataproses2 = mysqli_fetch_array($proses2);
            $table_transaksi_sebelum = $dataproses2['table_transaksi'];

            $data_before = mencari_qty_transaksi_sebelum($table_transaksi_sebelum, $kode_barcode);
            $data_before2 = mysqli_fetch_array($data_before);
            $qty_before = $data_before2['qty_before'];

            if($qty_production != 0){
                $qty_scan = $qty_before - $qty_production;
            }else{
                $qty_scan = $qty_before;
            }
        }elseif($tipe == 'penggabungan'){
           
            if(cek_jumlah_transaksi_pecahan_orc($id_order) != 0 ){
                $sql = mencari_transaksi_pecahan($id_order);
                while($pecahan = mysqli_fetch_assoc($sql)){ 
                    $nama_trx[] = $pecahan['nama_transaksi'];
                    $table = $pecahan['table_transaksi'];

                    $sql2 = mencari_qty_transaksi_sebelum($table, $kode_barcode);
                    $data3 = mysqli_fetch_assoc($sql2);
                    $qty_trx_pecahan[] = $data3['qty_before'];
                }
                $nilai =array_combine($nama_trx, $qty_trx_pecahan);
                $qty_before = min($nilai); 
                
                
                $key = array_search(min($nilai), $nilai);
            
                if($qty_production != 0){
                    $qty_scan = $qty_before - $qty_production;
                }else{
                    $qty_scan = $qty_before;
                }  

                if($qty_before == 0){
                echo $key;
                    die();
                }elseif($qty_before == $qty_production){
                    echo $key."1";
                    die();
                }
            }else{
                $proses2 = mencari_nama_tabel_transaksi_sebelum(1, $id_order);
                $dataproses2 = mysqli_fetch_array($proses2);
                $table_transaksi_sebelum = $dataproses2['table_transaksi'];

                $data_before = mencari_qty_transaksi_sebelum($table_transaksi_sebelum, $kode_barcode);
                $data_before2 = mysqli_fetch_array($data_before);
                $qty_before = $data_before2['qty_before'];

                if($qty_production != 0){
                    $qty_scan = $qty_before - $qty_production;
                }else{
                    $qty_scan = $qty_before;
                }
            }    
        }
    
    
        if($qty_scan <= $qty_before){
            if($qty_production != $qtyIsiBundle){
                if($qty_before != $qty_production){
                    if($qty_scan <= $qtyIsiBundle && $qty_scan != 0 ){
                        if(cek_scan_produksi_bundle($kode_barcode, $user, $temp_table) == 0){
                            if(tambah_data_temp_production_bundle($tanggal, $jam, $kode_barcode, $qty_scan, $no_trx, $user, $temp_table)){
                            $pesan = "success";
                            }else {
                            $pesan = "errorDb";
                            }
                        }else{
                            $temp2 = tampilkanQtyProductionBundleTemp($kode_barcode, $temp_table, $user);
                            $datatrx2 = mysqli_fetch_array($temp2);
                            $qty_scan_temp = $datatrx2['qty_production'];
                            $update_qty_tambah = $qty_scan_temp + $qty_scan;

                            if(update_tambah_qty_temp_production_bundle($tanggal, $jam, $kode_barcode, $user, $update_qty_tambah, $temp_table)){
                                $pesan = "success";
                            }else {
                                $pesan = "errorDb";
                            }
                        }
                    }else{
                        $pesan = 'over_bundle';
                    }
                }else{
                    $pesan = 'over_before';
                }
            }else{
                $pesan = 'over_bundle';
            }        
        }else{
            $pesan = 'over_before';
        }    

    }else{
        $pesan =  "no_proses";
    }
      

    echo $pesan;
}else{
    $pesan = 'logout';
    echo $pesan;
}
 
?>

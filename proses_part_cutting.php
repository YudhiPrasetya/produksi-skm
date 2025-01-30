<?php

require_once 'core/init.php';

    if($_POST['type'] == 'insert_detail'){

        $tanggal = date("Y-m-d");
        $jam     = date("H:i:s");
        $username = $_SESSION['username'];
        $idTemp = $_POST['idTemp']; // id transaksi temp 
        $valTemp = $_POST['valTemp']; // nilai submit qty 
        $idiod = $_POST['idiod']; // id_order_detail
        $idibdp = $_POST['idibdp']; //id_bom_detail_part
        $id_order = $_POST['id_order'];

 
        $sql5 = mencari_data_total_qty_part_cutting($idiod, $idibdp);
        $data5 = mysqli_fetch_array($sql5);
        $qty_order = $data5['qty_order'] + $data5['total_reject'];
        $qty_after = $data5['qty_total'] + $valTemp;
        
        if($qty_after > $qty_order){
            echo "over";
        }else{

            if($idTemp != ''){
                update_qty_temp_part_cutting($idTemp, $username, $tanggal, $jam, $valTemp);
            }else{
                if(cek_temp_part_cutting_id_order($id_order) != 0){
                    $sql = mencari_no_trx_temp_part_cutting_id_order($id_order);
                    $data = mysqli_fetch_array($sql);
                    $no_trx = $data['no_trx'];
                }else{
                    $sql2 = mencari_no_transaksi_part_cutting();
                    $data2 = mysqli_fetch_array($sql2);
            
                    $sql3 = mencari_no_trx_temp_part_cutting();
                    $data3 = mysqli_fetch_array($sql3);
            
                    if($data2['no_trx'] > $data3['no_trx']){
                        $no_scan = $data2['no_trx'];
                        $no_trx = $no_scan+1;
                    }else{
                        $no_scan = $data3['no_trx'];
                        $no_trx = $no_scan+1;
                    }
        
                }

                tambah_qty_temp_part_cutting($no_trx, $tanggal, $jam, $idiod, $idibdp, $valTemp, $username);
            }
            
        $sql4 = tampilkan_temp_transaksi_part_cutting_transaksi($idiod, $idibdp, $tanggal);
        $data4 = mysqli_fetch_array($sql4);
       
        $json = json_encode($data4);
        echo $json;
                    
    }

}

if($_POST['type'] == 'simpan'){
    $id_order = $_POST['id'];
    $username = $_POST['username'];
    $tgl_potong = $_POST['tgl_potong'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $jmlh_layer = $_POST['jmlh_layer'];
    $operator = $_POST['operator'];
    $item_potong = $_POST['item_potong'];

    $sql = mencari_nilai_qty_temp_part_cutting($id_order);
    $data = mysqli_fetch_array($sql);
    $temp_qty_total = $data['qty_total'];
    $no_trx = $data['no_trx'];
    
    if($temp_qty_total <= 0){
         hapus_data_temp_part_cutting($id_order);
         echo "qty_kosong";
    }else{
        if(kirim_data_hd_transaksi_part_cutting($no_trx, $tgl_potong, $start_time, $end_time, $jmlh_layer, $operator, $username, $item_potong, $id_order)){
            if(kirim_data_transaksi_part_cutting($id_order)){
                hapus_data_temp_part_cutting($id_order);
                hapus_data_temp_part_cutting_size_id_order($id_order);
                hapus_data_temp_part_cutting_part_id_order($id_order);
                echo "success";
            }else{
                echo "error";
            }
        }else{
            echo "error";
        }
    }
}

if($_POST['type'] == 'reset'){
    $id_order = $_POST['id'];
    $username = $_POST['username'];

        if(hapus_data_temp_part_cutting($id_order)){
            hapus_data_temp_part_cutting_size_id_order($id_order);
            hapus_data_temp_part_cutting_part_id_order($id_order);
            echo 'success';
        }else{
            echo "error";
        }

}


if($_POST['type'] == 'insert_reject'){

    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
    $username = $_SESSION['username'];
    $idTemp = $_POST['idTemp']; // id transaksi temp 
    $valTemp = $_POST['valTemp']; // nilai submit qty 
    $idiod = $_POST['idiod']; // id_order_detail
    $idibdp = $_POST['idibdp']; //id_bom_detail_part
    $id_order = $_POST['id_order'];

    $sql5 = mencari_data_total_qty_part_cutting($idiod, $idibdp);
        $data5 = mysqli_fetch_array($sql5);
        $qty_total = $data5['qty_total'];
        $qty_after = $data5['total_reject'] + $valTemp;
        
        if($qty_after > $qty_total){
            echo "over";
        }else{
            if($idTemp != ''){
                update_qty_temp_part_cutting_reject($idTemp, $username, $tanggal, $jam, $valTemp);
            }else{
                if(cek_temp_part_cutting_reject_id_order($id_order) != 0){
                    $sql = mencari_no_trx_temp_part_cutting_reject_id_order($id_order);
                    $data = mysqli_fetch_array($sql);
                    $no_trx = $data['no_trx'];
                }else{
                    $sql2 = mencari_no_transaksi_part_cutting_reject();
                    $data2 = mysqli_fetch_array($sql2);
            
                    $sql3 = mencari_no_trx_temp_part_cutting_reject();
                    $data3 = mysqli_fetch_array($sql3);
                  
                    if($data2['no_trx'] > $data3['no_trx']){
                        $no_scan = $data2['no_trx'];
                        $no_trx = $no_scan+1;
                    }else{
                        $no_scan = $data3['no_trx'];
                        $no_trx = $no_scan+1;
                    } 
                }
                tambah_qty_temp_part_cutting_reject($no_trx, $tanggal, $jam, $idiod, $idibdp, $valTemp, $username);
            }

            $sql4 = tampilkan_temp_transaksi_part_cutting_reject_transaksi($idiod, $idibdp, $tanggal);
            $data4 = mysqli_fetch_array($sql4);
           
            $json = json_encode($data4);
            echo $json;
                        
        }
}

if($_POST['type'] == 'simpan_reject'){
    $id_order = $_POST['id'];
    $username = $_POST['username'];
    $remaks = $_POST['remaks'];

    $sql6 = mencari_nilai_qty_temp_part_cutting_reject($id_order);
    $data6 = mysqli_fetch_array($sql6);
    $temp_qty_total = $data6['qty_total'];
   

    if($temp_qty_total <= 0){
        hapus_data_temp_part_cutting_reject($id_order);
         echo "qty_kosong";
    }else{
        if(kirim_data_transaksi_part_cutting_reject($id_order, $remaks)){
            hapus_data_temp_part_cutting_reject($id_order);
            echo "success";
        }else{
            echo "error";
        }
    }
}

if($_POST['type'] == 'reset_reject'){
    $id_order = $_POST['id'];
    $username = $_POST['username'];

        if(hapus_data_temp_part_cutting_reject($id_order)){
            echo 'success';
        }else{
            echo "error";
        }

}

if($_POST['type'] == 'send_part_orc'){
    $id_order = $_POST['id_order'];
    $id_bom_detail_part = $_POST['id_bom_detail_part'];
    $username = $_SESSION['username'];


    if(cek_temp_part_cutting_part_terpilih($id_order, $id_bom_detail_part) == 0){
    
        if(tambah_temp_part_cutting_part_terpilih($id_order, $id_bom_detail_part, $username)){
            echo 'success';
        }else{
            echo "error";
        }
    }else{
        echo "duplicate";
    }
}

if($_POST['type'] == 'send_back_part_orc'){
    $id_transaksi = $_POST['id_transaksi'];

    if(hapus_data_temp_part_cutting_part($id_transaksi)){
        echo 'success';
    }else{
        echo "error";
    }

}

if($_POST['type'] == 'send_size_orc'){
    $id_order_detail = $_POST['id_order_detail'];
    $username = $_SESSION['username'];

    if(cek_temp_part_cutting_size_terpilih_id($id_order_detail) == 0){
        if(tambah_temp_part_cutting_size_terpilih($id_order_detail, $username)){
            echo 'success';
        }else{
            echo "error";
        }
    }else{
        echo "duplicate";
    }

}

if($_POST['type'] == 'send_back_size_orc'){
    $id_transaksi = $_POST['id_transaksi'];
    
    if(hapus_data_temp_part_cutting_size($id_transaksi)){
        echo 'success';
    }else{
        echo "error";
    }
}

if($_POST['type'] == 'edit_detail_rasio'){
    $id_transaksi = $_POST['id_transaksi'];
    $nilai_rasio = $_POST['valTemp'];
    $layer = $_POST['layer'];

    if(update_temp_part_cutting_rasio_size($id_transaksi, $nilai_rasio)){
        
        $sql4 = tampilkan_temp_transaksi_part_cutting_size($id_transaksi, $layer);
        $data4 = mysqli_fetch_array($sql4);
       
        $json = json_encode($data4);
        echo $json;
    }else{
        echo "error";
    }
}

if($_POST['type'] == 'save_temp_part'){
    $id_order = $_POST['id_order'];
    $layer = $_POST['layer'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
    $username = $_SESSION['username'];
    
    if(cek_temp_part_cutting_part_isi($id_order) != 0){
        if(cek_temp_part_cutting_size_isi($id_order) != 0){
            if(cek_temp_part_cutting_size_rasio($id_order) == 0){
                //cek ada transaksi di table temp_part_cutting
                if(cek_temp_part_cutting_id_order($id_order) != 0){
                    $sql = mencari_no_trx_temp_part_cutting_id_order($id_order);
                    $data = mysqli_fetch_array($sql);
                    $no_trx = $data['no_trx'];

                    if(hapus_data_temp_part_cutting($id_order)){
    
                        $sql = tampilkan_temp_part_cutting_size_id_order($id_order);
                        while($data=mysqli_fetch_assoc($sql)){
                            $id_order_detail = $data['id_order_detail'];
                            $rasio = $data['rasio'];
                            $qty_temp = $rasio*$layer;
                           
                            $sql4 = tampilkan_temp_part_cutting_part_id_order($id_order);
                            while($data4=mysqli_fetch_assoc($sql4)){
                                $id_bom_detail_part = $data4['id_bom_detail_part'];
                                tambah_temp_part_cutting_generate($no_trx, $id_order, $id_order_detail, $id_bom_detail_part, $rasio, $username, $tanggal, $jam, $qty_temp);
                            }
                            
                        }
                        echo "success";
                    }

                }else{

                    $sql2 = mencari_no_hd_transaksi_part_cutting();
                    $data2 = mysqli_fetch_array($sql2);
            
                    $sql3 = mencari_no_trx_temp_part_cutting();
                    $data3 = mysqli_fetch_array($sql3);
            
                    if($data2['no_trx'] > $data3['no_trx']){
                        $no_scan = $data2['no_trx'];
                        $no_trx = $no_scan+1;
                    }else{
                        $no_scan = $data3['no_trx'];
                        $no_trx = $no_scan+1;
                    }


                    $sql = tampilkan_temp_part_cutting_size_id_order($id_order);
                    while($data=mysqli_fetch_assoc($sql)){
                        $id_order_detail = $data['id_order_detail'];
                        $rasio = $data['rasio'];
                        $qty_temp = $rasio*$layer;
                       
                        $sql4 = tampilkan_temp_part_cutting_part_id_order($id_order);
                        while($data4=mysqli_fetch_assoc($sql4)){
                            $id_bom_detail_part = $data4['id_bom_detail_part'];
                            tambah_temp_part_cutting_generate($no_trx, $id_order, $id_order_detail, $id_bom_detail_part, $rasio, $username, $tanggal, $jam, $qty_temp);
                        }
                        
                    }
                    echo "success";
                }
            }else{
                echo "rasio_kosong";
            }
        }else{
            echo "size_kosong";
        }
    }else{
        echo "part_kosong";
    }
}
<?php 
    require_once 'core/init.php';
    
    $username = $_SESSION['username'];
    $id_order = $_POST['id_order'];
    $proses=$_POST['proses']; 
    $jml_dipilih =count($proses);

    if(cek_proses_transaksi_orc($id_order) != 0){
        hapusProsesTransaksiOrc($id_order);

        for($x=0; $x<$jml_dipilih; $x++){
            $urutan= $x+1;
           if(tambah_data_proses_transaksi_orc($id_order, $proses[$x], $urutan, $username)){
            $_SESSION['pesan'] = 'DATA PROSES TRANSAKSI BERHASIL TERGENERATE ULANG';
            header("Location:barcode_master_order.php?id=$id_order");
           }else{
            echo 'gagal';
           }
        }
    }else{
        $_SESSION['pesan'] = 'DATA BELUM PERNAH SAMA SEKALI TERGENERATE, SILAKAN COBA GENERATE ULANG DISINI';
        header("Location:barcode_master_order.php?id=$id_order");
    }
?>
<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'kenzin' OR 
  cek_status($_SESSION['username'] ) == 'kenzin2' OR 
  cek_status($_SESSION['username'] ) == 'kenzin3'
) {


if(kirim_data_ganti_label() && reset_temp_ganti_label() ) {
    // ();
  $_SESSION['pesan'] = 'Data Transaksi Ganti Label Berhasil disimpan';
  header('Location: temp_ganti_label.php');
  }else{
  echo "gagal menghapus data";
  }
} else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
?> 
  

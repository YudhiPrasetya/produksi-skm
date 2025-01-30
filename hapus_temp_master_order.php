<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'ppic') {

 
  if(reset_temp_master_order($_SESSION['username'])) {
    $_SESSION['pesan']='Data Order Berhasil di Reset';
  header('Location: tambah-order.php');
  }else{
  echo "gagal menghapus data";
  }

  } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; }
?>

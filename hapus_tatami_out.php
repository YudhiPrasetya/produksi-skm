<?php require_once "core/init.php";

   if(cek_status($_SESSION['username'] ) == 'admin' OR 
   cek_status($_SESSION['username'] ) == 'tatami' ) {
     $user = $_SESSION['username'];

  if(reset_temp_tatami_out($user)) {
  header('Location: temp_tatami_out.php');
    $_SESSION['pesan'] = 'Data Transaksi Tatami Out Berhasil Di Reset';
  }else{
    echo "gagal menghapus data";
  }

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

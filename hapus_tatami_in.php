<?php require_once "core/init.php";

   if(cek_status($_SESSION['username'] ) == 'admin' OR 
   cek_status($_SESSION['username'] ) == 'tatami' ) {
     $user = $_SESSION['username'];

  if(reset_temp_tatami_in($user)) {
  header('Location: temp_tatami_in.php');
    $_SESSION['pesan'] = 'Data Transaksi Tatami In Berhasil Di Reset';
  }else{
    echo "gagal menghapus data";
  }

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

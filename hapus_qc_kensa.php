<?php require_once "core/init.php";

   if(cek_status($_SESSION['username'] ) == 'admin' OR 
   cek_status($_SESSION['username'] ) == 'kensa' ) {
     $user = $_SESSION['username'];

  if(reset_temp_qc_kensa($user)) {
  header('Location: temp_qc_kensa.php');
    $_SESSION['pesan'] = 'Data Transaksi QC Kensa Berhasil Di Reset';
  }else{
    echo "gagal menghapus data";
  }

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

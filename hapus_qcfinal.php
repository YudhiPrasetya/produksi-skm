<?php require_once "core/init.php";

   if(cek_status($_SESSION['username'] ) == 'admin' OR 
   cek_status($_SESSION['username'] ) == 'qcfinal' ) {
     $user = $_SESSION['username'];

  if(reset_temp_qcfinal($user)) {
  header('Location: temp_qcfinal.php');
    $_SESSION['pesan'] = 'Data Transaksi QC Final Berhasil Di Reset';
  }else{
    echo "gagal menghapus data";
  }

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

<?php require_once "core/init.php";

   if(cek_status($_SESSION['username'] ) == 'admin' OR 
   cek_status($_SESSION['username'] ) == 'packing_outerware' ) {
     $user = $_SESSION['username'];

  if(isset($_GET['trx'])){
    $trx = $_GET['trx'];

    if(hapus_data_transaksi_packing($trx)) {
      header('Location: edit_packing.php?trx='.$trx.'');
      $_SESSION['pesan'] = 'Data Transaksi Packing Berhasil Di Reset';
    }else{
      echo "gagal menghapus data";
    }
  }

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

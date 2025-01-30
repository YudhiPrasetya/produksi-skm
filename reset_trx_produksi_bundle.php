<?php require_once "core/init.php";

  //  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  //  cek_status($_SESSION['username'] ) == 'kensa' ) {
     $user = $_SESSION['username'];
     $temp_table = $_GET['temp'];
     $proses = ucfirst($_GET['proses']);
     

  if(reset_temp_produksi_bundle($user, $temp_table)) {
  header("Location: $temp_table.php");
    $_SESSION['pesan'] = "Data Transaksi $proses Berhasil Di Reset";
  }else{
    echo "gagal menghapus data";
  }

// } else {
//   echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

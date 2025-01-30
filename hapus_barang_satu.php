<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_barang($_GET['id'])) {
    $_SESSION['pesan']='Data Barang Berhasil Dihapus';
    header('Location: master_barang2.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_barang($_GET['id'])) {
    header('Location: master-barang.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

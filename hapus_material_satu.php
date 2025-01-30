<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_material($_GET['id'])) {
    $_SESSION['pesan']='DATA ITEM MATERIAL BERHASIL DI HAPUS';
    header('Location: master-material.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

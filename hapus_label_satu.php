<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_label($_GET['id'])) {
    $_SESSION['pesan']='Data Berhasil Dihapus';
    header('Location: master-label.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

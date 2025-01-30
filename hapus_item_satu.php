<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_item($_GET['id'])) {
    $_SESSION['pesan']='Data Item Berhasil Dihapus';
    header('Location: master_item.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_master_part($_GET['id'])) {
    $_SESSION['pesan']='Data Master Part Berhasil Dihapus';
    header('Location: master-part.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

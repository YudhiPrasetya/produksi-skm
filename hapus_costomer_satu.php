<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_costomer($_GET['id'])) {
    $_SESSION['pesan']='Data Costomer Berhasil Dihapus';
    header('Location: master-costomer.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_style($_GET['id'])) {
    header('Location: master-style.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

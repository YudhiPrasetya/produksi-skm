<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_packing($_GET['id'])) {
    header('Location: temp_packing.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

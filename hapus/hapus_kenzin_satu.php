<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_kenzin($_GET['id'])) {
    header('Location: temp_kenzin.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

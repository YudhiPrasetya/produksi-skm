<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_temp_ganti_label_grup($_GET['id'])) {
    header('Location: temp_ganti_label.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

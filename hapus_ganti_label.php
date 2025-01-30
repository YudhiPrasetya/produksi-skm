<?php require_once "core/init.php";

  if(reset_temp_ganti_label()) {
  header('Location: temp_ganti_label.php');
  }else{
  echo "gagal menghapus data";
  }

?>

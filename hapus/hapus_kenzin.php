<?php require_once "core/init.php";

  if(reset_temp_kenzin()) {
  header('Location: temp_kenzin.php');
  }else{
  echo "gagal menghapus data";
  }

?>

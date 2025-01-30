<?php require_once "core/init.php";

  if(reset_temp_packing()) {
  header('Location: temp_packing.php');
  }else{
  echo "gagal menghapus data";
  }

?>

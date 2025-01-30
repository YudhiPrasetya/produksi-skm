<?php require_once "core/init.php";

  if(reset_temp_kenzin3()) {
  header('Location: temp_kenzin3.php');
  }else{
  echo "gagal menghapus data";
  }

?>

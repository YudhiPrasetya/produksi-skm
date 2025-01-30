<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_line($_GET['id'])) {
    $_SESSION['pesan'] = "Data Line Berhasil Dihapus";
    header('Location: master-line.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

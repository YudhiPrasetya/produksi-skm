<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_qtyordersize_perorder($_GET['id'])) {
    header('Location: master-order.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

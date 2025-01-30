<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_shipment($_GET['id'])) {
    header('Location: master-shipment.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_contract($_GET['id'])) {
    header('Location: master-contract.php');
  }else{
  echo "gagal menghapus data";
  }
}
?>

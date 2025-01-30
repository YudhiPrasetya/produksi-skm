<?php require_once "core/init.php";

if(isset($_GET['id'])){
  if(hapus_data_qtyOrder($_GET['id']) && hapusDataMasterOrder($_GET['id'])) {
      
      $_SESSION['pesan'] = 'Data Berhasil Dihapus';
    header('Location: master-order.php');
  }else{
  echo "gagal menghapus data";
  }
} 
?>

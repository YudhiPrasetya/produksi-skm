<?php require_once "core/init.php";
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing_outerware' ) {
  
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
  // $dataid = explode(",", $data);
  // $id = max($dataid);
 
  
  $temp_packing = tampilkanQtyTempPackingID($id);
  $datatrx2 = mysqli_fetch_array($temp_packing);
  $qty_temp = $datatrx2['qty_packing'];
  $update_qty_delete = $qty_temp - 1;

    if($qty_temp <= 1){

      if(hapus_data_temp_packing_grup($id)) {
        $_SESSION['pesan']='Data Packing Berkurang Satu';
        header('Location: temp_packing.php');
      }else{
      echo "gagal menghapus data";
      } 
    }else{
      if(update_kurangi_qty_temp_packing($tanggal, $jam, $id, $update_qty_delete)) {
        $_SESSION['pesan']='Data Packing Berkurang Satu';
        header('Location: temp_packing.php');
      }else{
      echo "gagal menghapus data";
      }
    }
  }
} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

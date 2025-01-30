<?php require_once "core/init.php";
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'qcfinal' ) {
  
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
  // $dataid = explode(",", $data);
  // $id = max($dataid);

  $temp_tatami_in = tampilkanQtyTempTatamiInID($id);
  $datatrx2 = mysqli_fetch_array($temp_tatami_in);
  $qty_temp = $datatrx2['qty_tatami_in'];
  $update_qty_delete = $qty_temp - 1;
  
  if($qty_temp <= 1){

    if(hapus_data_tatami_in_grup($id)) {
      $_SESSION['pesan']='Data Tatami IN Berkurang Satu';
      header('Location: temp_tatami_in.php');
    }else{
    echo "gagal menghapus data";
    }
  }else{
    if(update_kurangi_qty_temp_tatami_in($tanggal, $jam, $id, $update_qty_delete)) {
      $_SESSION['pesan']='Data Tatami IN Berkurang Satu';
      header('Location: temp_tatami_in.php');
    }else{
    echo "gagal menghapus data";
    }
  }
}

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

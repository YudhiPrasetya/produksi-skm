<?php require_once "core/init.php";
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'qcfinal' ) {
  
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");
  // $dataid = explode(",", $data);
  // $id = max($dataid);

    $temp_qc_kensa = tampilkanQtyTempQCKensaID($id);
    $datatrx2 = mysqli_fetch_array($temp_qc_kensa);
    $qty_temp = $datatrx2['qty_qc_kensa'];
    $update_qty_delete = $qty_temp - 1;
    
  if($qty_temp <= 1){
     
    if(hapus_data_qc_kensa_grup($id)) {
      $_SESSION['pesan']='Data QC Kensa Berkurang Satu';
      header('Location: temp_qc_kensa.php');
    }else{
    echo "gagal menghapus data";
    }
  }else{
    if(update_kurangi_qty_temp_qc_kensa($tanggal, $jam, $id, $update_qty_delete)) {
      $_SESSION['pesan']='Data QC Kensa Berkurang Satu';
      header('Location: temp_qc_kensa.php');
    }else{
    echo "gagal menghapus data";
    }
  }
}
 
} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

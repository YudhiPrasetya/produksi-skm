<?php require_once "core/init.php";
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'qcfinal' ) {
  
if(isset($_GET['id'])){
  $data = $_GET['id'];
  $dataid = explode(",", $data);
  $id = max($dataid);

  if(hapus_data_temp_qcfinal_grup($id)) {
    $_SESSION['pesan']='Data QC Final Berkurang Satu';
    header('Location: temp_qcfinal.php');
  }else{
  echo "gagal menghapus data";
  }
}

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

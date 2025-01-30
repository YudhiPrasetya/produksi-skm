<?php require_once "core/init.php";
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'qcfinal' ) {
  
if(isset($_GET['id'])){
  $data = $_GET['id'];
  $dataid = explode(",", $data);
  $id = max($dataid);

  if(hapus_data_tatami_out_grup($id)) {
    $_SESSION['pesan']='Data Tatami Out Berkurang Satu';
    header('Location: temp_tatami_out.php');
  }else{
  echo "gagal menghapus data";
  }
}

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

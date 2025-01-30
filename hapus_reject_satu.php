<?php require_once "core/init.php";
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'tatami' ) {
  
if(isset($_GET['id'])){
  $data = $_GET['id'];
  $dataid = explode(",", $data);
  $id = max($dataid);

  if(hapus_data_reject_tatami_grup($id)) {
    $_SESSION['pesan']='Data Reject Berkurang Satu';
    header('Location: temp_reject_tatami.php');
  }else{
  echo "gagal menghapus data";
  }
}

} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

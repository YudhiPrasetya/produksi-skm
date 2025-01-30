<?
require_once 'core/init.php';
if(isset($_POST['update'])){
  
  $proses   = $_POST['id_proses'];
  $id_order   = $_POST['id_order'];
  $urutan    = $_POST['urutan'];
  echo $proses;
  
  
  if(!empty(trim($proses)) && !empty(trim($urutan))){

    if(edit_proses_orc_urutan($proses, $urutan)){
      $_SESSION['pesan'] = 'DATA BERHASIL DI EDIT';
      header("Location:edit_proses_orc.php?id=$id");
    } else {
      $error = 'Ada masalah saat mengedit data';
    }
  }else{
     $error='Ada data yang masih kosong, wajib di isi semua';
  }
}
 ?>
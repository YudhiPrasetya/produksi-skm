<?php
// Load file koneksi.php
require_once 'core/init.php';
// if(isset($_POST["submit"]) && $_POST["submit"]!=""){ 
$id = $_POST['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
// $kirim = $_POST['kirim'];

$data = implode(",", $id);

$status = $_POST['status'];

if($status == 'open'){
    $editStatus = 'close';
}else{
    $editStatus = 'open';
}

  if(update_status_master_order($editStatus, $data)){
        $_SESSION['pesan'] = 'Status Udah Berubah';
        header('Location: master-order.php');
    }else {
        $_SESSION['pesan'] = 'Gagal Status tidak Berubah';
        header('Location: master-order.php');
    }
  
?>

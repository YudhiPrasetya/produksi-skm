<?php
// Load file koneksi.php
require_once 'core/init.php';
// if(isset($_POST["submit"]) && $_POST["submit"]!=""){ 
$id = $_POST['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
// $kirim = $_POST['kirim'];
$data = implode(",", $id);
$lot = $_POST['lot'];
$user = $_POST['username'];


  if(update_master_bundle_lot($data, $lot, $user)){
    echo "success";
    }else {
    echo "error";
    }
  
?>

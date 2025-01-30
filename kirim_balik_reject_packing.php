<?php
// Load file koneksi.php
require_once 'core/init.php';
// if(isset($_POST["submit"]) && $_POST["submit"]!=""){ 
  $id = $_POST['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
  // $kirim = $_POST['kirim'];
  $data = implode(",", $id);
  $invoice = $_POST['packinglist'];
  $user = $_SESSION['username'];

  
  if( hapus_transaksi_reject($data) && kirim_balik_reject_packing($data, $nokarton)){
    $_SESSION['pesan'] = 'Data berhasil dikembalikan ke packing';
   header('Location: data-reject-packing.php');
    }else {
    echo "error";
    }
  
<?php
// Load file koneksi.php
require_once 'core/init.php';
// if(isset($_POST["submit"]) && $_POST["submit"]!=""){ 
$id = $_POST['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
// $kirim = $_POST['kirim'];
$data = implode(",", $id);
$invoice = $_POST['packinglist'];
$user = $_SESSION['username'];


  if(kirim_transaksi_shipment($data, $invoice, $user) && update_shipment_transaksi_scan_packing_y($data, $invoice)){
    echo "success";
    }else {
    echo "error"; 
    }
  
?>

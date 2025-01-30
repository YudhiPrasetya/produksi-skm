<?php
// Load file koneksi.php
require_once 'core/init.php';
// if(isset($_POST["submit"]) && $_POST["submit"]!=""){ 
$id = $_POST['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
// $kirim = $_POST['kirim'];
$data = implode(",", $id);
$invoice = $_POST['packinglist'];

  if(update_shipment_transaksi_scan_packing_n($data, $invoice) && delete_transaksi_temp_shipment($data, $invoice)){
    echo "success";
    }else {
    echo "error";
    }
  
?>

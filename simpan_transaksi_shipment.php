<?php
require_once 'core/init.php';

if(isset($_POST['kirim'])){
    $invoice = $_POST['invoice'];

    

    if(approve_transaksi_shipment($invoice)) {
    $_SESSION['pesan'] = 'Data Transaksi Shipment Berhasil DiApprove';
    header('Location:transaksi_shipment_all.php');
    }else{
    echo "gagal menyalin data";
    }
} 
?>
<?php
// Load file koneksi.php
require_once 'core/init.php';

$id = $_POST['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
$data = implode(",", $id);
// echo $data . '-'. $invoice;
// die;
 
if(transfer_shipment_packing($data) && hapus_transaksi_shipment($data) ){
  $_SESSION['pesan'] = "Kirim Balik data ke packing sukses";
   header('Location: data-shipment.php');
    }else {
    echo "error";
  }

// $query = "DELETE FROM transaksi_packing WHERE id_transaksi_packing IN ($data)"; // Buat variabel $query untuk menampung query delete

// // Eksekusi/Jalankan query dari variabel $query
// mysqli_query($connect, $query);


// header("location: transaksi-scan.php"); // Redirect ke halaman index.php
?>

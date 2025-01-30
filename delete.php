<?php
// Load file koneksi.php
require_once 'core/init.php';

$id = $_POST['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
$data = implode(",", $id);
// echo $data;
// die;

if(isset($data)){
    if(hapus_data_check($data)) {
      header('Location: transaksi-scan.php');
    }else{
    echo "gagal menghapus data";
    }
  }

// $query = "DELETE FROM transaksi_packing WHERE id_transaksi_packing IN ($data)"; // Buat variabel $query untuk menampung query delete

// // Eksekusi/Jalankan query dari variabel $query
// mysqli_query($connect, $query);


// header("location: transaksi-scan.php"); // Redirect ke halaman index.php
?>

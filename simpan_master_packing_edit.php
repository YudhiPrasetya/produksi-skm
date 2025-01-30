<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing'

) {

if(isset($_POST['kirim'])){
    $kelompok = $_POST['kelompok'];
    $trx = $_POST['trx'];
    
    if(update_transaksi_packing($trx, $kelompok)) {
    $_SESSION['pesan'] = 'Transaksi Packing Berhasil diupdate';
    header("Location:edit_packing.php?trx=$trx");
    }else{
    echo "gagal menyalin data";
    }
} 
} else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'kensa' 
) {

if(isset($_POST['kirim'])){
    $user = $_POST['user'];
  

    if(kirim_data_master_qc_kensa($user) && reset_temp_qc_kensa($user) ) {
    $_SESSION['pesan'] = 'Data Transaksi QC Kensa Berhasil disimpan';
    header('Location:temp_qc_kensa.php');
    }else{
    echo "gagal menyalin data";
    }
} 

} else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

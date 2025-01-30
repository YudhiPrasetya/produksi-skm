<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'qcfinal' 
) {

if(isset($_POST['kirim'])){
    $user = $_POST['user'];
  

    if(kirim_data_master_qcfinal($user) && reset_temp_qcfinal($user) ) {
    $_SESSION['pesan'] = 'Data Transaksi QC Final Berhasil disimpan';
    header('Location:temp_qcfinal.php');
    }else{
    echo "gagal menyalin data";
    }
} 

} else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

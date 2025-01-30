<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'tatami' 
) {

if(isset($_POST['kirim'])){
    $user = $_POST['user'];
  

    if(kirim_data_master_tatami_out($user) && reset_temp_tatami_out($user) ) {
    $_SESSION['pesan'] = 'Data Transaksi Tatami Out Berhasil disimpan';
    header('Location:temp_tatami_out.php');
    }else{
    echo "gagal menyalin data";
    }
} 

} else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

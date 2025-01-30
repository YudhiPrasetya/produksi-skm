<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'tatami' 
) {

if(isset($_POST['kirim'])){
    $user = $_POST['user'];
  

    if(kirim_data_master_tatami_in($user) && reset_temp_tatami_in($user) ) {
    $_SESSION['pesan'] = 'Data Transaksi Tatami In Berhasil disimpan';
    header('Location:temp_tatami_in.php');
    }else{
    echo "gagal menyalin data";
    }
} 

} else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

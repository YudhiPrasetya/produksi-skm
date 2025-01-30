<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'tatami' 
) {

if(isset($_POST['kirim'])){
    $user = $_POST['user'];
    $adjuzt = $_POST['adjuzt'];
    $keterangan = strtolower($_POST['keterangan']);    
    $tujuan = $_POST['tujuan'];
    

    if(kirim_data_master_reject_tatami($user, $adjuzt, $keterangan, $tujuan) && reset_temp_tatami_reject($user) ) {
    $_SESSION['pesan'] = 'Data Transaksi Reject Tatami Berhasil disimpan';
    header('Location:temp_reject_tatami.php');
    }else{
    echo "gagal menyalin data";
    }
} 

} else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

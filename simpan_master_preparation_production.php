<?php require_once "core/init.php";

if(cek_status($_SESSION['username'] ) == 'admin'
) {

if(isset($_POST['kirim'])){
    $id_order = $_POST['id_order'];
    $line = $_POST['line'];
    $plan_date = $_POST['plan_date'];
    $days_proses = $_POST['days_proses'];
    $username = $_SESSION['username'];
    

    if(tambah_data_preparation_production($id_order, $line, $days_proses, $plan_date, $username) && update_prod_pred_master_order($id_order)) {
    $_SESSION['pesan'] = 'Data Preparation Production Berhasil disimpan';
    header('Location:temp_preparation_production.php');
    }else{
    echo "gagal menyimpan data";
    }
} 
} else {
    echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

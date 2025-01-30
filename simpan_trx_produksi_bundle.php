<?php require_once "core/init.php";

// if(cek_status($_SESSION['username'] ) == 'admin' OR 
// cek_status($_SESSION['username'] ) == 'kensa' 
// ) {

if(isset($_POST['kirim'])){
    $user = $_SESSION['username'];
    $temp_table = $_POST['temp_table'];
    $table = $_POST['table'];
    $proses = ucfirst($_POST['proses']);
    // $line = $_POST['line'];

    
    if(isset($_POST['line'])){
        $line = $_POST['line'];
        if(kirim_data_transaksi_produksi_bundle_sewing($user, $temp_table, $table, $line) && reset_temp_produksi_bundle($user, $temp_table)) {
            // session_start();
            session_destroy();
            session_start();
            $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";

            header('Location: index.php');
            
            // header("Location:$temp_table.php");
            }else{
            echo "gagal menyalin data";
            }
    
    }else{
        if(kirim_data_transaksi_produksi_bundle($user, $temp_table, $table) && reset_temp_produksi_bundle($user, $temp_table)) {
            if($proses == 'sewing' || $proses == 'qc_endline' || $proses == 'qc_buyer' || $proses == 'qc_transfer' || $proses == 'tatami_in'){
            session_destroy();
            session_start();
            $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";
            header('Location: index.php');
            // header("Location:$temp_table.php");
            }else{
                $_SESSION['pesan'] = "Data Transaksi $proses Berhasil disimpan";
                header("Location:$temp_table.php");
            }
        }else{
        echo "gagal menyalin data";
        }
    }
} 

// } else {
//     echo 'Anda tidak memiliki akses kehalaman ini'; } 
?>

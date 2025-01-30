<?php require_once "core/init.php";

    if(cek_status($_SESSION['username'] ) == 'admin' OR 
    cek_status($_SESSION['username'] ) == 'kenzin' 
    ) {

    $idorder = $_GET['id'];

    if(open_master_order($idorder)) {
        $_SESSION['pesan'] = 'Data Order Berhasil di Open';
        header("Location:master-order.php");
        }else{
        echo "gagal menyalin data";
        }
   


    } else {
        echo 'Anda tidak memiliki akses kehalaman ini'; 
    }
    
    

?> 
  

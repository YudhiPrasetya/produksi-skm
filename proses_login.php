<?php
  require_once 'core/init.php';
  
  
  $username = trim($_POST['isi_barcode']);
  // $pass = trim($_POST['isi_barcode'])."_5km23";
  $pass = trim($_POST['isi_barcode']);

  if(!empty(trim($username)) && !empty(trim($pass))){
    if (cek_username($username) != 0){
      if($pilih = cek_data($username, $pass) == true){       
          $_SESSION['username'] = $username;
          $pesan =  cek_status($username);
      }else{
        $pesan = 'pass_salah';
      }

        }else{
          $pesan = 'not_valid'; 
        }
      }else{
        $pesan = 'kosong';
      }

      echo $pesan;
  

?>

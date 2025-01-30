<?php

  require_once 'core/init.php';

  if($_POST['type'] == 'delete'){
    $id = $_POST['id'];
    $temp_table = $_POST['temp_table'];

    if(hapus_trx_produksi_bundle($id, $temp_table)) {
        echo "success";
    }else{
        echo "errorDb";
    }
  }

  if($_POST['type'] == 'reset'){
    $user = $_POST['user'];
    $temp_table = $_POST['temp_table'];

    if(reset_temp_produksi_bundle($user, $temp_table)) {
        echo "success";
    }else{
        echo "errorDb";
    }
      
  }



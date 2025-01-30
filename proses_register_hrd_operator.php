<?php

  require_once 'core/init.php';

  if($_POST['type'] == 'insert'){
    $id_line = $_POST['id'];
    $date_register = $_POST['date_register'];
    $jml_register_hrd = $_POST['jml_register_hrd'];
    $user = $_POST['user'];
    
    if(tambah_master_line_operator($id_line, $date_register, $jml_register_hrd, $user)){
      echo "true";
      }else {
      echo "error";
      } 
    }

  
    if($_POST['type'] == 'edit'){
        $id = $_POST['id'];
        $date_register = $_POST['date_register'];
        $jml_register_hrd = $_POST['jml_register_hrd'];
        $user = $_SESSION['username'];

          if(edit_data_master_line_register_hrd($id, $date_register, $jml_register_hrd, $user)){
            echo "true";
            }else {
            echo "error";
            } 
          }    
      
  

  if($_POST['type'] == 'delete'){
      if(hapus_master_line_operator($_POST['id'])) {
        echo "true";
      }else {
        echo "error";
      } 
  }

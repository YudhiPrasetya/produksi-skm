<?php

  require_once 'core/init.php';

  if($_POST['type'] == 'insert'){
    $id = $_POST['id'];
    $size = $_POST['size'];
    $cup = $_POST['cup'];
    $qtyorder = $_POST['qtyorder'];
    $user = $_POST['user'];
    $orc = $_POST['orc'];
    $idstyle = $_POST['style'];

    $datastyle = tampilkan_style_id($idstyle);
    $pilih = mysqli_fetch_assoc($datastyle);
    $style = $pilih['style'];
    
    $barcode = "$orc-$size$cup";
    
    if(tambah_size_order($id, $size, $cup, $qtyorder, $user, $barcode)){
      echo "true";
      }else {
      echo "error";
      } 
    }

  
    if($_POST['type'] == 'edit'){
        $id = $_POST['id'];
        $size = $_POST['size'];
        $cup = $_POST['cup'];
        $barcode = $_POST['barcode'];
        $qtyorder_edit = $_POST['qtyorder_edit'];
    
          if(edit_data_size_order($id, $size, $cup, $barcode, $qtyorder_edit)){
            echo "true";
            }else {
            echo "error";
            } 
          }    
      
  

  if($_POST['type'] == 'delete'){
      if(hapus_data_qtyordersize_perorder($_POST['id'])) {
        echo "true";
      }else {
        echo "error";
      } 
  }

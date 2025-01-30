<?php

  require_once 'core/init.php';

  if($_POST['type'] == 'insert'){
    $size = trim($_POST['size']);
    $cup = trim($_POST['cup']);
    $qtyorder = $_POST['qtyorder']; 
    $user = $_POST['user'];
    $orc = trim($_POST['orc']);
    $idstyle = $_POST['style'];
    $color = trim($_POST['color']);
    $costomer = $_POST['costomer'];


    $datastyle = tampilkan_style_id($idstyle);
    $pilih = mysqli_fetch_assoc($datastyle);
    $style = $pilih['style']; 

    $barcode = "$orc-$size$cup";
    // $barcode2 = "$style-$size";

    // $datacos = cek_costomer_barcode_costomer($costomer);
    // $pilih2 = mysqli_fetch_assoc($datacos);
    // $barcode_costomer = $pilih2['barcode_costomer'];

    // if($barcode_costomer  == 'n'){
    //   if(check_barcode_barang_buyer($idstyle, $size) == 0){
    //     tambah_master_barang_no_barcode_buyer($barcode2, $idstyle, $size, $color);
    //   }
    // }

    // if(cekSizeTempOrderDouble($size, $cup, $user))
    if(tambah_data_temp_order($size, $qtyorder, $user, $barcode,$cup)){
      echo "true";
      }else {
      echo "error";
      } 
    }

  if($_POST['type'] == 'edit'){
    $id = $_POST['id'];
    $qtyorder_edit = $_POST['qtyorder_edit'];

      if(edit_data_temp_order($id, $qtyorder_edit)){
        echo "true";
        }else {
        echo "error";
        } 
      }     
  

  if($_POST['type'] == 'delete'){
      if(hapus_data_qtyordersize($_POST['id'])) {
        echo "true";
      }else {
        echo "error";
      } 
    
  }
 
?>

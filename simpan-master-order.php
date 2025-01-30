<?php
require_once 'core/init.php';

if(isset($_POST['kirim'])){
  $user = $_SESSION['username'];
  $costomer = $_POST['costomer'];
  $orc = $_POST['orc'];
  $po = $_POST['po'];
  $label = $_POST['label'];
  $style = $_POST['style'];
  $color = $_POST['color'];
  $prepare_on = $_POST['prepare_on'];
  $qty_bundle = $_POST['qty_bundle'];
  $shipment_plan = $_POST['shipment_plan'];

  if(!empty(trim($costomer)) && !empty(trim($orc)) && !empty(trim($po)) && !empty(trim($label)) 
  && !empty(trim($style)) && !empty(trim($color)) && !empty(trim($price))){
  if(kirim_data_master_order($costomer, $orc, $po, $label, $style, $color, $qty_bundle, $prepare_on, $shipment_plan, $user) && reset_temp_master_order($user) ) {
      
      
      $_SESSION['pesan'] = 'Data Order Berhasil disimpan';
      header('Location: master-order.php');
      }else{
      echo "gagal menghapus data";
      }
    }else{
      $_SESSION['pesan'] = 'Data Masih ada yang kosong silakan diulang';
    }
  } 
  ?>
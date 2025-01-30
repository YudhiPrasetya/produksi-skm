<?php
 require_once 'core/init.php';
if(isset($_POST['edit'])){
  $id = $_POST['id'];
  $style = $_POST['style'];
  $costomer = $_POST['costomer'];
  $po = $_POST['po'];
  $label = $_POST['label']; 
  $color = $_POST['color'];
  $qty_order = $_POST['qty_order'];
  $qty_bundle = $_POST['qty_bundle'];
  $prepare_on = $_POST['prepare_on'];
  $shipment_plan = $_POST['shipment_plan'];

  

  if(!empty(trim($id)) && !empty(trim($style)) && !empty(trim($costomer)) &&  !empty(trim($po)) && !empty(trim($label)) && !empty(trim($color))&& !empty(trim($qty_order)) ){
   

    if(!empty(trim($prepare_on)) || !empty(trim($shipment_plan)) || !empty(trim($qty_bundle))){
      if(edit_data_master_order($id, $style, $costomer, $po, $label, $color, $qty_order, $qty_bundle, $prepare_on, $shipment_plan)) {
        $_SESSION['pesan'] = 'Data Order Berhasil disimpan';
        header("Location: edit_master_order.php?id=$id");
      }else{
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    }else{
      if(edit_data_master_order2($id, $style, $costomer, $po, $label, $color, $qty_order)) {
        $_SESSION['pesan'] = 'Data Order Berhasil disimpan';
        header("Location: edit_master_order.php?id=$id");
      }else{
        echo "gagal menyimpan data";
      }
    }

  }else{
    $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
  }
}
?>
 
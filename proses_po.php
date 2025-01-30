<?php
  require_once 'core/init.php';

    $po = $_POST['po'];

  if(tambah_data_po($po)){
  echo "true";
  }else {
  echo "error";
}

?>

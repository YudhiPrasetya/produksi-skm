<?php
require_once 'core/init.php';

$orc = $_GET['orc'];
$sql = tampilkan_orc_po_label_master_order($orc);
$data = mysqli_fetch_array($sql);

$data = array(
    'orc'      =>  $data['orc'],
    'no_po'   =>  $data['no_po'],
    'label'    =>  $data['label'],);
echo json_encode($data);
?>



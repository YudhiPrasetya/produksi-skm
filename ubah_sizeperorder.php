<?php
require_once 'core/init.php';

if($_POST['type'] == 'edit'){
    $qty = $_POST['qty'];
    $id = $_POST['id_order_detail'];


    if(!empty(trim($qty)) && !empty(trim($id)) ){ 
        if(ubahsize_perorderdetail($id, $qty)){
            $sql1 = tampilkan_sizeperoderterpilih($id);
            $data1 = mysqli_fetch_array($sql1);

            $sql2 = tampilkanQtyperOrder($data1['id_order']);
            $data2 = mysqli_fetch_array($sql2);
            // echo $data1['qty_order'];
            $data = array(
            'qty_order'   =>  $data1['qty_order'],
            'total'   =>  $data2['total']);
            echo json_encode($data);
        }
    }


}else if ($_POST['type'] == 'tambah'){
    $id = $_POST['id_order'];
    $size = $_POST['size'];
    $qty = $_POST['qty_size'];
  
    if(!empty(trim($id)) && !empty(trim($size)) ){
        if(cekSizeID($id, $size) == 0){
            if(tambahSizeperOrder($id, $size, $qty)){
                 $sql = tampilkanMasterOrder($id);
                 $data2 = mysqli_fetch_array($sql);

                 $sql2 = tampilkanQtyperOrder($id);
                 $data3 = mysqli_fetch_array($sql2);
                 $data = array(
                    'id_order_detail' => $data2['id_order_detail'],
                    'id_order' => $data2['id_order'],
                    'size' => $data2['size'],
                    'qty_order' => $data2['qty_order'],
                    'total'   =>  $data3['total']);
                    echo json_encode($data);

            }else{
                echo  'errorDb';
            }
        }else{
            echo  "double";
        }
    }else{
        echo "kosong";
    }
    
}
?>


 
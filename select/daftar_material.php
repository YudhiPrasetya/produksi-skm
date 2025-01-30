<?php
    require_once '../core/init.php';

    if($_SERVER['REQUEST_METHOD']=="GET"){
        
        daftar_material($_GET['search']);
    }

    $material = tampilkan_master_material();
    if(cek_material_code($material_code) > 0){  
        $list = array();
        $key=0;
            while($row=mysqli_fetch_assoc($material)){
                $list[$key]['id'] = $row['id_material'];
                $list[$key]['text'] = $row['material_code']; 
            $key++;
            }
        echo json_encode($list);
    }else{
        echo "hasil kosong";
    }    
?>
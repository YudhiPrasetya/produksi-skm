<?php
    require_once 'core/init.php';

    // dipakai di page tampil_master_bom.php 
    if($_GET['kategori'] == 'daftar_material'){
        $cari   = $_GET['search'];
    
        
        if(cek_material_code($cari) > 0){  
            $list = array();
            $key=0;
            $material = tampilkan_master_material_search($cari);
                while($row=mysqli_fetch_assoc($material)){
                    $list[$key]['id'] = $row['id_material'];
                    $list[$key]['text'] = $row['material_code']." - ".$row['material_name']; 
             
                $key++;
                }
            echo json_encode($list);
        }else{
            echo "hasil kosong";
        }    
    }


    if($_GET['kategori'] == 'pilih_size'){
        $cari   = $_GET['search'];
        $id_order   = $_GET['id_order'];
    
        
        if(cek_material_code($cari) > 0){  
            $list = array();
            $key=0;
            $size = tampilkan_master_size_search_id_order($cari, $id_order);
                while($row=mysqli_fetch_assoc($size)){
                    $list[$key]['id'] = $row['id_order_detail'];
                    $list[$key]['text'] = $row['size']; 
             
                $key++;
                }
            echo json_encode($list);
        }else{
            echo "hasil kosong";
        }    
    }
?>
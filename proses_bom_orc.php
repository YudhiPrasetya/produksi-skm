<?php 
require_once 'core/init.php';

    if($_POST['type'] == 'insert_material'){
        $id_bom_orc = $_POST['id_bom_orc']; // id_style
        $id_material = $_POST['id_material'];
        $username = $_SESSION['username'];
        
        if(tambah_bom_orc_material($id_bom_orc, $id_material, $username)){
            echo 'success';
        }else{
            echo 'error';
        }
       
    }

    if($_POST['type'] == 'edit_material'){
        $id_bom_detail_orc = $_POST['id_bom_detail_orc']; // id_bom_detail
        $id_material = $_POST['id_material'];
        $username = $_SESSION['username'];
    

        if(edit_data_bom_material_orc($id_bom_detail_orc, $id_material, $username)){
            echo 'success';
        }else{
            echo 'error';
        }
            
    }

    if($_POST['type'] == 'delete_material'){
        $id = $_POST['id_bom_detail_orc']; // id_bom_detail
        
        if(cek_bom_material_part_orc($id) != 0 ){
            if(hapus_bom_detail_material_part_orc($id)){
                hapus_bom_detail_material_orc($id);
                $pesan = 'success';
            }else{
                $pesan = 'error';
            }
        }else{
            if(hapus_bom_detail_material_orc($id)){
                $pesan = 'success';
            }else{
                $pesan = 'error';
            }
        }
        echo $pesan;
    } 

    if($_POST['type'] == 'send_part'){
        $id_part = $_POST['id_part']; // id_bom_detail
        $id_bom_detail_orc = $_POST['id'];
        $username = $_SESSION['username'];
        if(cek_bom_material_part_orc_duplicate($id_part, $id_bom_detail_orc) != 0 ){
            $pesan = 'duplicate';
        }else{
            if(tambah_master_bom_detail_orc_part($id_bom_detail_orc, $id_part, $username)){
                $pesan = 'success';
            }else{
                $pesan = 'error';
            }
        }
        echo $pesan;
    }

    if($_POST['type'] == 'send_back_part'){

        $id_bom_detail_part = $_POST['id_bom_detail_part']; // id_bom_detail_part
        $username = $_SESSION['username'];
       
        
            if(hapus_bom_detail_material_part_orc_id($id_bom_detail_part)){
                echo 'success';
            }else{
                echo '$error';
            }

       
    }
<?php

require_once 'core/init.php';

    if($_POST['type'] == 'insert_material'){
        $id = $_POST['id']; // id_style
        $id_material = $_POST['id_material'];
        $id_bom = $_POST['id_bom'];
        $username = $_SESSION['username'];
        

        if($id_bom == ''){
            tambah_bom_style($id, $username);
            $sql = tampilkan_master_style_bom_id($id); // memilih entri nim pada database
            $data = mysqli_fetch_array($sql);
            $id_bom = $data['id_bom'];
        
        }


            if(cek_bom_material($id_bom, $id_material) != 0){
                $pesan = "duplicate";
                echo $pesan;  
                die();
            }else{
                if(tambah_bom_style_material($id_bom, $id_material, $username)){
                    $pesan = 'success';
                }else{
                    $pesan = 'error';
                }
            }
            echo $pesan;   
    }


    if($_POST['type'] == 'edit_material'){
        $id = $_POST['id']; // id_bom_detail
        $id_material = $_POST['id_material'];
        $id_bom = $_POST['id_bom'];
        $username = $_SESSION['username'];
        
           if(edit_data_bom_material($id, $id_material, $username)){
                    $pesan = 'success';
                }else{
                    $pesan = 'error';
            }
            echo $pesan;
        }
               


    if($_POST['type'] == 'delete_material'){
        $id = $_POST['id']; // id_bom_detail
        
        if(cek_bom_material_part($id) != 0 ){
            if(hapus_bom_detail_material_part($id)){
                hapus_bom_detail_material($id);
                $pesan = 'success';
            }else{
                $pesan = 'error';
            }
        }else{
            if(hapus_bom_detail_material($id)){
                $pesan = 'success';
            }else{
                $pesan = 'error';
            }
        }
        echo $pesan;
    } 

    if($_POST['type'] == 'send_part'){
        $id_part = $_POST['id_part']; // id_bom_detail
        $id_bom_detail = $_POST['id'];
        $username = $_SESSION['username'];
        if(cek_bom_material_part_duplicate($id_part, $id_bom_detail) != 0 ){
            $pesan = 'duplicate';
        }else{
            if(tambah_master_bom_detail_part($id_bom_detail, $id_part, $username)){
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
        
            if(hapus_bom_detail_material_part_id($id_bom_detail_part)){
                $pesan = 'success';
            }else{
                $pesan = '$error';
            }

        echo $pesan;
    }

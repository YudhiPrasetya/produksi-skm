<?php

  require_once 'core/init.php';

    if($_POST['type'] == 'insert'){
        $id = $_POST['id'];
        $color = $_POST['color'];
        $username = $_SESSION['username'];

        if(cek_color_style($id, $color) != 0){
            $pesan = "duplicate";
            echo $pesan;  
            die();
        }else{
            if(tambah_data_style_color($id, $color, $username)){
                $pesan = 'success';
            }else{
                $pesan = 'error';
            }
        }

        echo $pesan;   
    }

   

    if($_POST['type'] == 'edit'){
        $id = $_POST['id'];
        $color = $_POST['color'];
        $id_style = $_POST['id_style'];
        $username = $_SESSION['username'];

        
        if(cek_color_style($id_style, $color) != 0){
            $pesan = "duplicate";
            echo $pesan;  
            die();
        }

        

        if(edit_data_style_color($id, $color, $username)){
            $pesan = 'success';
        }else{
            $pesan = 'error';
        }
        echo $pesan;   
    }

    if($_POST['type'] == 'delete'){
        $id = $_POST['id_color_style'];

        
        if(hapus_data_style_color($id)){
            $pesan = 'success';
        }else{
            $pesan = 'error';
        }
        echo $pesan;   
    }

 
?>
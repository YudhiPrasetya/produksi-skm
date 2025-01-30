<?php

require_once 'core/init.php';

    if($_POST['type'] == 'simpan'){
    
            $id_order = $_POST['id_order'];
          $username = $_POST['user'];
          $nilai_smv = $_POST['nilai_smv'];
          $date_target = $_POST['date_target']; 
          $man_power = $_POST['man_power'];
          $jml_jam = $_POST['jml_jam'];
          $man_power_lembur = $_POST['man_power_lembur'];
          $jml_lembur = $_POST['jml_lembur'];
          $line = $_POST['line'];
          $persentase = $_POST['persentase'];
  
          
          

            if(!empty(trim($id_order)) && !empty(trim($nilai_smv)) && !empty(trim($date_target)) 
            && !empty(trim($man_power)) && !empty(trim($jml_jam))  && !empty(trim($line)) && !empty(trim($persentase))){
                if(cek_input_target_harian($id_order, $date_target, $line) == 0){
                    if(tambah_data_master_target($id_order, $username, $nilai_smv, $date_target, $man_power, $jml_jam, $man_power_lembur, $jml_lembur, $line, $persentase)) {
                    echo "success";
                    }else{
                    echo "errorDb";
                    }
                }else{
                    echo "duplicate";
                }
                
            }else{
                echo "kosong";
            }
           
    }

    if($_POST['type'] == 'edit'){
    
      $id = $_POST['id'];
      $username = $_SESSION['username'];
      $man_power = $_POST['man_power'];
      $jml_jam = $_POST['jml_jam_normal'];
      $man_power_lembur = $_POST['man_power_lembur'];
      $jml_lembur = $_POST['jml_lembur'];
      $line = $_POST['line'];
      $persentase = $_POST['persentase'];
      
        if(!empty(trim($id)) && !empty(trim($username))   && !empty(trim($man_power))
       && !empty(trim($jml_jam)) && !empty(trim($line)) && !empty(trim($persentase))){
          
                if(edit_data_master_target($id, $username, $man_power, $jml_jam, $man_power_lembur, $jml_lembur, $line, $persentase)) {
                echo "success";
                }else{
                echo "errorDb";
                }
           
        }else{
            echo "kosong";
        }
       
    }

    if($_POST['type'] == 'edit_remaks'){
    
        $id = $_POST['id'];
        $username = $_SESSION['username'];
        $remaks = $_POST['remaks'];

            
            if(edit_data_master_target_remaks($id, $username, $remaks)) {
            echo "success";
            }else{
            echo "errorDb";
            }
             
   
         
    }

    if($_POST['type'] == 'delete'){
    
        $id = $_POST['id'];
    
            if(hapusDataMasterTarget($id)) {
            echo "success";
            }else{
            echo "errorDb";
            }
             

         
      }
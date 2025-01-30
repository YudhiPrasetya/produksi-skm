<?php
 require_once 'core/init.php';

if($_POST['type'] == 'generate_bom'){
    $id_order = $_POST['id'];
    $username = $_SESSION['username'];
   
    if(cek_bom_orc($id_order) != 0){
        echo "duplicate";
    }else{
      $sql = mencari_data_di_master_order($id_order);
      $data = mysqli_fetch_assoc($sql);
      $id_style = $data['id_style'];
      

      $sql2 = mencari_data_di_master_bom($id_style);
      $data2 = mysqli_fetch_assoc($sql2);
      $id_bom = $data2['id_bom'];
   
      if(tambah_data_master_bom_orc($id_order, $id_bom, $username)){
        $sql3 = mencari_data_di_master_bom_orc($id_order);
        $data3 = mysqli_fetch_assoc($sql3);
        $id_bom_orc = $data3['id_bom_orc'];
       

        if(copy_master_bom_detail_to_orc($id_bom_orc, $id_bom, $username)){
          $sql4 = mencari_data_di_master_bom_detail_orc($id_bom_orc);
          while($data4 = mysqli_fetch_assoc($sql4)){
            $id_bom_detail = $data4['id_bom_detail']; //
            $id_bom_detail_orc = $data4['id_bom_detail_orc'];
            
            copy_master_bom_detail_part_to_orc($id_bom_detail_orc, $id_bom_detail, $username);
          }
          echo "success";
        }else{
          echo "error";
        }
      }
    }
  }

  if($_POST['type'] == 'generate_ulang_bom'){
    $id_order = $_POST['id_order'];
    $username = $_SESSION['username'];
   
   
    if(cek_bom_orc($id_order) != 0){
      $sql = mencari_data_di_master_bom_orc($id_order);
      $data = mysqli_fetch_assoc($sql);
      $id_bom = $data['id_bom'];
      $id_bom_orc = $data['id_bom_orc'];
     
      if(hapus_bom_detail_material_part_orc_id_order($id_bom_orc)){

        if(hapus_bom_detail_material_orc_id_order($id_bom_orc)){
          if(copy_master_bom_detail_to_orc($id_bom_orc, $id_bom, $username)){
            $sql4 = mencari_data_di_master_bom_detail_orc($id_bom_orc);
            while($data4 = mysqli_fetch_assoc($sql4)){
              $id_bom_detail = $data4['id_bom_detail']; //
              $id_bom_detail_orc = $data4['id_bom_detail_orc'];
              
              copy_master_bom_detail_part_to_orc($id_bom_detail_orc, $id_bom_detail, $username);
            }
            echo "success";
          }else{
            echo "error";
          }
        }
      }
    }
  }  

  
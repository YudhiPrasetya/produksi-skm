<?php
    require_once 'core/init.php';

    
    if($_GET['kategori'] == 'daftar_material'){
        $cari   = $_GET['search'];
    
        
        if(cek_material_code($cari) > 0){  
            
            $material = tampilkan_master_material_search($cari);
                while($row=mysqli_fetch_assoc($material)){ ?>
                <option value="<?= $row['item_material'] ?>"><?= $row['material_code']; ?>
                  
<?php
                }
        }    
    }
?>
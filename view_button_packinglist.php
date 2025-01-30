<?php require_once 'core/init.php'; ?>
<center>
<!-- <h3>CETAK PACKING LIST</h3> -->
  <h4>
    <?php
        $id_shipment = $_POST['rowedit'];
        $laporan4 = tampilkan_master_shipment_id($id_shipment);
        $data4 = mysqli_fetch_assoc($laporan4);

        $ListSize = tampilkan_size_transaksi_shipment($id_shipment);
        while($size = mysqli_fetch_array($ListSize)){
           ${$size['total_size']} = 0;
           $sumsize[] = $size['sum_size'];
          
        }
        // print_r($arraysize);
         
        $var_sumsize =implode(", ",$sumsize);
    
        
    ?>  
    
TRC NO : <?= $data4['no_invoice'] ?>
</h4>
<form action="laporan_packinglist_outerware.php" method="post" target="_blank">
<input type="hidden" value="<?= $id_shipment ?>" name="id_shipment" id="id_shipment">
<input type="hidden" value="<?= $var_sumsize ?>" name="var_sumsize" id="var_sumsize">
<button type="submit" class="btn btn-primary" >CETAK PL</button>
</form>
</center>
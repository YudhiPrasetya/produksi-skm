<?php require_once 'core/init.php'; ?>

<html>
    <head>
        <title>BUNDLE RECORD</title>
        <style type="text/css" media="print">
            @page { 
                
                width: 215mm;
                height: 330mm;
                size: landscape;
            }
        </style>
    </head>
    <body>
        <?php 
        $id_order = $_POST['id_order'];
        $kertas = $_POST['ukuran_kertas'];
        $limitSize = 6;
       
        $max_row = cekMaksimalUrutanBundle($id_order);
        $max_row_lember = 20;
        $datamax = mysqli_fetch_array($max_row);
        $nilaimax = $datamax['max_nourut'];
        
        $countSize = cekjumlahSize($id_order);
       
        if($nilaimax >= $max_row_lember*3 ){
            $a = 3;
        }elseif($nilaimax >= $max_row_lember*2 ){
            $a = 2;
        }else{
           $a = 1;
        }
    
        if($countSize >= 57){
            $b = 10;
        }elseif($countSize >= 50){
            $b = 9;
        }elseif($countSize >= 43){
            $b = 8;
        }elseif($countSize >= 37){
            $b = 7;
        }elseif($countSize >= 30){
            $b = 6;
        }elseif($countSize >= 25){
           $b = 5;
        }elseif($countSize >= 19){
            $b = 4;
        }elseif($countSize >= 13){
            $b = 3;
        }elseif($countSize >= 7){
            $b = 2;
        }else{
            $b = 1;
        }
        
        for ($j = 1; $j <= $a; $j++){
            $offset = -$limitSize;
            for ($k = 1; $k <= $b; $k++){
                $offset+=$limitSize;
                $bundleMax = cekTotalBundleMax($id_order, $offset, $limitSize);
                $dataBundle = mysqli_fetch_array($bundleMax);
                $nilaiMaxBundle = $dataBundle['total_bundle_max'];
                $totalhal = ceil($nilaiMaxBundle / $max_row_lember);
                
    if($totalhal >= $j){
                
        ?>
        <h3>PT. Globalindo Intimates<br>
            BUNDLE RECORD
        </h3>
        <hr align="center" size="3" noshade>
        <?php
       
        $bundle = tampilkan_bundle_orc($id_order);
        while($pilih = mysqli_fetch_array($bundle)){
        ?>
        
        <table>
            <tr>
                <td>ORC</td>
                <td> : </td>
                <td><?= $pilih['orc']; ?></td>
                <td width="7%"></td>
                <td>COSTOMER</td>
                <td> : </td>
                <td width=5%><?= $pilih['costomer']; ?></td>
                <td width="8%"></td>
                <td>QTY ORDER</td>
                <td> : </td>
                <td><?= $pilih['total_qty']; ?> PCS</td>
                <td width="8%"></td>
                <td>SHIPMENT ON</td>
                <td> : </td>
                <td width="8%"><?= tanggal_indo3($pilih['shipment_plan']); ?></td>
            </tr>
            <tr>
                <td>STYLE</td>
                <td> : </td>
                <td><?= $pilih['style']; ?></td>
                <td width="8%"></td>
                <td>COM</td>
                <td> : </td>
                <td>1</td>
                <td width="8%"></td>
                <td>BUNDLES QTY</td>
                <td> : </td>
                <td><?= $pilih['qty_bundle'] ?> BOX</td>
                <td width="8%"></td>
                <td>ITEM</td>
                <td> : </td>
                <td><?= $pilih['item'] ?></td>
            </tr>
            <tr>
                <td>COLOR</td>
                <td> : </td>
                <td><?= $pilih['color']; ?></td>
                <td width="8%"></td>
                <td>PO BUYER</td>
                <td> : </td>
                <td><?= $pilih['no_po']; ?></td>
                <td width="8%"></td>
                <td>PREPARE ON</td>
                <td> : </td>
                <td><?= tanggal_indo3($pilih['prepare_on']); ?></td>
                <td width="8%"></td>
                <td></td>
                <td>  </td>
                <td></td>
            </tr>
        </table>
        <hr align="center" size="3" noshade>
        <?php } 
            $cekCountSize = cekCountSize($id_order, $offset, $limitSize);
            $width = $cekCountSize * 16.7;
        ?>
        
        <table  border='1' class='table table-striped table-hover' width='<?=$width ?>%' cellpadding=3 cellspacing=0 style="font-size: 13px">
            <thead>
                <tr>
                    <?php
                    $order_detail1 = tampilkan_bundle_orc_size($id_order, $offset, $limitSize);
                    while($pilih2 = mysqli_fetch_array($order_detail1)){
                    ?>
                    <th width="4%">SIZE</th>
                    <th colspan="4"><?= $pilih2['size'].$pilih2['cup'] ?></th>
                    <th rowspan=4>TTD</th>
                    <?php } ?>
                </tr>
                
                <tr>
                    <?php
                    $order_detail1 = tampilkan_bundle_orc_size($id_order, $offset, $limitSize);
                    while($pilih2 = mysqli_fetch_array($order_detail1)){
                    ?>
                    <th>QTY</th>
                    <th colspan=4><?= $pilih2['qty_order'] ?></th>
                    <?php } ?>
                </tr>
                <tr>
                    <?php
                    $order_detail1 = tampilkan_bundle_orc_size($id_order, $offset, $limitSize);
                    while($pilih2 = mysqli_fetch_array($order_detail1)){
                    ?>
                    <th width="15px" rowspan=2>NO</th>
                    <th width="10px" colspan=4>DATE</th>
                    <?php } ?>
                </tr>
                <tr>
                    <?php
                    $order_detail1 = tampilkan_bundle_orc_size($id_order, $offset, $limitSize);
                    while($pilih2 = mysqli_fetch_array($order_detail1)){
                    ?>
                    <th width="25px" colspan=2>IN</th>
                    <th width="15px" colspan=2>OUT</th>
                    <?php } ?>
                </tr>
            </thead> 
            <tbody>
            <?php 

                if($j >= 4 ){
                    $hal_bottom = $max_row_lember*3+1;
                    $hal_row = $max_row_lember*4;
                }
                if($j >= 3 ){
                    $hal_bottom = $max_row_lember*2+1;
                    $hal_row = $max_row_lember*3;
                }elseif($j >= 2 ){
                    $hal_bottom = $max_row_lember+1;
                    $hal_row = $max_row_lember*2;
                }else{
                    $hal_bottom = 1;
                    $hal_row = $max_row_lember;
                }
             
                for ($i = $hal_bottom; $i <= $hal_row; $i+=1){
            ?>
            <tr height="23px">
                <?php
                    $order_detail1 = tampilkan_bundle_orc_size($id_order, $offset, $limitSize );
                    while($pilih2 = mysqli_fetch_array($order_detail1)){
                    $id_order_detail = $pilih2['id_order_detail'];

                    $bundle_data = tampilkan_bundle_orc_nomer($id_order_detail, $i);
                    while($pilih3 = mysqli_fetch_array($bundle_data)){
                    
                ?>
                <td><center><?= $pilih3['no_bundle']; ?></center></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <?php } } ?>
            </tr>
            <?php } ?>

            </tbody>
        </table>
        <?php }  
            if($kertas == 'f4'){
        ?>
        <div style="height: 40px;"></div>
   <?php } }  }?>
    </body>
</html>
<script>
		window.print();
	</script>

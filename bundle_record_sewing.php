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
        
         $id_order = $_GET['id'];
         $proses = $_GET['proses'];
         $tgl = $_GET['tgl'];
         $total_input = 0;
         $total_balance_input = 0;
         $total_output = 0;
         $total_balance_output = 0;
         
         $temp1 = mencari_data_master_transaksi($proses);
         $datatransaksi = mysqli_fetch_array($temp1);
         $table = $datatransaksi['table_transaksi'];
         
         
        $limit_baris = 21;
        $nama = tampilkanNamaPerusahaan();
        $dataperusahaan = mysqli_fetch_array($nama);
        $namaperusahaan = $dataperusahaan['nama_perusahaan'];
        $bundle = tampilkan_bundle_orc($id_order);
        $pilih = mysqli_fetch_array($bundle);
?>
       
       
        <h4><?= $namaperusahaan; ?><br>
            BUNDLE RECORD - <?= strtoupper($proses) ?> S/D TGL  <?= tgl_indonesia3($tgl) ?>
        </h4>
        <hr align="center" size="2" noshade>
       
        <table style="font-size: 13px">
            <tr>
                <td>ORC</td>
                <td> : </td>
                <td width="20%"><?= $pilih['orc']; ?></td>

                <td>COSTOMER</td>
                <td> : </td>
                <td  width="20%"><?= $pilih['costomer']; ?></td>
               
                <td>QTY ORDER</td>
                <td> : </td>
                <td width="15%"><?= $pilih['qty_order']; ?> PCS</td>
                
                <td>SHIPMENT ON</td>
                <td> : </td>
                <td width="15%"><?= tanggal_indo3($pilih['shipment_plan']); ?></td>
            </tr>
            <tr>
                <td>STYLE</td>
                <td> : </td>
                <td width="20%"><?= $pilih['style']; ?></td>
                
                <td>COM</td>
                <td> : </td>
                <td width="20%">1</td>
               
                <td>BUNDLES QTY</td>
                <td> : </td>
                <td width="15%"><?= $pilih['total_bundle'] ?> BOX</td>
               
                <td>ITEM</td>
                <td> : </td>
                <td width="15%"><?= $pilih['item'] ?></td>
            </tr>
            <tr>
                <td>COLOR</td>
                <td> : </td>
                <td width="20%"><?= $pilih['color']; ?></td>
                
                <td>PO BUYER</td>
                <td> : </td>
                <td width="20%"><?= $pilih['no_po']; ?></td>
                
                <td>PREPARE ON</td>
                <td> : </td>
                <td width="15%"><?= tanggal_indo3($pilih['prepare_on']); ?></td>
                
                <td></td>
                <td>  </td>
                <td></td>
            </tr>
        </table>
        
      
        <?php 
    
        $limitSize = 1;
        $offset = -$limitSize;
        $jumlahSize = cekjumlahSize($id_order);
        for($b=0; $b<$jumlahSize; $b++){

        $order_detail1 = tampilkan_bundle_orc_size($id_order, $b);
        $pilih2 = mysqli_fetch_array($order_detail1);
        
        $limitMin = $b;
        $limitMax = $b+1;
        $id_order_detail = $pilih2['id_order_detail'];
        
        $JumlahKolomSizeMinNew = 0;
        $cekMinNew = Cek_jumlah_bundle_size_id_order_new($id_order, $limitMin);
        while($data=mysqli_fetch_assoc($cekMinNew)){
            $JumlahKolomSizeMinNew += $data['total'];
        }
        $JumlahKolomSizeMinNew = $JumlahKolomSizeMinNew + 1;

        $JumlahKolomSizeMaxNew = 0;
        $cekMaxNew = Cek_jumlah_bundle_size_id_order_new($id_order, $limitMax);
        while($data2=mysqli_fetch_assoc($cekMaxNew)){
            $JumlahKolomSizeMaxNew += $data2['total'];
        }
       
        // $cekMin = Cek_jumlah_bundle_size_id_order($id_order, $limitMin);
        // $cekMax = Cek_jumlah_bundle_size_id_order($id_order, $limitMax);
        // $JumlahKolomSizeMin = ceil($cekMin/$limit_baris)+1;
        // $JumlahKolomSizeMax = ceil($cekMax/$limit_baris);
        
        $jumlah_bundle_size = Cek_jumlah_bundle_size($id_order_detail);
        // $JumlahKolomSize = ceil($JumlahKolomSizeMax/$limit_baris);
        $offsetbundle = -$limit_baris;
        
        for($a=$JumlahKolomSizeMinNew; $a<=$JumlahKolomSizeMaxNew; $a++){
            $offsetbundle+=$limit_baris; 


         ?>
         <!-- <div> -->
           <table style="float: left; font-size: 12px" border='1' width='24.7%' cellpadding=3 cellspacing=0 >
                <tr>
                    <th width="4%">SIZE</th>
                    <th colspan="6"><?= $pilih2['size'].$pilih2['cup'] ?></th>
                </tr>
                <tr> 
                    <th>QTY</th>
                    <th colspan=6><?= $pilih2['qty_order'] ?></th>
                </tr>
                <tr>
                    <th width="2%">NO</th>
                    <th width="5%" colspan=2>IN</th>
                    <th width="5%" colspan=2 style="background: yellow">OUT</th>
                    <th width="5%" style="background: yellow">L-DATE</th>
                    <th width="5%">LINE</th>
                </tr>
            <?php
                    $jumlah_bundle =  cek_jumlah_bundle_persize($id_order_detail, $offsetbundle, $limit_baris);
                    $kekurangan_baris = $limit_baris - $jumlah_bundle;
                    
                    $bundle_data = tampilkan_bundle_orc_nomer_new_transaksi_sewing_in_out($id_order_detail, $offsetbundle, $limit_baris, $tgl);
                    while($pilih3 = mysqli_fetch_array($bundle_data)){
    
                ?>
               
            <tr height="23px">
                <td <?php if($pilih3['total_input'] == $pilih3['qty_isi_bundle']) { ?> style="background: #7FFFD4" <?php }elseif(($pilih3['total_input'] > 0) && ($pilih3['total_input'] < $pilih3['qty_isi_bundle'])){ ?> style="background: #FFB6C1" <?php } ?> ><center><a href="print_ticket_pecah_bundle.php?id=<?= $id_order ?>&barcode=<?= $pilih3['barcode_bundle']; ?>&proses=<?= $proses ?>&balance=<?= $pilih3['balance_output']; ?>" target="_blank"> <?= $pilih3['no_bundle']; ?> </a></center></td>
                <td <?php if($pilih3['total_input'] == $pilih3['qty_isi_bundle']) { ?> style="background: #7FFFD4" <?php }elseif(($pilih3['total_input'] > 0) && ($pilih3['total_input'] < $pilih3['qty_isi_bundle'])){ ?> style="background: #FFB6C1" <?php } ?>><center><?= $pilih3['total_input']; ?></center></td>
                <td <?php if($pilih3['total_input'] == $pilih3['qty_isi_bundle']) { ?> style="background: #7FFFD4" <?php }elseif(($pilih3['total_input'] > 0) && ($pilih3['total_input'] < $pilih3['qty_isi_bundle'])){ ?> style="background: #FFB6C1" <?php } ?>><center><?= $pilih3['balance_input']; ?></center></td>
                <td <?php if($pilih3['total_output'] == $pilih3['qty_isi_bundle']) { ?> style="background: #7FFFD4" <?php }elseif(($pilih3['total_output'] > 0) && ($pilih3['total_output'] < $pilih3['qty_isi_bundle'])){ ?> style="background: #FFB6C1" <?php } ?>><center><?= $pilih3['total_output']; ?></center></td>
                <td <?php if($pilih3['total_output'] == $pilih3['qty_isi_bundle']) { ?> style="background: #7FFFD4" <?php }elseif(($pilih3['total_output'] > 0) && ($pilih3['total_output'] < $pilih3['qty_isi_bundle'])){ ?> style="background: #FFB6C1" <?php } ?>><center><?= $pilih3['balance_output']; ?></center></td>
                <td <?php if($pilih3['total_output'] == $pilih3['qty_isi_bundle']) { ?> style="background: #7FFFD4" <?php }elseif(($pilih3['total_output'] > 0) && ($pilih3['total_output'] < $pilih3['qty_isi_bundle'])){ ?> style="background: #FFB6C1" <?php } ?>><center><?= tgl_indonesia4($pilih3['tanggal_max']); ?></td>
                <td <?php if($pilih3['total_output'] == $pilih3['qty_isi_bundle']) { ?> style="background: #7FFFD4" <?php }elseif(($pilih3['total_output'] > 0) && ($pilih3['total_output'] < $pilih3['qty_isi_bundle'])){ ?> style="background: #FFB6C1" <?php } ?>><center><?= ucfirst($pilih3['line']); ?></td>
                <?php
                     $total_input += $pilih3['total_input']; 
                     $total_balance_input += $pilih3['balance_input'];
                     $total_output += $pilih3['total_output']; 
                     $total_balance_output += $pilih3['balance_output'];
                ?>
            </tr> 
            <?php }  ?>
            
            <?php
                if($kekurangan_baris != 0){
                   
                   for($c=1; $c<=$kekurangan_baris; $c++){
                    ?>
            <tr height="23px">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php } } ?>
            <tr>
                <td style="background: yellow"><center><b>TOT </b></center></td>
                <td style="background: yellow"><center><b><?= $total_input ?></b></center></td>
                <td style="background: yellow"><center><b><?= $total_balance_input ?></b></center></td>
                <td style="background: yellow"><center><b><?= $total_output ?></b></center></td>
                <td style="background: yellow"><center><b><?= $total_balance_output ?></b></center></td>
                <td style="background: yellow" colspan="2"><center><b><?= $jumlah_bundle_size ?> BOX</b></center></td>
            </tr>
        </table>
        <?php 
        $total_input = 0;
        $total_balance_input = 0;
        $total_output = 0;
        $total_balance_output = 0;
        $hasil = $a%4;
        if($hasil == 0){
        ?>
       
       <h4><?= $namaperusahaan; ?><br>
            BUNDLE RECORD - <?= strtoupper($proses) ?> S/D TGL  <?= tgl_indonesia3($tgl) ?>
        </h4>
        <hr align="center" size="2" noshade>
       
        <table style="font-size: 13px">
            <tr>
                <td>ORC</td>
                <td> : </td>
                <td width="20%"><?= $pilih['orc']; ?></td>

                <td>COSTOMER</td>
                <td> : </td>
                <td  width="20%"><?= $pilih['costomer']; ?></td>
               
                <td>QTY ORDER</td>
                <td> : </td>
                <td width="15%"><?= $pilih['qty_order']; ?> PCS</td>
                
                <td>SHIPMENT ON</td>
                <td> : </td>
                <td width="15%"><?= tanggal_indo3($pilih['shipment_plan']); ?></td>
            </tr>
            <tr>
                <td>STYLE</td>
                <td> : </td>
                <td width="20%"><?= $pilih['style']; ?></td>
                
                <td>COM</td>
                <td> : </td>
                <td width="20%">1</td>
               
                <td>BUNDLES QTY</td>
                <td> : </td>
                <td width="15%"><?= $pilih['total_bundle'] ?> BOX</td>
               
                <td>ITEM</td>
                <td> : </td>
                <td width="15%"><?= $pilih['item'] ?></td>
            </tr>
            <tr>
                <td>COLOR</td>
                <td> : </td>
                <td width="20%"><?= $pilih['color']; ?></td>
                
                <td>PO BUYER</td>
                <td> : </td>
                <td width="20%"><?= $pilih['no_po']; ?></td>
                
                <td>PREPARE ON</td>
                <td> : </td>
                <td width="15%"><?= tanggal_indo3($pilih['prepare_on']); ?></td>
                
                <td></td>
                <td>  </td>
                <td></td>
            </tr>
        </table>
            <?php } } }
            
         ?>
     
                
            </body>
</html>

<?php
    require_once 'core/init.php';
    if( !isset($_SESSION['username']) ){
      echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
      // header('Location: index.php');    
    }
    $id_shipment = $_POST['id_shipment'];
    $var_sumsize = $_POST['var_sumsize'];
    $var_weightsize = $_POST['var_weightsize'];
   
    $ListSize = tampilkan_size_transaksi_shipment2($id_shipment);
    while($size = mysqli_fetch_array($ListSize)){
        ${$size['total_size']} = 0;
        // $sumsize[] = $size['sum_size'];
             
    }

    $subtotal =0;
    $qty_total=0;
    $qty_total_semua=0;
    $total_cbm = 0;
    $total_nw = 0;
    $total_gw = 0;
    $total_semua_nw = 0;
    $total_semua_gw = 0;
    $total_semua_gw_mix = 0;
    $jmlh_karton = 0;
    $tot_jmlh_karton1 = 0;
    $tot_jmlh_karton2 = 0;

?>
 <title>LAPORAN PACKING LIST</title>
 <center>
 <h3>LAPORAN PACKING LIST</h3>
  <h4>
    <?php
        $laporan4 = tampilkan_master_shipment_id($id_shipment);
        $data4 = mysqli_fetch_assoc($laporan4);
        
    ?>  
    
TRC NO : <?= $data4['no_invoice'] ?>
</h4>
</center>

<?php

$data5 = tampilkan_item_no_weight($id_shipment);
      while($pilih5 = mysqli_fetch_array($data5)){
echo $pilih5['kode_barcode']."-".$pilih5['style']."-".$pilih5['warna']."-".$pilih5['size'].$pilih5['cup']."<br>";
}

?>

<?php
if(cek_jumlah_size_invoice_not_mixstyle2($id_shipment) != 0){

$laporan = tampilkan_laporan_packinglist_header2($id_shipment);
    while($pilih = mysqli_fetch_array($laporan)){
        
        $ctk[$pilih['orc']][$pilih['no_po']][$pilih['style']][$pilih['color']][$pilih['costomer']][$pilih['label']][]=array(
            'orc'=>$pilih['orc']
           
            
          );                                            
    }
    foreach($ctk as $orc=>$no_po)
    foreach($no_po as $po=>$kd_style)
    foreach($kd_style as $style=>$kdcolor)
    foreach($kdcolor as $color=>$kdcostomer)
    foreach($kdcostomer as $costomer=>$kdlabel)
    foreach($kdlabel as $label=>$data){
?>

<table class='hlap' width='100%' >
<tr>
    <td width='10%'>ORC</td><td width='1%'>:</td><td width='20%' align='left'><?= $orc ?>  </td>
    <td width='55%'></td>
    <td width='5%'>COSTOMER</td><td width='1%'>:</td><td width='20%' align='left'><?= $costomer ?></td>
  </tr>

  <tr>
    <td width='10%'>Style</td><td width='1%'>:</td><td width='20%' align='left'><?= $style. ' ( ' .$color ?> ) </td>
    <td width='55%'></td>
    <td width='5%'>No PO</td><td width='1%'>:</td><td width='20%' align='left'><?= $po ?></td>
  </tr>
  <tr>
    <td width='10%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='20%' align='left'></td>
    <td width='55%'></td>
    <td width='5%'>Label</td><td width='1%'>:</td><td width='20%' align='left'><?= $label ?></td>
  </tr>
</table>


<table  border='1' class='table table-striped table-hover' width=100% cellpadding="2px"; cellspacing="0" style="font-size: 13px;">
  <thead>
    <tr>
    <th style="background-color:#20B2AA; color: #ffffff" colspan="2"><center>NO KARTON</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="2" rowspan="2"><center>QTY/CTN</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="<?= cek_jumlah_size_orc_invoice2($id_shipment, $orc); ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>QTY</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>NW</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>GW</center></th>
    </tr>
    <tr>
        <th style="background-color:#20B2AA; color: #ffffff"><center>FR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>TO</center></th>
        <?php $ListSize2 = tampilkan_size_transaksi_shipment_orc_invoice2($id_shipment, $orc); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
          <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
        <?php } ?>
        <th style="background-color:#20B2AA; color: #ffffff"><center>CTN</center></th>
     
    </tr>
  </thead>

  <tbody>
    <?php
          $no=1;       
        $laporan2 = tampilkan_laporan_packinglist_orc2($id_shipment, $orc, $var_sumsize, $var_weightsize);
      while($pilih2 = mysqli_fetch_array($laporan2)){
      
        $no_to = $no+$pilih2['karton']-1;
        $berat_gw = $pilih2['nw']+$pilih2['karton'];
      ?>
    <tr class="belang">
      <td align='center'><?= $no; ?></td>
      <td align='center'><?= $no_to; ?></td>
      <td align='center' ><?= $pilih2['jumlah_size']/$pilih2['karton'] ?></td>
      <td align='center'><?= $pilih2['karton']; ?></td>
      <td align='center'><?= $pilih2['label'] ?></td>
      <td align='center'><?= $pilih2['style'] ?></td>
      <td align='center'><?= $pilih2['warna'] ?></td>
      <?php $ListSize2 = tampilkan_size_transaksi_shipment_orc_invoice2($id_shipment, $orc); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
      <td align='center'><?= $pilih2[$size2['detail_size']]; ?> 
        <?php 
          ${$size2['total_size']} +=  $pilih2[$size2['detail_size']];
        ?>
    </td>
        <?php } ?>
        <td align='center'><?= $pilih2['jumlah_size'] ?></td>
        <td align="center"><?= $pilih2['nw'] ?></td>
        <td align="center"><?= $berat_gw ?></td>
    </tr>
    <?php
        $no += $pilih2['karton']; 
        $qty_total += $pilih2['jumlah_size'];
        $total_nw += $pilih2['nw'];
        $total_gw += $berat_gw;
        $total_semua_nw += $pilih2['nw'];
        $total_semua_gw += $berat_gw;
        $qty_total_semua += $pilih2['jumlah_size'];
        $jmlh_karton += $pilih2['karton'];
        $tot_jmlh_karton1 += $pilih2['karton'];

        } 
     ?>
    <tr>
        <td colspan="7" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
        <?php 
            $ListSize2 = tampilkan_size_transaksi_shipment_orc_invoice2($id_shipment, $orc); 
            while($size2 = mysqli_fetch_array($ListSize2)){ ?>
        <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= ${$size2['total_size']} ?></td>
        <?php } ?>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $total_nw ?></td>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $total_gw ?></td>
        </tr> 

        <tr>
            <td colspan="<?php $total_size = cek_jumlah_size_orc_invoice2($id_shipment, $orc) + 10; echo $total_size;  ?>">
                TOTAL QUANTITY : <?= $qty_total ?> PCS
            </td>
        </tr>
        <tr>
            <td colspan="<?php $total_size = cek_jumlah_size_orc_invoice2($id_shipment, $orc) + 10; echo $total_size;  ?>">
                TOTAL CARTON : <?= $jmlh_karton ?> CTN
            </td>
        </tr>
<?php 

$qty_total=0;
$jmlh_karton=0;
$total_nw = 0;
$total_gw = 0;
$ListSize2 = tampilkan_size_transaksi_shipment_orc_invoice2($id_shipment, $orc); 
  while($size2 = mysqli_fetch_array($ListSize2)){
    ${$size2['total_size']} = 0;
  }   ?>
</tbody>
</table>
<br>
<?php } 
}
?>



<?php
if(cek_jumlah_size_invoice_mixstyle2($id_shipment) != 0){
?>
<center><h3>TRANSAKSI MIX SYLE</h3></center>
<?php
    $no2 = 0;
    
    $laporan3 = tampilkan_laporan_packinglist_header_mixstyle2($id_shipment);
    $no2++;
    while($pilih3 = mysqli_fetch_array($laporan3)){
        $no_trx2 = $pilih3['no_trx'];
        $costomer2 = $pilih3['costomer'];
        $po2 = $pilih3['no_po'];
    ?>

<table class='hlap' width='100%' >
<tr>
    <td width='10%'>NO PO</td><td width='1%'>:</td><td width='20%' align='left'><?= $po2 ?> </td>
    <td width='55%'></td>
    <td width='5%'>COSTOMER</td><td width='1%'>:</td><td width='20%' align='left'><?= $costomer2 ?></td>
  </tr>

  <tr>
    <td width='10%'>NO TRX</td><td width='1%'>:</td><td width='20%' align='left'><?= $no_trx2 ?> ( MIX STYLE / COLOR ) </td>
    <td width='55%'></td>
    <td width='5%'></td><td width='1%'></td><td width='20%' align='left'></td>
  </tr>
  <tr>
    <td width='10%'><b>Detail</b></td><td width='1%'>:</td><td width='20%' align='left'></td>
    <td width='55%'></td>
    <td width='5%'></td><td width='1%'>:</td><td width='20%' align='left'></td>
  </tr>
</table>

<table  border='1' class='table table-striped table-hover' width=100% cellpadding="2px"; cellspacing="0" style="font-size: 13px;">
  <thead>
    <tr>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2" ><center>NO KARTON</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>ORC</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="<?= cek_jumlah_size_notrx_invoice_mixstyle2($id_shipment, $no_trx2); ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>QTY</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>NW</center></th>
      <!-- <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>GW</center></th> -->
    </tr>
    <tr>
        <?php $ListSize2 = tampilkan_size_transaksi_shipment_orc_invoice_mixstyle2($id_shipment, $no_trx2); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
          <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
        <?php } ?>
        <th style="background-color:#20B2AA; color: #ffffff"><center>CTN</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
          $no=1;       
        $laporan4 = tampilkan_laporan_packinglist_invoice_mixstyle2($id_shipment, $no_trx2, $var_sumsize, $var_weightsize);
        while($pilih4 = mysqli_fetch_array($laporan4)){
      
        $no_to = $no+$pilih4['karton']-1;
      
      ?>
    <tr class="belang">
      <td align='center'><?= $no; ?></td>
      <td align='center'><?=  $pilih4['orc']; ?></td>
      <td align='center'><?= $pilih4['label'] ?></td>
      <td align='center'><?= $pilih4['style'] ?></td>
      <td align='center'><?= $pilih4['warna'] ?></td>
      <?php $ListSize2 = tampilkan_size_transaksi_shipment_orc_invoice_mixstyle2($id_shipment, $no_trx2); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
      <td align='center'><?= $pilih4[$size2['detail_size']]; ?> 
        <?php 
          ${$size2['total_size']} +=  $pilih4[$size2['detail_size']];
        ?>
    </td>
        <?php } ?>
        <td align='center'><?= $pilih4['jumlah_size'] ?></td>
        <td align="center"><?= $pilih4['nw'] ?></td>
        
    </tr>

    <?php
       
        $qty_total += $pilih4['jumlah_size'];
        $qty_total_semua += $pilih4['jumlah_size'];
        $jmlh_karton = $no;
        $total_nw += $pilih4['nw'];
        $gw_mix = $total_nw+1;
        
        $total_semua_nw += $pilih4['nw'];
        
    }
    $total_semua_gw += $gw_mix;
     ?>
    <tr>
        <td colspan="5" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
        <?php 
            $ListSize2 = tampilkan_size_transaksi_shipment_orc_invoice_mixstyle2($id_shipment, $no_trx2); 
            while($size2 = mysqli_fetch_array($ListSize2)){ ?>
        <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= ${$size2['total_size']} ?></td>
        <?php } ?>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $total_nw ?></td>
        
    </tr> 
    
        <tr>
            <td colspan="<?php $total_size = cek_jumlah_size_notrx_invoice_mixstyle2($id_shipment, $no_trx2) + 6; echo $total_size;  ?>">
                TOTAL QUANTITY : <?= $qty_total ?> PCS
            </td>
            <td align="center" style="background-color:#20B2AA; color: #ffffff; ">
               GW
            </td>
        </tr>
        <tr>
            <td colspan="<?php $total_size = cek_jumlah_size_notrx_invoice_mixstyle2($id_shipment, $no_trx2) + 6; echo $total_size;  ?>">
                TOTAL CARTON : <?= $jmlh_karton ?> CTN
            </td>
            <td align="center">
               <?= $gw_mix ?>
            </td>
        </tr>
<?php 
$total_nw = 0;
$gw_mix = 0;
 $tot_jmlh_karton2 += $no2;
$qty_total=0;
$jmlh_karton=0;


$ListSize2 = tampilkan_size_transaksi_shipment_orc_invoice_mixstyle2($id_shipment, $no_trx2); 
  while($size2 = mysqli_fetch_array($ListSize2)){
    ${$size2['total_size']} = 0;
  }   ?>
</tbody>
</table>
<br>
<?php
        
    } // UTK PENUTUP HEADER 
}
?>

<br>
<center> 
    <!-- <div> -->
<b><u>TOTAL SHIPMENT SEMUANYA : </u></b> <br> </center>
  JUMLAH BARANG DALAM PCS :<?= $qty_total_semua; ?> PCS 
  </br>
  JUMLAH KARTON : <?php 
  $total_semua = $tot_jmlh_karton1 + $tot_jmlh_karton2;
  echo $total_semua; ?> Karton
  </br>
  TOTAL NETT WEIGHT : <?= $total_semua_nw ?> KG
  <br>
  TOTAL GROSS WEIGHT : <?= $total_semua_gw ?> KG
  <br>
  <!-- TOTAL NETT WEIGHT MIX : <?= $total_semua_nw_mix ?> KG
  <br>
  TOTAL GROSS WEIGHT MIX : <?= $total_semua_gw_mix ?> KG -->
  <!-- </div> -->


    
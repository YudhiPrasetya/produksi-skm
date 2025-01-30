<?php require_once 'core/init.php';

?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan Balance Order</title>
<link rel="icon" href="img/skm_icon.png">
    <center><h1>PT. Globalindo Intimates</h1>
    <h3>LAPORAN SCAN BARCODE BUYER</h3>
    <?php if(isset($_POST['costomer'])){ ?>
    <h4>ORC : <?= $_POST['costomer']; ?></h4>    
    <?php } 
    if(isset($_POST['style'])){ ?>
    <h4>STYLE : <?= $_POST['style']; ?></h4>    
    <?php } 
    if(isset($_POST['orc'])){ ?>
        <h4>COSTOMER : <?= $_POST['orc']; ?></h4>  
    <?php }
    if(isset($_POST['no_po'])){ ?>
        <h4>PO BUYER : <?= $_POST['no_po']; ?></h4>  
    <?php } ?>
    <h4>PERIODE S/D <?= tanggal_indo2($_POST['tanggal2']); ?></h4>
</center>
<?php

$qty_master_order = 0; 
$qty_master_order_all = 0;
// $qty_total_wip_qc_kensa = 0;
// $qty_total_wip_qc_kensa_all = 0;
// $qty_total_wip_tatami = 0;
// $qty_total_wip_tatami_all = 0;
$qty_total_kenzin = 0; 
$qty_total_kenzin_all = 0; 
$qty_total_wip_kenzin = 0;
$qty_total_wip_kenzin_all = 0;
$qty_total_balance_kenzin = 0; 
$qty_total_balance_kenzin_all = 0; 
$qty_total_packing = 0; 
$qty_total_packing_all = 0; 
$qty_total_wip_packing = 0; 
$qty_total_wip_packing_all = 0;
$qty_total_balance_packing = 0; 
$qty_total_balance_packing_all = 0; 
$qty_total_balance_shipment_all = 0;
$qty_total_shipment = 0;
$qty_total_shipment_all = 0;
$qty_total_balance_shipment = 0;
$qty_total_balance_shipment_all = 0;
$tanggal = $_POST['tanggal2'];
// $qty_balance_order = 0;
$ctk =array();
  if(isset($_POST['costomer'])){
  $laporan = tampilkan_balance_order_barcode_buyer_per_costomer2($_POST['costomer'], $tanggal);
  } 
  if(isset($_POST['orc'])){
    $laporan = tampilkan_balance_order_barcode_buyer_per_orc2($_POST['orc'], $tanggal);
  } 
  if(isset($_POST['style'])){

    $laporan = tampilkan_balance_order_barcode_buyer_per_style2($_POST['id_style'], $tanggal, $_POST['filter_po'], $_POST['filter_color']);
  } 
  if(isset($_POST['no_po'])){
    $laporan = tampilkan_balance_order_barcode_buyer_per_po2($_POST['no_po'], $tanggal);
  } 
  while($pilih = mysqli_fetch_array($laporan)){
    $ctk[$pilih['costomer']][$pilih['orc']][$pilih['no_po']][$pilih['label']][$pilih['style']][$pilih['color']][]=array(
      'orc'=>$pilih['orc'],
      'label'=>$pilih['label'],
      'kode_barcode'=>$pilih['kode_barcode'],
      'style'=>$pilih['style'],
      'color'=>$pilih['color'],
      'warna'=>$pilih['warna'],
      'size'=>$pilih['size'],
      'cup'=>$pilih['cup'],
      'qty_order'=>$pilih['qty_order'],
    //   'wip_tatami'=>$pilih['wip_tatami'],
      'total_kenzin'=>$pilih['total_kenzin'],
      'wip_kenzin'=>$pilih['wip_kenzin'],
      'balance_kenzin'=>$pilih['balance_kenzin'],
      'total_packing'=>$pilih['total_packing'],
      'wip_packing'=>$pilih['wip_packing'],
      'balance_packing'=>$pilih['balance_packing'],
      'qty_shipment'=>$pilih['qty_shipment'],
      'balance_shipment'=>$pilih['balance_shipment'],
  );      

} 


 foreach($ctk as $costomer=>$kdorc)
 foreach($kdorc as $orc=>$no_po)
 foreach($no_po as $po=>$kdlabel)
 foreach($kdlabel as $label=>$kdstyle)
 foreach($kdstyle as $style=>$color)
 foreach($color as $warna=>$data){
     ?>
<br><br>
<table class='hlap' width='100%'>
<tr>
    <td width='5%'>ORC</td><td width='1%'>:</td><td width='15%' align='left'><?= $orc ?></td>
    <td width='50%'></td>
    <td width='10%'>NO PO</td><td width='1%'>:</td><td width='15%' align='left'><?= $po ?></td>
  </tr>      
  <tr>
    <td width='5%'>Style</td><td width='1%'>:</td><td width='15%' align='left'><?= $style ?></td>
    <td width='50%'></td>
    <td width='10%'>Label</td><td width='1%'>:</td><td width='15%' align='left'><?= $label ?> </td>
  </tr>
  <tr>
    <td width='12%'>Color</td><td width='1%'>:</td><td width='6%'><?= $warna ?></td>
    <td width='50%'></td>
    <td width='10%'>Costomer</td><td width='1%'>:</td><td width='15%' align='left'><?= $costomer ?> </td>
  </tr>
  <tr>
    <td width='12%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='6%'></td>
    <td width='50%'></td>
  </tr>
</table>
<center>
<table  border='1' class='table table-hover' width=100% cellpadding=6 >
<thead>
	<tr>
        <th style="background-color:#f4f4f4; " rowspan="2" ><center>NO</center></th>
        <th style="background-color:#f4f4f4; " rowspan="2"><center>Kode Barcode</center></th>
        <th style="background-color:#f4f4f4; " rowspan="2"><center>STYLE</center></th>
        <th style="background-color:#f4f4f4; " rowspan="2" ><center>COLOR</center></th>
        <th style="background-color:#f4f4f4; " rowspan="2"><center>SIZE</center></th>
        <th style="background-color:#f4f4f4; " rowspan="2"><center>ORDER</center></th>
        <!-- <th style="background-color:#f4f4f4; " colspan="1" ><center>QC KENSA</center></th>
        <th style="background-color:#f4f4f4; " colspan="1" ><center>TATAMI</center></th> -->
        <th style="background-color:#f4f4f4; " colspan="3" ><center>KENZIN</center></th>
        <th style="background-color:#f4f4f4; " colspan="3" ><center>PACKING CTN</center></th>
        <th style="background-color:#f4f4f4; " colspan="2" ><center>SHIPMENT</center></th>
  	</tr>
    <tr>
        <!-- <th style="background-color:#f4f4f4; "><center>WIP</center></th> -->
        <th style="background-color:#f4f4f4; "><center>TOTAL</center></th>
        <th style="background-color:#f4f4f4; "><center>BAL</center></th>
        <th style="background-color: yellow; "><center>STOK</center></th>
        <th style="background-color:#f4f4f4; "><center>TOTAL</center></th>
        <th style="background-color:#f4f4f4; "><center>BAL</center></th>
        <th style="background-color: yellow; "><center>STOK</center></th>
        <th style="background-color:#f4f4f4; "><center>KIRIM</center></th>
        <th style="background-color:#f4f4f4; "><center>BAL</center></th>
    </tr>
</thead>
<tbody>
  <?php
        $no=0;
        foreach($data as $pilih){
        $no++;
    
  ?>
    <tr>
    <td align='center'><?php echo $no; ?> </td>
    <td align='center'><?php echo $pilih['kode_barcode'] ?></td>
    <td align='center'><?php echo $pilih['style'] ?></td>
    <td align='center'><?php echo $pilih['warna'] ?></td>
    <td align='center'><?php echo $pilih['size'].$pilih['cup']; ?></td>
    <td align='center'>
      <?php echo $pilih['qty_order']; ?>
    </td>
     <!-- <td align='center'>
      <?php echo $pilih['wip_qc_kensa']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['wip_tatami']; ?>
    </td> -->
    <td align='center'>
      <?php echo $pilih['total_kenzin']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['balance_kenzin']; ?>
    </td>
    <td style="background-color: yellow;" align='center'>
      <?php echo $pilih['wip_kenzin']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['total_packing']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['balance_packing']; ?>
    </td>
    <td align='center' style="background-color: yellow;">
      <?php echo $pilih['wip_packing']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['qty_shipment']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['balance_shipment']; ?>
    </td>
	</tr>
 <?php
 $qty_master_order += $pilih['qty_order'];
 $qty_master_order_all += $pilih['qty_order'];
//  $qty_total_wip_qc_kensa += $pilih['wip_qc_kensa'];
//  $qty_total_wip_qc_kensa_all += $pilih['wip_qc_kensa'];
//  $qty_total_wip_tatami += $pilih['wip_tatami'];
//  $qty_total_wip_tatami_all += $pilih['wip_tatami'];
 $qty_total_kenzin += $pilih['total_kenzin'];
 $qty_total_kenzin_all += $pilih['total_kenzin'];
 $qty_total_wip_kenzin += $pilih['wip_kenzin'];
 $qty_total_wip_kenzin_all += $pilih['wip_kenzin'];
 $qty_total_balance_kenzin += $pilih['balance_kenzin'];
 $qty_total_balance_kenzin_all += $pilih['balance_kenzin'];
 $qty_total_packing += $pilih['total_packing'];
 $qty_total_packing_all += $pilih['total_packing'];
 $qty_total_wip_packing += $pilih['wip_packing'];
 $qty_total_wip_packing_all += $pilih['wip_packing'];
 $qty_total_balance_packing += $pilih['balance_packing'];
 $qty_total_balance_packing_all += $pilih['balance_packing'];
 $qty_total_shipment += $pilih['qty_shipment'];
 $qty_total_shipment_all += $pilih['qty_shipment'];
 $qty_total_balance_shipment += $pilih['balance_shipment'];
 $qty_total_balance_shipment_all += $pilih['balance_shipment'];
}

?>
<tr>
         <td style='background-color:#f4f4f4;' colspan='5' >Total Semua QTY :</td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_master_order ?></td>
         <!-- <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_wip_qc_kensa ?></td> -->
         <!-- <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_wip_tatami ?></td>  -->
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_kenzin ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_balance_kenzin ?></td>
         <td style='background-color: yellow;' align='center'><?= $qty_total_wip_kenzin ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_packing ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_balance_packing ?></td>
         <td style='background-color:yellow;' align='center'><?= $qty_total_wip_packing ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_shipment ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_balance_shipment ?></td>
  </tr>
</tbody>
</table>
<br><center>
       <hr width="100%" />
       </center>
<?php
$qty_master_order = 0;
// $qty_total_wip_qc_kensa = 0;
// $qty_total_wip_tatami = 0;
$qty_total_kenzin = 0;
$qty_total_wip_kenzin = 0;
$qty_total_balance_kenzin = 0;
$qty_total_packing = 0;
$qty_total_wip_packing = 0;
$qty_total_balance_packing = 0;
$qty_total_shipment = 0;
$qty_total_balance_shipment = 0;
}

	?>
</center>
<br><br>

<div style="background-color: lightblue; padding: 10px;">

</div>

</body>

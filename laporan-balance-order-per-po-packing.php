<?php require_once 'core/init.php';

?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan Balance Order</title>
<?php
$po = $_POST['po'];
?>

    <center><h1>PT. FGX INDONESIA</h1>
    <h3>LAPORAN BALANCE ORDER DI KENZIN</h3>
    <b>No Order : <?= $po ?> <br>

</center>
<?php
$qty_master_order = 0;
$qty_total_p = 0;
$qty_total_s = 0;
$qty_total_bal = 0;
$ctk =array();
  $laporan = tampilkan_balance_order_popacking($po);
  while($pilih = mysqli_fetch_array($laporan)){
    $ctk[$pilih['no_po']][$pilih['label']][$pilih['style']][$pilih['description']][$pilih['color']][]=array(
      'label'=>$pilih['label'],
      'kode_barcode'=>$pilih['kode_barcode'],
      'style'=>$pilih['style'],
      'color'=>$pilih['color'],
      'size'=>$pilih['size'],
      'qty_order'=>$pilih['qty_order'],
      'qtyp'=>$pilih['qtyp'],
      'qtys'=>$pilih['qtys'],
      'kekurangan_shipment'=>$pilih['kekurangan_shipment']
  );      

} 


foreach($ctk as $no_po=>$kodelabel)
 foreach($kodelabel as $label=>$kdstyle)
 foreach($kdstyle as $style=>$desc)
 foreach($desc as $description=>$color)
 foreach($color as $warna=>$data){ 
   ?>
<br><br>
<table class='hlap' width='100%'>
<tr>
    <td width='5%'>No Order</td><td width='1%'>:</td><td width='15%' align='left'><?= $no_po ?></td>
    <td width='50%'></td>
    <td width='10%'>Kode Produksi</td><td width='1%'>:</td><td width='15%' align='left'><?= $label ?></td>
  </tr>      
  <tr>
    <td width='5%'>Style</td><td width='1%'>:</td><td width='15%' align='left'><?= $style.' ( '. $warna ?> )</td>
    <td width='50%'></td>
    <td width='10%'>Description</td><td width='1%'>:</td><td width='15%' align='left'><?= $description ?> </td>
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
        <th style="background-color:#f4f4f4; "><center>NO</center></th>
        <th style="background-color:#f4f4f4; "><center>Label</center></th>
        <th style="background-color:#f4f4f4; "><center>Kode Barcode</center></th>
        <th style="background-color:#f4f4f4; "><center>STYLE</center></th>
        <th style="background-color:#f4f4f4; "><center>COLOR</center></th>
        <th style="background-color:#f4f4f4; "><center>SIZE</center></th>
        <th style="background-color:#f4f4f4; "><center>QTY ORDER</center></th>
        <th style="background-color:#f4f4f4; "><center>Di PACKING</center></th>
        <th style="background-color:#f4f4f4; "><center>Di SHIPMENT</center></th>
        <th style="background-color:#f4f4f4; "><center>Balance</center></th>
  	</tr>
</thead>
<tbody>
  <?php
        $no=0;
        foreach($data as $pilih){
        $no++;
    
  ?>

  <?php if($pilih['kekurangan_shipment'] > 0 ){ ?>
	  <tr style="background-color: yellow">
  <?php }else{ ?>
    <tr>
  <?php } ?>
    <td align='center'><?php echo $no; ?> </td>
    <td align='center'><?php echo $pilih['label'] ?></td>
    <td align='center'><?php echo $pilih['kode_barcode'] ?></td>
    <td align='center'><?php echo $pilih['style'] ?></td>
    <td align='center'><?php echo $pilih['color'] ?></td>
    <td align='center'><?php echo $pilih['size']; ?></td>
    <td align='center'>
      <?php echo $pilih['qty_order']; ?>
    </td>
    <td align='center'>
        <?php echo $pilih['qtyp']; ?>
    </td>
    <td align='center'>
        <?php echo $pilih['qtys']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['kekurangan_shipment']; ?>
    </td>
	</tr>
 <?php
 $qty_master_order += $pilih['qty_order'];
 $qty_total_p += $pilih['qtyp'];
 $qty_total_s += $pilih['qtys'];
 $qty_total_bal += $pilih['kekurangan_shipment'];
    // $no++;
}

?>
<tr>
         <td style='background-color:#f4f4f4;' colspan='6' >Total Semua QTY :</td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_master_order ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_p ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_s ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_bal ?></td>
  </tr>
</tbody>
</table>
<br><center>
       <hr width="100%" />
       </center>
<?php
$qty_master_order = 0;
$qty_total_p = 0;
$qty_total_s = 0;
$qty_total_bal = 0;
}

	?>
</center>
<br><br>

</body>

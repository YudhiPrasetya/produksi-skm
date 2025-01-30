<?php require_once 'core/init.php';

?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan Balance Order</title>
<?php
$orc = $_POST['orc'];
?>

    <center><h1>PT. Globalindo Intimates</h1>
    <h3>LAPORAN SCAN BARCODE TATAMI</h3>
    
</center>
<?php
$qty_master_order = 0;
$qty_total_tatami_in = 0;
$qty_total_tatami_out = 0;
$qty_total_outstanding = 0;
$qty_balance_order = 0;
$ctk =array();
  $laporan = tampilkan_balance_order_tatami_in_orc($orc);
  while($pilih = mysqli_fetch_array($laporan)){
    $ctk[$pilih['orc']][$pilih['no_po']][$pilih['label']][$pilih['style']][$pilih['color']][]=array(
      'orc'=>$pilih['orc'],
      'label'=>$pilih['label'],
      'style'=>$pilih['style'],
      'color'=>$pilih['color'],
      'size'=>$pilih['size'],
      'barcode_number'=>$pilih['barcode_number'],
      'qty_order'=>$pilih['qty_order'],
      'qty_tatami_in'=>$pilih['qty_tatami_in'],
      'qty_tatami_out'=>$pilih['qty_tatami_out'],
      'outstanding'=>$pilih['outstanding'],
      'balance_order'=>$pilih['balance_order']
  );      

} 


foreach($ctk as $orc=>$no_po)
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
        <!-- <th style="background-color:#f4f4f4; "><center>Kode Barcode</center></th> -->
        <th style="background-color:#f4f4f4; "><center>STYLE</center></th>
        <th style="background-color:#f4f4f4; "><center>COLOR</center></th>
        <th style="background-color:#f4f4f4; "><center>SIZE</center></th>
        <th style="background-color:#f4f4f4; "><center>QTY ORDER</center></th>
        <th style="background-color:#f4f4f4; "><center>IN</center></th>
        <th style="background-color:#f4f4f4; "><center>OUT</center></th>
        <th style="background-color:#f4f4f4; "><center>OUTSTANDING</center></th>
        <th style="background-color:#f4f4f4; "><center>BALANCE</center></th>
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
    <!-- <td align='center'><?php echo $pilih['barcode_number'] ?></td> -->
    <td align='center'><?php echo $pilih['style'] ?></td>
    <td align='center'><?php echo $pilih['color'] ?></td>
    <td align='center'><?php echo $pilih['size']; ?></td>
    <td align='center'>
      <?php echo $pilih['qty_order']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['qty_tatami_in']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['qty_tatami_out']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['outstanding']; ?>
    </td>
    <td align='center'>
      <?php echo $pilih['balance_order']; ?>
    </td>
	</tr>
 <?php
 $qty_master_order += $pilih['qty_order'];
 $qty_total_tatami_in += $pilih['qty_tatami_in'];
 $qty_total_tatami_out += $pilih['qty_tatami_out'];
 $qty_total_outstanding += $pilih['outstanding'];
 $qty_balance_order += $pilih['balance_order'];
    // $no++;
}

?>
<tr>
         <td style='background-color:#f4f4f4;' colspan='4' >Total Semua QTY :</td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_master_order ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_tatami_in ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_tatami_out ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_outstanding ?></td>
         <td style='background-color:#f4f4f4;' align='center'><?= $qty_balance_order ?></td>
  </tr>
</tbody>
</table>
<br><center>
       <hr width="100%" />
       </center>
<?php
$qty_master_order = 0;
$qty_total_tatami_in = 0;
$qty_total_tatami_out;
$qty_total_outstanding;
$qty_balance_order = 0;
}

	?>
</center>
<br><br>

</body>

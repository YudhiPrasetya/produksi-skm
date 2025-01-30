<?php 
  require_once 'core/init.php';    
  $tgl = $_GET['tgl'];
  $trx = $_GET['trx'];
  $orc = $_GET['orc'];
  $style = $_GET['style'];
  $costomer = $_GET['costomer'];
  $no_po = $_GET['no_po'];
  $category = $_GET['category'];
  $line = $_GET['line'];

  $temp1 = mencari_data_master_transaksi($trx);
  $datatransaksi = mysqli_fetch_array($temp1);
  $table = $datatransaksi['table_transaksi'];
 
?>
<!-- <body onLoad="window.print()"> -->
<title>REPORT DAILY PRODUCTION OUTPUT</title>
<center>
<h1>PT. Globalindo Intimates</h1>
<h3>LAPORAN DAILY PRODUCTION SCAN <?= strtoupper(str_replace("_", " ", $trx)); ?></h3>
<?= tgl_indonesia5($tgl) ?>
</center>

<br>
<br>

<?php 
$qty_total_a = 0;
$qty_total_semua = 0;
  $ctk =array(); 
  $laporan = tampilkan_laporan_daily_production_scan_line($tgl, $table, $orc, $style, $costomer, $no_po, $category, $line);
    while($pilih = mysqli_fetch_array($laporan)){
      $ctk[$pilih['line']][]=array(
        'orc'=>$pilih['orc'],
        'no_po'=>$pilih['no_po'],
        'costomer'=>$pilih['costomer'],
        'size'=>$pilih['size'],
        'cup'=>$pilih['cup'],
        'color'=>$pilih['color'],
        'style'=>$pilih['style'],
        'total_output'=>$pilih['total_output'],
        'daily'=>$pilih['daily'],
        'total_order'=>$pilih['total_order']
      );                                                    
    } 

    foreach($ctk as $line=>$data){
 ?>
</center>
LINE : <?= strtoupper($line) ?> </div>
<center>
<table  border='1' class='table table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style="background-color:#f4f4f4;" rowspan=2><center>NO</center></th>
      <th style="background-color:#f4f4f4;" rowspan=2><center>COSTOMER</center></th>
      <th style="background-color:#f4f4f4;" rowspan=2><center>PO BUYER</center></th>
 
      <th style="background-color:#f4f4f4;" rowspan=2><center>ORC</center></th>
      <th style="background-color:#f4f4f4;" rowspan=2><center>STYLE</center></th>
      <th style="background-color:#f4f4f4;" rowspan=2><center>COLOR</center></th>
      <th style="background-color:#f4f4f4;" rowspan=2><center>SIZE</center></th>
      <th style="background-color:#f4f4f4;" colspan=3><center>QTY</center></th>
    </tr>
    <tr>
      <th style="background-color:#f4f4f4; "><center>ORDER</center></th>
      <th style="background-color:#f4f4f4; "><center>TOTAL</center></th>
      <th style="background-color:#f4f4f4; "><center>DAILY</center></th>
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
      <td align='center'><?php echo $pilih['costomer'] ?></td>
      <td align='center'><?php echo $pilih['no_po'] ?></td>
      <td align='center'><?php echo $pilih['orc'] ?></td>
      <td align='center'><?php echo $pilih['style'] ?></td>
      <td align='center'><?php echo $pilih['color'] ?></td>
      <td align='center'><?php echo $pilih['size'].$pilih['cup'] ?></td>
      <td align='center'><?php echo $pilih['total_order']; ?></td>
      <td align='center'><?php echo $pilih['total_output']; ?></td>
      <td align='center'><?php echo $pilih['daily']; ?></td>
    </tr>
      <?php
        $qty_total_a += $pilih['daily'];
        $qty_total_semua += $pilih['daily'];
      }
       ?>
    <tr>
      <td style='background-color:#f4f4f4;' colspan='9' >Total Semua QTY :</td>
      <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_a ?></td>
      
    </tr>
  </tbody>
</table>
<br>
<br>
    <?php   
       $qty_total_a=0; 
      }
    ?>
</center>
<br>
<div style="background-color: lightblue; padding: 10px;">
<b>TOTAL SCAN <?= strtoupper(str_replace("_", " ", $trx)); ?> : <?= $qty_total_semua ?> PCS </b>
</div>
<br>
<table width="100%">
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center"><?= tgl_indonesia5($tgl) ?></td>
</tr>
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center">CHECKED BY</td>
</tr>
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center"><?= strtoupper(str_replace("_", " ", $trx)); ?></td>
</tr>
</table>
</body>

<?php 
  require_once 'core/init.php';    
  
  $invoice = $_GET['id'];
  $data_ship = tampilkan_master_shipment_id($invoice);
  $pilih4 = mysqli_fetch_array($data_ship);

?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan SHIPMENT</title>
<center>
<h1>PT. Globalindo Intimates</h1>
<h3>LAPORAN HASIL SHIPMENT</h3>
Invoice : <?=  $pilih4['no_invoice'] ?> 
<br>
Tanggal Shipment : <?= tanggal_indo2($pilih4['inspection'], false); ?>
<br>
Costomer : <?= $pilih4['costomer'] ?>
<!-- Periode Tanggal : <?= tanggal_indo2($tglawal, false) ?> s/d <?= tanggal_indo2($tglakhir, false) ?> -->
</center>

<br>
<br>

<?php 
$qty_total_a = 0;
$qty_total_semua = 0;
  $ctk =array(); 
  $laporan = tampilkan_laporan_hasil_shipment_awal($invoice);
    while($pilih = mysqli_fetch_array($laporan)){
      $ctk[$pilih['no_po']][]=array(
        'orc'=>$pilih['orc'],
        'no_po'=>$pilih['no_po'],
        'size'=>$pilih['size'],
        'warna'=>$pilih['color'],
        'label'=>$pilih['label'],
        'style'=>$pilih['style'],
        'kode_barcode'=>$pilih['kode_barcode'],
        'qtya'=>$pilih['qtya']
      );                                                    
    } 

    foreach($ctk as $po=>$data){
 ?>

<table width = 100%>
  <tr style="font-weight:bold">
    
    <td width=5%>NO PO</td> <td>:</td> <td width=8%><?= $po ?></td>
    <td width=65%></td>
    <td width=5%></td> <td></td> <td width=13%></td></strong>
  </tr>
</table>

<center>
<table  border='1' class='table table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style="background-color:#f4f4f4; "><center>NO</center></th>
      <th style="background-color:#f4f4f4; "><center>ORC</center></th>
      <!-- <th style="background-color:#f4f4f4; "><center>NO PO</center></th> -->
      <th style="background-color:#f4f4f4; "><center>LABEL</center></th>
      <!-- <th style="background-color:#f4f4f4; "><center>KODE BARCODE</center></th> -->
      <th style="background-color:#f4f4f4; "><center>STYLE</center></th>
      <th style="background-color:#f4f4f4; "><center>COLOR</center></th>
      <th style="background-color:#f4f4f4; "><center>SIZE</center></th>
      <th style="background-color:#f4f4f4; "><center>SCAN</center></th>
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
      <td align='center'><?php echo $pilih['orc'] ?></td>
      <!-- <td align='center'><?php echo $pilih['no_po'] ?></td> -->
      <td align='center'><?php echo $pilih['label'] ?></td>
      <!-- <td align='center'><?php echo $pilih['kode_barcode'] ?></td> -->
      <td align='center'><?php echo $pilih['style'] ?></td>
      <td align='center'><?php echo $pilih['warna'] ?></td>
      <td align='center'><?php echo $pilih['size'] ?></td>
      <td align='center'><?php echo $pilih['qtya']; ?></td>
    </tr>
      <?php
        $qty_total_a += $pilih['qtya'];
        $qty_total_semua += $pilih['qtya'];
      }
       ?>
    <tr>
      <td style='background-color:#f4f4f4;' colspan='6' >Total Semua QTY :</td>
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
<b>Total QTY Invoice : <?= $qty_total_semua ?> PCS </b>
</div>
<br>
<table width="100%">
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center">Checked By</td>
</tr>
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center">PACKING</td>
</tr>
</table>
</body>

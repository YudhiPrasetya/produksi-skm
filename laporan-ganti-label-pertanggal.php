<?php 
  require_once 'core/init.php';    
  $tgl = $_POST['tgl'];
?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan Adjuzt Stok</title>
<center>
<h1>PT. GLOBALINDO INTIMATES</h1>
<h3>LAPORAN GANTI LABEL HARIAN</h3>
<?= tanggal_indo($tgl,true) ?>
</center>

<br>
<br>

<center>
<table  border='1' class='table table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style="background-color:#f4f4f4; "><center>NO</center></th>
      <th style="background-color:#f4f4f4; "><center>Dari Label</center></th>
      <th style="background-color:#f4f4f4; "><center>Kode Barcode</center></th>
      <th style="background-color:#f4f4f4; "><center>STYLE</center></th>
      <th style="background-color:#f4f4f4; "><center>Color</center></th>
      <th style="background-color:#f4f4f4; "><center>Size</center></th>
      <th style="background-color:#f4f4f4; "><center>Jumlah</center></th>
      <th style="background-color:#f4f4f4; "><center>Keterangan</center></th>
      
    </tr>
  </thead>
  <tbody>
    <?php
      $qty_total_a = 0;
      $no=1;
      $subtotal_qty=0;
      $laporan = tampilkan_laporan_ganti_label($tgl);
      while($pilih = mysqli_fetch_array($laporan)){
    ?>
    <tr>
      <td align='center'><?php echo $no; ?> </td>
      <td align='center'><?php echo $pilih['no_po'] ?></td>
      <td align='center'><?php echo $pilih['label'] ?></td>
      <td align='center'><?php echo $pilih['kode_barcode'] ?></td>
      <td align='center'><?php echo $pilih['style'] ?></td>
      <td align='center'><?php echo $pilih['warna']; ?></td>
      <td align='center'><?php echo $pilih['size']; ?></td>
      <td align='center'><?php echo $pilih['qtya']; ?></td>
    </tr>
      <?php
        $qty_total_a += $pilih['qtya'];
        $no++;
        }
       ?>
    <tr>
      <td style='background-color:#f4f4f4;' colspan='7' >Total Semua QTY :</td>
      <td style='background-color:#f4f4f4;' align='center'><?= $qty_total_a ?></td>
      
    </tr>
  </tbody>
</table>
</center>

<br>
<br>
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

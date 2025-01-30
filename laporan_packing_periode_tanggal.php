<?php require_once 'core/init.php'; ?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan PACKING LIST</title>
<style>
hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    border-style: inset;
    border-width: 1px;
    border-color:blue;
    }
</style>

<?php
  $tgl_awal=$_POST['tgl_awal'];
  $tgl_akhir=$_POST['tgl_akhir'];
?>

<center><h1>PT. FGX INDONESIA</h1>
<h3>LAPORAN SCAN PACKING</h3>
<h4><?= tanggal_indo($tgl_awal, false); ?> s/d <?= tanggal_indo($tgl_akhir, false); ?></h4>
</center>
<br>

<?php
  $qty_total=0;
  $qty_total_semua=0;
  $karton=0;
  $no_karton2=0;
  $ctk =array();
    $laporan = tampilkan_laporan_packing_periode_tanggal($tgl_awal, $tgl_akhir);
    while($pilih = mysqli_fetch_array($laporan)){
      $ctk[$pilih['tanggal']][$pilih['no_karton']][$pilih['kelompok']][]=array(
        'orc'=>$pilih['orc'],
        'no_po'=>$pilih['no_po'],
        'label'=>$pilih['label'],
        'kode_barcode'=>$pilih['kode_barcode'],
        'style'=>$pilih['style'],
        'label'=>$pilih['label'],
        'warna'=>$pilih['warna'],
        'size'=>$pilih['size'],
        'jumlah_size'=>$pilih['jumlah_size'],
        'karton'=>$pilih['karton'],
        'jam'=>$pilih['jam']
      );
    }

  foreach($ctk as $tgl=>$no_kartons)
  foreach($no_kartons as $no_karton=>$kelompokkarton)
  foreach($kelompokkarton as $kelompok=>$data) {
    $no_karton2++;
    $tanggal_indo=tanggal_indo($tgl, true);
?>

<table class='hlap' width='100%'>
  <tr>
    <td width='19%'>Tanggal Scan</td><td width='1%'>:</td><td width='15%' align='left'><?= $tanggal_indo ?></td>
    <td width='50%'></td>
    <td width='19%' align='left'></td><td width='1%'> </td> </td>
  </tr>
  <tr>
    <td width='19%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='6%'>
    <?php 
      if($kelompok == 'full'){
        echo "Full Isi Karton";
      }elseif($kelompok == 'ecer'){
        echo "Isi Tidak Full Karton";
      }elseif($kelompok == 'mix'){
        echo "Mix Size";
      }elseif($kelompok == 'mix_style'){
        echo "Mix Color / Mix Style ";
      }
    ?> 
    
      </td>
    <td width='50%'></td>
    <td align='right' width='15%'>NO Urut TRX </td><td width='1%'>:</td><td width='6%'><?= $no_karton ?></td>
  </tr>
</table>

<table  border='1' class='table table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style='background-color:#f4f4f4; '><center>Jam SCAN</center></th>
      <th style='background-color:#f4f4f4; '><center>No PO</center></th>
      <th style='background-color:#f4f4f4; '><center>Label</center></th>
      <th style='background-color:#f4f4f4; '><center>Kode Barcode</center></th>
      <th style='background-color:#f4f4f4; '><center>STYLE</center></th>
      <th style='background-color:#f4f4f4; '><center>Color</center></th>
      <th style='background-color:#f4f4f4; '><center>Size</center></th>
      <th style='background-color:#f4f4f4; '><center>QTY</center></th>
    </tr>
  </thead>
<tbody>
  <?php
    foreach($data as $pilih) {
      $barcode = strtoupper($pilih['kode_barcode']);
  ?>
  <tr>
    <td align='center'><?= $pilih['jam'] ?></td>
    <td align='center'><?= $pilih['no_po'] ?></td>
    <td align='center'><?= $pilih['label'] ?></td>
    <td align='center'><?= $barcode ?></td>
    <td align='center'><?= $pilih['style'] ?></td>
    <td align='center'><?= $pilih['warna'] ?></td>
    <td align='center'><?= $pilih['size'] ?></td>
    <td align='center'><?= $pilih['jumlah_size'] ?></td>
  </tr>
    <?php          
      $qty_total += $pilih['jumlah_size'];
      $qty_total_semua += $pilih['jumlah_size'];      
      }
    ?>
  <tr>
    <td style='background-color:#f4f4f4;' colspan='7' >Total QTY :</td>
    <td style='background-color:#f4f4f4;' align='center'><?= $qty_total ?></td></tr>
  </tbody>
</table>
<br><br>
<center>
<hr width="100%" />
</center>
<br><br>
<?php  
  $qty_total=0;
  }
?>
</center>
TOTAL SCAN SEMUANYA : <br>
Jumlah Barang dalam PCS :<?php echo $qty_total_semua; ?> PCS 
</br>
Jumlah Karton : <?php echo $no_karton2; ?> Karton

<br>
<br>
<br>

<table width="100%">
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center">Checked</td>
</tr>
<tr>
  <td width="20%" align="center"></td>
  <td width="60%"></td>
  <td width="20%" align="center">Packing</td>
</tr>
</table>
</body>
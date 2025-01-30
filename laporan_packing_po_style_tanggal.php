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

  tr.belang:nth-child(even) {
    background-color: #ccccc;  
  }
</style>

<?php
  $po=$_POST['no_po'];
  $style=$_POST['style'];
  $tgl_awal=$_POST['tgl_awal'];
  $tgl_akhir=$_POST['tgl_akhir'];
  $style = substr($style,0,3);
  $laporan2 = tampilkan_laporan_packinglist_perstyle_lengkap_tanggal($po, $style, $tgl_awal, $tgl_akhir);
  $data = mysqli_fetch_assoc($laporan2)
?>
<center><h1>PT. GLOBALINDO INTIMATES</h1>
<h3>LAPORAN PACKING LIST</h3>
<h4>Nomer Purchasing Order : <?= $data['no_po']; ?> - STYLE : <?= $style; ?></h4>
<h3>Periode : <?= tanggal_indo($tgl_awal, false) ?> s/d <?= tanggal_indo($tgl_akhir, false)  ?>
</center>
<br>

</center>
<?php
  $total_ss =0;
  $total_s =0;
  $total_m =0;
  $total_l =0;
  $total_ll =0;
  $total_3l =0;
  $total_4l =0;
  $total_5l =0;
  $total_6l =0;
  $total_7l =0;
  $subtotal =0;
  $qty_total=0;
  $qty_total_semua=0;
  $no_karton2=0;
  $no_karton3=0;
  $ctk =array();
  $laporan = tampilkan_laporan_packinglist_perstyle_lengkap_tanggal($po, $style, $tgl_awal, $tgl_akhir);
  while($pilih = mysqli_fetch_array($laporan)){
    $ctk[$pilih['no_po']][$pilih['label']][$pilih['style']][$pilih['warna']][]=array(
      'tanggal'=>$pilih['tanggal'],
      'style'=>$pilih['style'],
      'warna'=>$pilih['warna'],
      'jumlah_size'=>$pilih['jumlah_size'],
      'jam'=>$pilih['jam'],
      'no_karton'=>$pilih['no_karton'],
      'size_ss'=>$pilih['size_ss'],
      'size_s'=>$pilih['size_s'],
      'size_m'=>$pilih['size_m'],
      'size_l'=>$pilih['size_l'],
      'size_ll'=>$pilih['size_ll'],
      'size_3l'=>$pilih['size_3l'],
      'size_4l'=>$pilih['size_4l'],
      'size_5l'=>$pilih['size_5l'],
      'size_6l'=>$pilih['size_6l'],
      'size_7l'=>$pilih['size_7l']
    );                                                  
  }

  foreach($ctk as $no_po=>$kodelabel)
    foreach($kodelabel as $label=>$kodestyle)
    foreach($kodestyle as $style=>$color)
    foreach($color as $warna=>$data){
 ?>

<table class='hlap' width='100%'>
  <tr>
    <td width='10%'>Style</td><td width='1%'>:</td><td width='20%' align='left'><?= $style. ' ( ' .$warna ?> ) </td>
    <td width='55%'></td>
    <td width='5%'>No PO</td><td width='1%'>:</td><td width='20%' align='left'><?= $no_po ?></td>
  </tr>
  <tr>
    <td width='10%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='6%'></td>
    <td width='55%'></td>   
    <td width='5%'>Label</td><td width='1%'>:</td><td width='30%' align='left'><?= $label ?></td>   
  </tr>
</table>

<table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
  <thead>
  <tr>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Karton</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Scan</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Tanggal Scan</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" colspan=10><center>SIZE</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>QTY/CTN</center></th>
  </tr>
  <tr>
    <th style="background-color:#20B2AA; color: #ffffff"><center>SS</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>S</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>M</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>L</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>LL</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>3L</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>4L</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>5L</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>6L</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>7L</center></th>
  </tr>
  </thead>
  <tbody>
    <?php
      $no=0;       
      foreach($data as $pilih){
      $no++;
    ?>
    <tr class="belang">
      <td align='center'><?= $no ?></td>
      <td align='center'><?= $pilih['no_karton'] ?></td>
      <td align='center'><?= $pilih['tanggal'] ?> - <?= $pilih['jam'] ?></td>
      <td align='center'><?= $pilih['style'] ?> ( <?= $pilih['warna'] ?> )</td>
      <td align='center'><?= $pilih['size_ss'] ?></td>
      <td align='center'><?= $pilih['size_s'] ?></td>
      <td align='center'><?= $pilih['size_m'] ?></td>
      <td align='center'><?= $pilih['size_l'] ?></td>
      <td align='center'><?= $pilih['size_ll'] ?></td>
      <td align='center'><?= $pilih['size_3l'] ?></td>
      <td align='center'><?= $pilih['size_4l'] ?></td>
      <td align='center'><?= $pilih['size_5l'] ?></td>
      <td align='center'><?= $pilih['size_6l'] ?></td>
      <td align='center'><?= $pilih['size_7l'] ?></td>
      <td align='center'><?= $pilih['jumlah_size'] ?></td>
    </tr>
    </tr>
      <?php
        $no_karton2++;
        $no_karton3++;
        $total_ss += $pilih['size_ss'];
        $total_s += $pilih['size_s'];
        $total_m += $pilih['size_m'];
        $total_l += $pilih['size_l'];
        $total_ll += $pilih['size_ll'];
        $total_3l += $pilih['size_3l'];
        $total_4l += $pilih['size_4l'];
        $total_5l += $pilih['size_5l'];
        $total_6l += $pilih['size_6l'];
        $total_7l += $pilih['size_7l'];
        $qty_total += $pilih['jumlah_size'];
        $qty_total_semua += $pilih['jumlah_size'];      
      }
    ?>
    <tr class="belang">
      <td colspan="4" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_ss ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_s ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_m ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_l ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_ll ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_3l ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; align=center"><?= $total_4l ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_5l ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_6l ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_7l ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $qty_total ?></td>
    </tr>
    <tr>
      <td colspan=15>
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan=15>
        Total Karton : <?= $no_karton2 ?> Karton
      </td>
    </tr>
  </tbody>
</table>
<br><br><center>
<hr width="100%" />
</center><br><br>
<?php 
  $qty_total=0;
  $total_s =0;
  $total_m =0;
  $total_l =0;
  $total_ll =0;
  $total_3l =0;
  $total_4l =0;
  $total_5l =0;
  $total_6l =0;
  $total_7l =0;
  $no_karton2=0;
}
?>
</center>

TOTAL SCAN No PO 
<?php
  $po2=$_POST['no_po'];
  $laporan2 = tampilkan_laporan_packing_po($po);
  $datai = mysqli_fetch_assoc($laporan2);

  echo  $datai['no_po']; ?> Semuanya : <br>
Jumlah Barang dalam PCS :<?= $qty_total_semua; ?> PCS 
</br>
Jumlah Karton : <?= $no_karton3; ?> Karton

</body>
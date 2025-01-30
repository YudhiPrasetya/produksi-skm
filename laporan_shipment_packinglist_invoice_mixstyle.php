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
   background-color: #cccccc;
}
</style>

<?php
  $invoice=$_POST['invoice'];
  $laporan4 = tampilkan_master_shipment_id($invoice);
  $data4 = mysqli_fetch_assoc($laporan4);
?>
<center><h1>PT. GLOBALINDO INTIMATES</h1>
<h3>LAPORAN PACKING LIST</h3>
</center>
<br>
TRC NO : <?= $data4['no_invoice'] ?>

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
  $total_8l =0;
  $total_7 =0;
  $total_9 =0;
  $total_11 =0;
  $total_13 =0;
  $total_15 =0;
  $total_17 =0;
  $total_19 =0;
  $total_w70 =0;
  $total_w73 =0;
  $total_w76 =0;
  $total_w79 =0;
  $total_w82 =0;
  $total_w85 =0;
  $total_w88 =0;
  $total_w90 =0;
  $total_w91 =0;
  $total_w95 =0;
  $total_w96 =0;
  $total_w100 =0; 
  $total_w105 =0;
  $total_w106 =0;
  $total_w110 =0;
  $total_w115 =0;
  $total_w120 =0;
  $total_w125 =0;
  $subtotal =0;
  $qty_total=0;
  $qty_total_semua=0;
  $no_karton2=0;
  $no_karton3=0;
  $ctk =array();
    $laporan = tampilkan_laporan_shipment_per_invoice_lengkap_mixstyle($invoice);
    while($pilih = mysqli_fetch_array($laporan)){
      $ctk[$pilih['no_karton']][$pilih['description']][$pilih['kelompok_size']][]=array(
        'karton'=>$pilih['karton'],
        'no_po'=>$pilih['no_po'],
        'label'=>$pilih['label'],
        'tanggal_scan'=>$pilih['tanggal_scan'],
        'style'=>$pilih['style'],
        'warna'=>$pilih['warna'],
        'jumlah_size'=>$pilih['jumlah_size'],
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
        'size_7l'=>$pilih['size_7l'],
        'size_8l'=>$pilih['size_8l'],
        'size_7'=>$pilih['size_7'],
        'size_9'=>$pilih['size_9'],
        'size_11'=>$pilih['size_11'],
        'size_13'=>$pilih['size_13'],
        'size_15'=>$pilih['size_15'],
        'size_17'=>$pilih['size_17'],
        'size_19'=>$pilih['size_19'],
        'size_w70'=>$pilih['size_w70'],
        'size_w73'=>$pilih['size_w73'],
        'size_w76'=>$pilih['size_w76'],
        'size_w79'=>$pilih['size_w79'],
        'size_w82'=>$pilih['size_w82'],
        'size_w85'=>$pilih['size_w85'],
        'size_w88'=>$pilih['size_w88'],
        'size_w90'=>$pilih['size_w90'],
        'size_w91'=>$pilih['size_w91'],
        'size_w95'=>$pilih['size_w95'],
        'size_w96'=>$pilih['size_w96'],
        'size_w100'=>$pilih['size_w100'],
        'size_w105'=>$pilih['size_w105'],
        'size_w106'=>$pilih['size_w106'],
        'size_w110'=>$pilih['size_w110'],
        'size_w115'=>$pilih['size_w115'],
        'size_w120'=>$pilih['size_w120'],
        'size_w125'=>$pilih['size_w125']
    );      
  }
?>
<table border=1 width='100%' style="padding: 5px">
<tr>
  <td>
<?php
 foreach($ctk as $no_karton=>$desc)
 foreach($desc as $description=>$kelompok)
 foreach($kelompok as $kelompoksize=>$data){
?>

<table class='hlap' width='100%'>
  <tr>
    <td style="padding-bottom:30px" colspan='7' align="center"><u><b>DESCRIPTION OF GOODS : <?php echo $description ?></b></u></td>
  </tr>
  <tr>
    <td width='12%'>Inspection Date</td><td width='1%'>:</td><td width='15%' align='left'><?= tanggal_indo($data4['inspection'], false) ?> </td>
    <td width='45%'></td>
    <td width='12%'>Composition</td><td width='1%'>:</td><td width='15%' align='left'>100% POLYESTER</td>
  </tr>
  <tr>
    <td width='12%'>Style</td><td width='1%'>:</td><td width='15%' align='left'>MIX</td>
    <td width='45%'></td>
    <td width='12%'>Customer</td><td width='1%'>:</td><td width='15%' align='left'>UNICO </td>
  </tr>
  <tr>
    <td width='12%'>PO No</td><td width='1%'>:</td><td width='15%' align='left'></td>
    <td width='45%'></td>
    <td width='12%'>C/M</td><td width='1%'>:</td><td width='15%' align='left'>55 X 35 X 45 CM</td>
  </tr>
  <tr>
    <td width='12%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='6%'></td>
    <td width='45%'></td>        
  </tr>
</table> 
<?php
  $laporan2 = tampilkan_laporan_shipment_hidesize_mix($invoice);
  $pilih3 = mysqli_fetch_array($laporan2);
  if($kelompoksize == 'a'){
?>
<table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
  <thead>
  <tr>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Karton</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Scan</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Tanggal</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Order</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Label</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" colspan="
    <?php 
      if($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0 && $pilih3['size_6l'] == 0){
        echo '8';
      }elseif($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0){
        echo '9';
      }elseif($pilih3['size_8l'] == 0 ){
        echo '10';
      }else{
        echo '11';
      } 
     ?>
    "><center>SIZE</center></th>
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
    <?php 
    if($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0 && $pilih3['size_6l'] == 0) {
    echo "<th style='background-color:#20B2AA; color: #ffffff'><center>5L</center></th>";
    }elseif($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0) {
    echo "
    <th style='background-color:#20B2AA; color: #ffffff'><center>5L</center></th>
    <th style='background-color:#20B2AA; color: #ffffff'><center>6L</center></th>";
    }elseif($pilih3['size_8l'] == 0){
    echo "
    <th style='background-color:#20B2AA; color: #ffffff'><center>5L</center></th>
    <th style='background-color:#20B2AA; color: #ffffff;'><center>6L</center></th>
    <th style='background-color:#20B2AA; color: #ffffff;'><center>7L</center></th>";
    }else{
      echo "
      <th style='background-color:#20B2AA; color: #ffffff'><center>5L</center></th>
      <th style='background-color:#20B2AA; color: #ffffff;'><center>6L</center></th>
      <th style='background-color:#20B2AA; color: #ffffff;'><center>7L</center></th>
      <th style='background-color:#20B2AA; color: #ffffff;'><center>8L</center></th>";
    } ?>
  </tr>
  </thead>
  <tbody>
    <?php
      $no=1;
      foreach($data as $pilih){
    ?>
    <tr class="belang">
      <td align='center'><?= $no; ?></td>
      <td align='center'><?= $pilih['no_karton'] ?></td>
      <td align='center'><?= tgl_indonesia3($pilih['tanggal_scan']) ?> </td>
      <td align='center'><?= $pilih['no_po'] ?></td>
      <td align='center'><?= $pilih['label'] ?></td>
      <td align='center'><?= $pilih['style'] ?></td>
      <td align='center'><?= $pilih['warna'] ?></td>
      <td align='center'><?= $pilih['size_ss'] ?></td>
      <td align='center'><?= $pilih['size_s'] ?></td>
      <td align='center'><?= $pilih['size_m'] ?></td>
      <td align='center'><?= $pilih['size_l'] ?></td>
      <td align='center'><?= $pilih['size_ll'] ?></td>
      <td align='center'><?= $pilih['size_3l'] ?></td>
      <td align='center'><?= $pilih['size_4l'] ?></td>
  <!-- ========================== menyembunyikan size yg kosong ============================= -->
    <?php if($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0 && $pilih3['size_6l'] == 0) {
      echo "<td align='center'> $pilih[size_5l]</td>";
    }elseif($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0) {
      echo "
      <td align='center'> $pilih[size_5l]</td>
      <td align='center'>$pilih[size_6l]</td>";
    }elseif($pilih3['size_8l'] == 0){  
      echo "
      <td align='center'> $pilih[size_5l]</td>
      <td align='center'>$pilih[size_6l] </td>
      <td align='center'>$pilih[size_7l] </td>";
    }else{ 
      echo "
      <td align='center'> $pilih[size_5l]</td>
      <td align='center'>$pilih[size_6l] </td>
      <td align='center'>$pilih[size_7l] </td>
      <td align='center'> $pilih[size_8l]</td>";
    }
    ?>
  <!-- ========================== menyembunyikan size yg kosong ============================= -->
      <td align='center'><?= $pilih['jumlah_size'] ?></td>
    </tr>
    
      <?php
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
        $total_8l += $pilih['size_8l'];
        $qty_total += $pilih['jumlah_size'];
        $qty_total_semua += $pilih['jumlah_size'];      
      }
      $no++; 
      $no_karton2++;
      $no_karton3++;
    ?>
    <tr class="belang">
      <td colspan="7" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_ss ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_s ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_m ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_l ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_ll ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_3l ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_4l ?></td>
      <?php if($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0 && $pilih3['size_6l'] == 0) {
        echo "<td align='center' style='background-color:#20B2AA; color: #ffffff;'>$total_5l </td>";
      }elseif($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0) {
        echo "
        <td align='center' style='background-color:#20B2AA; color: #ffffff;'>$total_5l</td>
        <td align='center' style='background-color:#20B2AA; color: #ffffff;'>$total_6l</td>";
      }elseif($pilih3['size_8l'] == 0){
        echo "
        <td align='center' style='background-color:#20B2AA; color: #ffffff;'>$total_5l</td>
        <td align='center' style='background-color:#20B2AA; color: #ffffff;'>$total_6l</td>
        <td align='center' style='background-color:#20B2AA; color: #ffffff; '> $total_7l </td>";
      }else{
        echo "
        <td align='center' style='background-color:#20B2AA; color: #ffffff;'>$total_5l</td>
        <td align='center' style='background-color:#20B2AA; color: #ffffff;'>$total_6l</td>
        <td align='center' style='background-color:#20B2AA; color: #ffffff;'> $total_7l</td>
        <td align='center' style='background-color:#20B2AA; color: #ffffff;'> $total_8l</td>";
      } ?>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
    </tr>
    <tr>
      <td colspan=18>
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan=18>
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
  $total_8l =0;
  $no_karton2=0;

?>
</center>

<?php }elseif ($kelompoksize == 'b') { ?>

<table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
<thead>
<tr>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Karton</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Scan</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Tanggal</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Order</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Label</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" colspan="
  <?php 
     if($pilih3['size_w70'] > 0){ $w70 = 0; }else{ $w70 = 1; }
     if($pilih3['size_w73'] > 0){ $w73 = 0; }else{ $w73 = 1; }
     if($pilih3['size_w76'] > 0){ $w76 = 0; }else{ $w76 = 1; }
     if($pilih3['size_w79'] > 0){ $w79 = 0; }else{ $w79 = 1; }
     if($pilih3['size_w82'] > 0){ $w82 = 0; }else{ $w82 = 1; }
     if($pilih3['size_w85'] > 0){ $w85 = 0; }else{ $w85 = 1; }
     if($pilih3['size_w88'] > 0){ $w88 = 0; }else{ $w88 = 1; }
     if($pilih3['size_w90'] > 0){ $w90 = 0; }else{ $w90 = 1; }
     if($pilih3['size_w91'] > 0){ $w91 = 0; }else{ $w91 = 1; }
     if($pilih3['size_w95'] > 0){ $w95 = 0; }else{ $w95 = 1; }
     if($pilih3['size_w96'] > 0){ $w96 = 0; }else{ $w96 = 1; }
     if($pilih3['size_w100'] > 0){ $w100 = 0; }else{ $w100 = 1; }
     if($pilih3['size_w105'] > 0){ $w105 = 0; }else{ $w105 = 1; }
     if($pilih3['size_w106'] > 0){ $w106 = 0; }else{ $w106 = 1; }
     if($pilih3['size_w110'] > 0){ $w110 = 0; }else{ $w110 = 1; }
     if($pilih3['size_w115'] > 0){ $w115 = 0; }else{ $w115 = 1; }
     if($pilih3['size_w120'] > 0){ $w120 = 0; }else{ $w120 = 1; }
     if($pilih3['size_w125'] > 0){ $w125 = 0; }else{ $w125 = 1; }
    $total_hide = 18 - ($w70 + $w73 + $w76 + $w79 + $w82 + $w85 + $w88 + $w90 + $w91 + $w95 + $w96 + $w100
     + $w105 + $w106 + $w110 + $w115 + $w120 + $w125);
     echo $total_hide;
   ?>"><center>SIZE</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>QTY/CTN</center></th>
</tr>
<tr>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><center>W70</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><center>W73</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><center>W76</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><center>W79</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><center>W82</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><center>W85</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><center>W88</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><center>W90</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><center>W91</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><center>W95</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><center>W96</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><center>W100</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><center>W105</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><center>W106</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><center>W110</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><center>W115</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><center>W120</center></th>
  <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><center>W125</center></th>
</tr>
</thead>
<tbody>
  <?php
    $no=1;       
    foreach($data as $pilih){
   
  ?>
  <tr class="belang">
    <td align='center'><?= $no; ?></td>
    <td align='center'><?= $pilih['no_karton'] ?></td>
    <td align='center'><?= tgl_indonesia3($pilih['tanggal_scan']) ?> </td>
    <td align='center'><?= $pilih['no_po'] ?></td>
    <td align='center'><?= $pilih['label'] ?></td>
    <td align='center'><?= $pilih['style'] ?></td>
    <td align='center'><?= $pilih['warna'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w70'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w73'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w76'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w79'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w82'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w85'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w88'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w90'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w91'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w95'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w96'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w100'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w105'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w106'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w110'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w115'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w120'] ?></td>
    <td align='center' style="display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w125'] ?></td>
    <td align='center'><?= $pilih['jumlah_size'] ?></td>
  </tr>
  
    <?php
      $total_w70 += $pilih['size_w70'];
      $total_w73 += $pilih['size_w73'];
      $total_w76 += $pilih['size_w76'];
      $total_w79 += $pilih['size_w79'];
      $total_w82 += $pilih['size_w82'];
      $total_w85 += $pilih['size_w85'];
      $total_w88 += $pilih['size_w88'];
      $total_w90 += $pilih['size_w90'];
      $total_w91 += $pilih['size_w91'];
      $total_w95 += $pilih['size_w95'];
      $total_w96 += $pilih['size_w96'];
      $total_w100 += $pilih['size_w100'];
      $total_w105 += $pilih['size_w105'];
      $total_w106 += $pilih['size_w106'];
      $total_w110 += $pilih['size_w110'];
      $total_w115 += $pilih['size_w115'];
      $total_w120 += $pilih['size_w120'];
      $total_w125 += $pilih['size_w125'];
      $qty_total += $pilih['jumlah_size'];
      $qty_total_semua += $pilih['jumlah_size'];      
    }
    $no++; 
    $no_karton2++;
    $no_karton3++;
  ?>
  <tr class="belang">
    <td colspan="7" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $total_w70 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><?= $total_w73 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><?= $total_w76 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><?= $total_w79 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><?= $total_w82 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><?= $total_w85 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><?= $total_w88 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><?= $total_w90 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><?= $total_w91 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><?= $total_w95 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><?= $total_w96 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><?= $total_w100 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><?= $total_w105 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><?= $total_w106 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><?= $total_w110 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><?= $total_w115 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><?= $total_w120 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><?= $total_w125 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
  </tr>
  <tr>
    <td colspan=18>
      Total Quantity : <?= $qty_total ?> PCS
    </td>
  </tr>
  <tr>
    <td colspan=18>
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
$total_w70 =0;
$total_w73 =0;
$total_w76 =0;
$total_w79 =0;
$total_w82 =0;
$total_w85 =0;
$total_w88 =0;
$total_w90 =0;
$total_w91 =0;
$total_w95 =0;
$total_w96 =0;
$total_w100 =0;
$total_w105 =0;
$total_w106 =0;
$total_w110 =0;
$total_w115 =0;
$total_w120 =0;
$total_w125 =0;
$no_karton2=0;

?>
</center>

<?php }elseif ($kelompoksize == 'c') { ?>

<table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
<thead>
<tr>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Karton</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Scan</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Tanggal</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Order</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Label</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" colspan="7"><center>SIZE</center></th>
  <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>QTY/CTN</center></th>
</tr>
<tr>
    <th style="background-color:#20B2AA; color: #ffffff"><center>7</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>9</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>11</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>13</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>15</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>17</center></th>
    <th style="background-color:#20B2AA; color: #ffffff"><center>19</center></th>
  </tr>
</thead>
<tbody>
  <?php
    $no=1;       
    foreach($data as $pilih){
   
  ?>
  <tr class="belang">
    <td align='center'><?= $no; ?></td>
    <td align='center'><?= $pilih['no_karton'] ?></td>
    <td align='center'><?= tgl_indonesia3($pilih['tanggal_scan']) ?> </td>
    <td align='center'><?= $pilih['no_po'] ?></td>
    <td align='center'><?= $pilih['label'] ?></td>
    <td align='center'><?= $pilih['style'] ?></td>
    <td align='center'><?= $pilih['warna'] ?></td>
    <td align='center'><?= $pilih['size_7'] ?></td>
      <td align='center'><?= $pilih['size_9'] ?></td>
      <td align='center'><?= $pilih['size_11'] ?></td>
      <td align='center'><?= $pilih['size_13'] ?></td>
      <td align='center'><?= $pilih['size_15'] ?></td>
      <td align='center'><?= $pilih['size_17'] ?></td>
      <td align='center'><?= $pilih['size_19'] ?></td>
    <td align='center'><?= $pilih['jumlah_size'] ?></td>
  </tr>
  
    <?php
      $total_7 += $pilih['size_7'];
      $total_9 += $pilih['size_9'];
      $total_11 += $pilih['size_11'];
      $total_13 += $pilih['size_13'];
      $total_15 += $pilih['size_15'];
      $total_17 += $pilih['size_17'];
      $total_19 += $pilih['size_19'];
      $qty_total += $pilih['jumlah_size'];
      $qty_total_semua += $pilih['jumlah_size'];      
    }
    $no++; 
    $no_karton2++;
    $no_karton3++;
  ?>
  <tr class="belang">
    <td colspan="7" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_7 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_9 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_11 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_13 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_15 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_17 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= $total_19 ?></td>
    <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
  </tr>
  <tr>
    <td colspan=18>
      Total Quantity : <?= $qty_total ?> PCS
    </td>
  </tr>
  <tr>
    <td colspan=18>
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
$total_7 =0;
$total_9 =0;
$total_11 =0;
$total_13 =0;
$total_15 =0;
$total_17 =0;
$total_19 =0;
$no_karton2=0;

?>
</center>

<?php }} ?>
<table width="100%" style="background-color:yellow; font-weight:bold">
    <tr>
        <td align="center" colspan="2">
            TOTAL SCAN SEMUANYA 
        </td>
    </tr>
    <tr>
        <td>    
            Jumlah Barang dalam PCS :<?php echo $qty_total_semua; ?> PCS 
        </td>
    </tr>
    <tr>
        <td>    
            Jumlah Karton : <?=$no_karton3;?> Karton
        </td>
    </tr>
</tr>
</table>
</td>
</tr>
</table>
</body>

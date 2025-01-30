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


  $laporan2 = tampilkan_laporan_packinglist_lengkap_invoice_buyer($invoice);
  $data = mysqli_fetch_assoc($laporan2);


?>

<center><h1>PT. Globalindo Intimates</h1>
<h3>LAPORAN PACKING LIST</h3>

</center>
<br>
TRC NO : <?= $data['no_invoice'] ?>

<?php
$no=1;
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
   $total_1 =0;
   $total_2 =0;
   $total_3 =0;
   $total_4 =0;
   $total_5 =0;
   $total_6 =0;
   $total_7 =0;
   $total_8 =0;
   $total_9 =0;
   $total_10 =0;
   $total_11 =0;
   $total_12 =0;
   $total_13 =0;
   $total_14 =0;
   $total_15 =0;
   $total_16 =0;
   $total_17 =0;
   $total_18 =0;
   $total_19 =0;
   $total_w70 =0;
    $total_w71 =0;
    $total_w72 =0;
    $total_w73 =0;
    $total_w74 =0;
    $total_w75 =0;
    $total_w76 =0;
    $total_w77 =0;
    $total_w78 =0;
    $total_w79 =0;
    $total_w80 =0;
    $total_w81 =0;
    $total_w82 =0;
    $total_w83 =0;
    $total_w84 =0;
    $total_w85 =0;
    $total_w86 =0;
    $total_w87 =0;
    $total_w88 =0;
    $total_w89 =0;
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
   $total_w130 =0;
   $totalsemua_ss =0;
   $totalsemua_s =0;
   $totalsemua_m =0;
   $totalsemua_l =0;
   $totalsemua_ll =0;
   $totalsemua_3l =0;
   $totalsemua_4l =0;
   $totalsemua_5l =0;
   $totalsemua_6l =0;
   $totalsemua_7l =0; 
   $totalsemua_8l =0;
   $totalsemua_1 =0;
   $totalsemua_2 =0;
   $totalsemua_3 =0;
   $totalsemua_4 =0;
   $totalsemua_5 =0;
   $totalsemua_6 =0;
   $totalsemua_7 =0;
   $totalsemua_8 =0;
   $totalsemua_9 =0;
   $totalsemua_10 =0;
   $totalsemua_11 =0;
   $totalsemua_12 =0;
   $totalsemua_13 =0;
   $totalsemua_14 =0;
   $totalsemua_15 =0;
   $totalsemua_16 =0;
   $totalsemua_17 =0;
   $totalsemua_18 =0;
   $totalsemua_19 =0;
   $totalsemua_w70 =0;
   $totalsemua_w73 =0;
   $totalsemua_w76 =0;
   $totalsemua_w79 =0;
   $totalsemua_w82 =0;
   $totalsemua_w85 =0;
   $totalsemua_w88 =0;
   $totalsemua_w90 =0;
   $totalsemua_w91 =0;
   $totalsemua_w95 =0;
   $totalsemua_w96 =0;
   $totalsemua_w100 =0;
   $totalsemua_w105 =0;
   $totalsemua_w106 =0;
   $totalsemua_w110 =0;
   $totalsemua_w115 =0;
   $totalsemua_w120 =0;
   $totalsemua_w125 =0;
   $totalsemua_w130 =0;
  $subtotal =0;
  $qty_total=0;
  $qty_total_semua=0;
  $total_cbm = 0;
  $jmlh_karton = 0;
  $tot_jmlh_karton = 0;
  $total_gross_semua = 0;
  $total_nett_semua = 0; 
  $ctk =array();
    $laporan2 = tampilkan_laporan_packinglist_lengkap_invoice_buyer($invoice);
    $pilih2 = mysqli_fetch_array($laporan2); ?>
    <div style="border:1px solid black">
    <table class='hlap' width='100%' style="padding: 5px">
        <tr>
          <td style="padding-bottom:30px" colspan='7' align="center"><u><b>DESCRIPTION OF GOODS : <?= $pilih2['description']; ?></b></u></td>
        </tr>
        <tr>
            <td width='12%'>No Contract</td><td width='1%'>:</td><td width='15%' align='left'><?= $pilih2['no_contract'] ?> </td>
            <td width='45%'></td>
            <td width='12%'></td><td width='1%'></td><td width='15%' align='left'></td>
        </tr>
        <tr>
            <td width='12%'>PO Number</td><td width='1%'>:</td><td width='15%' align='left'><?= $pilih2['no_po']; ?> </td>
            <td width='45%'></td>
            <td width='12%'>Customer</td><td width='1%'>:</td><td width='15%' align='left'><?= $pilih2['costomer']; ?></td>
        </tr>
        <tr>
            <td width='12%'>Style</td><td width='1%'>:</td><td width='15%' align='left'><?= $pilih2['style']; ?></td>
            <td width='45%'></td>
            <td width='12%'>C/M</td><td width='1%'>:</td><td width='15%' align='left'><?= $pilih2['ukuran_karton'] ?></td>
        </tr>
        <tr>
            <td width='12%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='6%'></td>
            <td width='45%'></td>      
        </tr>
      </table>
</div>
      <?php
    $laporan = tampilkan_laporan_packinglist_lengkap_invoice_buyer($invoice);
    while($pilih = mysqli_fetch_array($laporan)){ 
      $ctk[$pilih['orc']][$pilih['style']][$pilih['warna']][$pilih['kelompok_size']][]=array(
      'karton'=>$pilih['karton'],
      'tanggal_scan'=>$pilih['tanggal_scan'],
      'style'=>$pilih['style'],
      'warna'=>$pilih['warna'], 
      'label'=>$pilih['label'],
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
      'size_1'=>$pilih['size_1'],
      'size_2'=>$pilih['size_2'],
      'size_3'=>$pilih['size_3'],
      'size_4'=>$pilih['size_4'],
      'size_5'=>$pilih['size_5'],
      'size_6'=>$pilih['size_6'],
      'size_7'=>$pilih['size_7'],
      'size_8'=>$pilih['size_8'],
      'size_9'=>$pilih['size_9'],
      'size_10'=>$pilih['size_10'],
      'size_11'=>$pilih['size_11'],
      'size_12'=>$pilih['size_12'],
      'size_13'=>$pilih['size_13'],
      'size_14'=>$pilih['size_14'],
      'size_15'=>$pilih['size_15'],
      'size_16'=>$pilih['size_16'],
      'size_17'=>$pilih['size_17'],
      'size_18'=>$pilih['size_18'],
      'size_19'=>$pilih['size_19'],
      'size_w70'=>$pilih['size_w70'],
      'size_w71'=>$pilih['size_w71'],
      'size_w72'=>$pilih['size_w72'],
      'size_w73'=>$pilih['size_w73'],
      'size_w74'=>$pilih['size_w74'],
      'size_w75'=>$pilih['size_w75'],
      'size_w76'=>$pilih['size_w76'],
      'size_w77'=>$pilih['size_w77'],
      'size_w78'=>$pilih['size_w78'],
      'size_w79'=>$pilih['size_w79'],
      'size_w80'=>$pilih['size_w80'],
      'size_w81'=>$pilih['size_w81'],
      'size_w82'=>$pilih['size_w82'],
      'size_w83'=>$pilih['size_w83'],
      'size_w84'=>$pilih['size_w84'],
      'size_w85'=>$pilih['size_w85'],
      'size_w86'=>$pilih['size_w86'],
      'size_w87'=>$pilih['size_w87'],
      'size_w88'=>$pilih['size_w88'],
      'size_w89'=>$pilih['size_w89'],
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
      'size_w125'=>$pilih['size_w125'],
      'size_w130'=>$pilih['size_w130']
  );      
} 
?>

<table border=1 width='100%' style="padding: 5px">
  <tr>
    <td>
<?php
  foreach($ctk as $orc=>$style2)
  foreach($style2 as $style=>$color)
  foreach($color as $warna=>$kelompok)
  foreach($kelompok as $kelompoksize=>$data){   
?>


<?php
  $laporan2 = tampilkan_laporan_shipment_hidesize($invoice);
  $pilih3 = mysqli_fetch_array($laporan2);
  if($kelompoksize == 'a'){
?>
<table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="2"><center>No Karton</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="2" rowspan="2"><center>QTY/CTN</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="
      <?php 
        if($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0 && $pilih3['size_6l'] == 0){
          $jumhide = 8;
        }elseif($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0){
          $jumhide = 9;
        }elseif($pilih3['size_8l'] == 0 ){
          $jumhide = 10;
        }else{
          $jumhide = 11;
        } 

        if($pilih3['size_ss'] == 0){
          $jumhide_ss = 1;
        }else{
          $jumhide_ss = 0;
        }

        $total_hide = $jumhide - $jumhide_ss;
        echo $total_hide;
        ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>TOTAL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>CBM</center></th>
    </tr>
    <tr>
      <th style="background-color:#20B2AA; color: #ffffff"><center>FR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>TO</center></th>
      <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;"><center>SS</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>S</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>M</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>L</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>LL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>3L</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>4L</center></th>
        <?php 
          if($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0 && $pilih3['size_6l'] == 0) {
            echo "
              <th style='background-color:#20B2AA; color: #ffffff'><center>5L</center></th>";
          }elseif($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0) {
            echo " 
              <th style='background-color:#20B2AA; color: #ffffff'><center>5L</center></th>
              <th style='background-color:#20B2AA; color: #ffffff'><center>6L</center></th>";
          }elseif($pilih3['size_8l'] == 0){
            echo "
              <th style='background-color:#20B2AA; color: #ffffff'><center>5L</center></th>
              <th style='background-color:#20B2AA; color: #ffffff'><center>6L</center></th>
              <th style='background-color:#20B2AA; color: #ffffff'><center>7L</center></th>";
          }else{
             echo "
            <th style='background-color:#20B2AA; color: #ffffff'><center>5L</center></th>
            <th style='background-color:#20B2AA; color: #ffffff'><center>6L</center></th>
            <th style='background-color:#20B2AA; color: #ffffff'><center>7L</center></th>
            <th style='background-color:#20B2AA; color: #ffffff'><center>8L</center></th>";
          } ?>
        </tr>
  </thead>
  <tbody>
    <?php
      
      foreach($data as $pilih){
        $no_to = $no+$pilih['karton']-1;
        $tot_cbm = $pilih['karton']*0.09;
    ?>
    <tr class="belang">
      <td align='center'><?= $no; ?></td>
      <td align='center'><?= $no_to; ?></td>
      <td align='center' ><?= $pilih['karton'] ?></td>
      <td align='center' ><?= $pilih['jumlah_size']/$pilih['karton'] ?></td>
      <td align='center' ><?= $pilih['label'] ?></td>
      <td align='center'><?= $pilih['style'] ?></td>
      <td align='center'><?= $pilih['warna']; ?></td>
      <td align='center' style="display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;"><?= $pilih['size_ss']; ?></td>
      <td align='center'><?= $pilih['size_s']; ?></td>
      <td align='center'><?= $pilih['size_m']; ?></td>
      <td align='center'><?= $pilih['size_l']; ?></td>
      <td align='center'><?= $pilih['size_ll']; ?></td>
      <td align='center'><?= $pilih['size_3l']; ?></td>
      <td align='center'><?= $pilih['size_4l']; ?></td>
      <?php 
        if($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0 && $pilih3['size_6l'] == 0) {
          echo "
            <td align='center'>$pilih[size_5l]</td>";
        }elseif($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0) {
          echo "
            <td align='center'>$pilih[size_5l]</td>
            <td align='center'>$pilih[size_6l]</td>";
        }elseif($pilih3['size_8l'] == 0){  
          echo "
            <td align='center'>$pilih[size_5l]</td>
            <td align='center'>$pilih[size_6l]</td>
            <td align='center'>$pilih[size_7l]</td>";
        }else{ 
          echo "
            <td align='center'>$pilih[size_5l]</td>
            <td align='center'>$pilih[size_6l]</td>
            <td align='center'>$pilih[size_7l]</td>
            <td align='center'>$pilih[size_8l]</td>"; } ?>
      <td align='center'><?= $pilih['jumlah_size']; ?></td>
      <td align='center'><?= $tot_cbm ?></td>
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
        $totalsemua_ss += $pilih['size_ss'];
        $totalsemua_s += $pilih['size_s'];
        $totalsemua_m += $pilih['size_m'];
        $totalsemua_l += $pilih['size_l'];
        $totalsemua_ll += $pilih['size_ll'];
        $totalsemua_3l += $pilih['size_3l'];
        $totalsemua_4l += $pilih['size_4l'];
        $totalsemua_5l += $pilih['size_5l'];
        $totalsemua_6l += $pilih['size_6l'];
        $totalsemua_7l += $pilih['size_7l'];
        $totalsemua_8l += $pilih['size_8l'];
        $total_cbm += $tot_cbm;
        $qty_total += $pilih['jumlah_size'];
        $qty_total_semua += $pilih['jumlah_size'];
        $jmlh_karton += $pilih['karton'];
        $tot_jmlh_karton += $pilih['karton'];
        $no += $pilih['karton'];
        }
      ?>
    <tr class="belang">
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' colspan='7' >Total QTY :</td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold; display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;' align='center'><?= $total_ss ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $total_s ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $total_m ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_l ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_ll ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_3l ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_4l ?></td>
        <?php 
          if($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0 && $pilih3['size_6l'] == 0) {
            echo "
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_5l</td>";
          }elseif($pilih3['size_8l'] == 0 && $pilih3['size_7l'] == 0) {
            echo "
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_5l</td>
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_6l</td>";
          }elseif($pilih3['size_8l'] == 0){
            echo "
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_5l</td>
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_6l</td>
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_7l</td>";
          }else{
            echo "
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_5l</td>
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_6l</td>
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_7l</td>
              <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'>$total_8l</td>";
          } ?>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $qty_total ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= number_format($total_cbm,2) ?></td>
    </tr>
    <tr>
      <td colspan=24>
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan=24>
        Total Karton : <?= $jmlh_karton ?> Karton
      </td>
    </tr>
  </tbody>
</table>
<br><center>
<hr width="100%" />
</center><br>
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
  $jmlh_karton =0;
  $total_cbm = 0;

?>


</center>

<?php }elseif ($kelompoksize == 'b') { ?>
  <table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="2"><center>No Karton</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="2" rowspan="2"><center>QTY/CTN</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="
      <?php 
          if($pilih3['size_w70'] > 0){ $w70 = 0; }else{ $w70 = 1; }
          if($pilih3['size_w71'] > 0){ $w71 = 0; }else{ $w71 = 1; }
          if($pilih3['size_w72'] > 0){ $w72 = 0; }else{ $w72 = 1; }
          if($pilih3['size_w73'] > 0){ $w73 = 0; }else{ $w73 = 1; }
          if($pilih3['size_w74'] > 0){ $w74 = 0; }else{ $w74 = 1; }
          if($pilih3['size_w75'] > 0){ $w75 = 0; }else{ $w75 = 1; }
          if($pilih3['size_w76'] > 0){ $w76 = 0; }else{ $w76 = 1; }
          if($pilih3['size_w77'] > 0){ $w77 = 0; }else{ $w77 = 1; }
          if($pilih3['size_w78'] > 0){ $w78 = 0; }else{ $w78 = 1; }
          if($pilih3['size_w79'] > 0){ $w79 = 0; }else{ $w79 = 1; }
          if($pilih3['size_w80'] > 0){ $w80 = 0; }else{ $w80 = 1; }
          if($pilih3['size_w81'] > 0){ $w81 = 0; }else{ $w81 = 1; }
          if($pilih3['size_w82'] > 0){ $w82 = 0; }else{ $w82 = 1; }
          if($pilih3['size_w83'] > 0){ $w83 = 0; }else{ $w83 = 1; }
          if($pilih3['size_w84'] > 0){ $w84 = 0; }else{ $w84 = 1; }
          if($pilih3['size_w85'] > 0){ $w85 = 0; }else{ $w85 = 1; }
          if($pilih3['size_w86'] > 0){ $w86 = 0; }else{ $w86 = 1; }
          if($pilih3['size_w87'] > 0){ $w87 = 0; }else{ $w87 = 1; }
          if($pilih3['size_w88'] > 0){ $w88 = 0; }else{ $w88 = 1; }
          if($pilih3['size_w89'] > 0){ $w89 = 0; }else{ $w89 = 1; }
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
          if($pilih3['size_w130'] > 0){ $w130 = 0; }else{ $w130 = 1; }
          $total_hide = 32 - ($w70 + $w71 + $w72 + $w73 + $w74 + $w75 + $w76 + $w77 + $w78 + $w79 + $w80 + $w81 + 
              $w82 + $w83 + $w84 + $w85 + $w86 + $w87 + $w88 + $w89 + $w90 + $w91 + $w95 + $w96 + $w100
          + $w105 + $w106 + $w110 + $w115 + $w120 + $w125 + $w130);
          echo $total_hide;
        ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>TOTAL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>CBM</center></th>
    </tr>
    <tr>
        <th style="background-color:#20B2AA; color: #ffffff"><center>FR</center></th>
        <th style="background-color:#20B2AA; color: #ffffff"><center>TO</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><center>W70</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><center>W71</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><center>W72</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><center>W73</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><center>W74</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><center>W75</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><center>W76</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><center>W77</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><center>W78</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><center>W79</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><center>W80</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><center>W81</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><center>W82</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><center>W83</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><center>W84</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><center>W85</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><center>W86</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><center>W87</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><center>W88</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><center>W89</center></th>
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
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><center>W130</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no=1;
      foreach($data as $pilih){
        $no_to = $no+$pilih['karton']-1;
        $tot_cbm = $pilih['karton']*0.09;
    ?>
    <tr class="belang">
      <td align='center'><?= $no; ?></td>
      <td align='center'><?= $no_to; ?></td>
      <td align='center' ><?= $pilih['karton'] ?></td>
      <td align='center' ><?= $pilih['jumlah_size']/$pilih['karton'] ?></td>
      <td align='center' ><?= $pilih['label'] ?></td>
      <td align='center'><?= $pilih['style'] ?></td>
      <td align='center'><?= $pilih['warna']; ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w70'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w71'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w72'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w73'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w74'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w75'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w76'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w77'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w78'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w79'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w80'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w81'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w82'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w83'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w84'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w85'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w86'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w87'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w88'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w89'] ?></td>
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
      <td align='center' style="display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><?= $pilih['size_w130'] ?></td>
      <td align='center'><?= $pilih['jumlah_size']; ?></td>
      <td align='center'><?= $tot_cbm ?></td>
    </tr>
      <?php 
         $total_w70 += $pilih['size_w70'];
         $total_w71 += $pilih['size_w71'];
         $total_w72 += $pilih['size_w72'];
         $total_w73 += $pilih['size_w73'];
         $total_w74 += $pilih['size_w74'];
         $total_w75 += $pilih['size_w75'];
         $total_w76 += $pilih['size_w76'];
         $total_w77 += $pilih['size_w77'];
         $total_w78 += $pilih['size_w78'];
         $total_w79 += $pilih['size_w79'];
         $total_w80 += $pilih['size_w80'];
         $total_w81 += $pilih['size_w81'];
         $total_w82 += $pilih['size_w82'];
         $total_w83 += $pilih['size_w83'];
         $total_w84 += $pilih['size_w84'];
         $total_w85 += $pilih['size_w85'];
         $total_w86 += $pilih['size_w86'];
         $total_w87 += $pilih['size_w87'];
         $total_w88 += $pilih['size_w88'];
         $total_w89 += $pilih['size_w89'];
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
        $total_w130 += $pilih['size_w130'];
        $totalsemua_w70 += $pilih['size_w70'];
        $totalsemua_w71 += $pilih['size_w71'];
        $totalsemua_w72 += $pilih['size_w72'];
        $totalsemua_w73 += $pilih['size_w73'];
        $totalsemua_w74 += $pilih['size_w74'];
        $totalsemua_w75 += $pilih['size_w75'];
        $totalsemua_w76 += $pilih['size_w76'];
        $totalsemua_w77 += $pilih['size_w77'];
        $totalsemua_w78 += $pilih['size_w78'];
        $totalsemua_w79 += $pilih['size_w79'];
        $totalsemua_w80 += $pilih['size_w80'];
        $totalsemua_w81 += $pilih['size_w81'];
        $totalsemua_w82 += $pilih['size_w82'];
        $totalsemua_w83 += $pilih['size_w83'];
        $totalsemua_w84 += $pilih['size_w84'];
        $totalsemua_w85 += $pilih['size_w85'];
        $totalsemua_w86 += $pilih['size_w86'];
        $totalsemua_w87 += $pilih['size_w87'];
        $totalsemua_w88 += $pilih['size_w88'];
        $totalsemua_w89 += $pilih['size_w89'];
        $totalsemua_w90 += $pilih['size_w90'];
        $totalsemua_w91 += $pilih['size_w91'];
        $totalsemua_w95 += $pilih['size_w95'];
        $totalsemua_w96 += $pilih['size_w96'];
        $totalsemua_w100 += $pilih['size_w100'];
        $totalsemua_w105 += $pilih['size_w105'];
        $totalsemua_w106 += $pilih['size_w106'];
        $totalsemua_w110 += $pilih['size_w110'];
        $totalsemua_w115 += $pilih['size_w115'];
        $totalsemua_w120 += $pilih['size_w120'];
        $totalsemua_w125 += $pilih['size_w125'];
        $totalsemua_w130 += $pilih['size_w130'];
        $total_cbm += $tot_cbm;
        $qty_total += $pilih['jumlah_size'];
        $qty_total_semua += $pilih['jumlah_size'];
        $jmlh_karton += $pilih['karton'];
        $tot_jmlh_karton += $pilih['karton'];
        $no += $pilih['karton'];
        }
      ?>
    <tr class="belang">
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' colspan='7' >Total QTY :</td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $total_w70 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><?= $total_w71 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><?= $total_w72 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><?= $total_w73 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><?= $total_w74 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><?= $total_w75 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><?= $total_w76 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><?= $total_w77 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><?= $total_w78 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><?= $total_w79 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><?= $total_w80 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $total_w81 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><?= $total_w82 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><?= $total_w83 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><?= $total_w84 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><?= $total_w85 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><?= $total_w86 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><?= $total_w87 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><?= $total_w88 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><?= $total_w89 ?></td>
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
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><?= $total_w130 ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $qty_total ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= number_format($total_cbm,2) ?></td>
    </tr>
    <tr>
      <td colspan=24>
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan=24>
        Total Karton : <?= $jmlh_karton ?> Karton
      </td>
    </tr>
  </tbody>
</table>
<br><center>
<hr width="100%" />
</center><br>
<?php
  $qty_total=0;
  $total_w70 =0;
    $total_w71 =0;
    $total_w72 =0;
    $total_w73 =0;
    $total_w74 =0;
    $total_w75 =0;
    $total_w76 =0;
    $total_w77 =0;
    $total_w78 =0;
    $total_w79 =0;
    $total_w80 =0;
    $total_w81 =0;
    $total_w82 =0;
    $total_w83 =0;
    $total_w84 =0;
    $total_w85 =0;
    $total_w86 =0;
    $total_w87 =0;
    $total_w88 =0;
    $total_w89 =0;
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
   $total_w130 =0;
  $jmlh_karton =0;
  $total_cbm = 0;

?>
</center>

<?php }elseif ($kelompoksize == 'c') { ?>
  <table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="2"><center>No Karton</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="2" rowspan="2"><center>QTY/CTN</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="
      <?php 
          if($pilih3['size_1'] > 0){ $s1 = 0; }else{ $s1 = 1; }
          if($pilih3['size_2'] > 0){ $s2 = 0; }else{ $s2 = 2; }
          if($pilih3['size_3'] > 0){ $s3 = 0; }else{ $s3 = 1; }
          if($pilih3['size_4'] > 0){ $s4 = 0; }else{ $s4 = 1; }
          if($pilih3['size_5'] > 0){ $s5 = 0; }else{ $s5 = 1; }
          if($pilih3['size_6'] > 0){ $s6 = 0; }else{ $s6 = 1; }
          if($pilih3['size_7'] > 0){ $s7 = 0; }else{ $s7 = 1; }
          if($pilih3['size_8'] > 0){ $s8 = 0; }else{ $s8 = 1; }
          if($pilih3['size_9'] > 0){ $s9 = 0; }else{ $s9 = 1; }
          if($pilih3['size_10'] > 0){ $s10 = 0; }else{ $s10 = 1; }
          if($pilih3['size_11'] > 0){ $s11 = 0; }else{ $s11 = 1; }
          if($pilih3['size_12'] > 0){ $s12 = 0; }else{ $s12 = 1; }
          if($pilih3['size_13'] > 0){ $s13 = 0; }else{ $s13 = 1; }
          if($pilih3['size_14'] > 0){ $s14 = 0; }else{ $s14 = 1; }
          if($pilih3['size_15'] > 0){ $s15 = 0; }else{ $s15 = 1; }
          if($pilih3['size_16'] > 0){ $s16 = 0; }else{ $s16 = 1; }
          if($pilih3['size_17'] > 0){ $s17 = 0; }else{ $s17 = 1; }
          if($pilih3['size_18'] > 0){ $s18 = 0; }else{ $s18 = 1; }
          if($pilih3['size_19'] > 0){ $s19 = 0; }else{ $s19 = 1; }
          
          $total_hide = 20 - ($s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + 
              $s13 + $s14 + $s15 + $s16 + $s17 + $s18 + $s19);
          echo $total_hide;
        ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>TOTAL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>CBM</center></th>
    </tr>
    <tr>
        <th style="background-color:#20B2AA; color: #ffffff"><center>FR</center></th>
        <th style="background-color:#20B2AA; color: #ffffff"><center>TO</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;"><center>1</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_2'] == 0){ echo "none"; } ?>;"><center>2</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_3'] == 0){ echo "none"; } ?>;"><center>3</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_4'] == 0){ echo "none"; } ?>;"><center>4</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_5'] == 0){ echo "none"; } ?>;"><center>5</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_6'] == 0){ echo "none"; } ?>;"><center>6</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_7'] == 0){ echo "none"; } ?>;"><center>7</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_8'] == 0){ echo "none"; } ?>;"><center>8</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_9'] == 0){ echo "none"; } ?>;"><center>9</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_10'] == 0){ echo "none"; } ?>;"><center>10</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_11'] == 0){ echo "none"; } ?>;"><center>11</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_12'] == 0){ echo "none"; } ?>;"><center>12</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_13'] == 0){ echo "none"; } ?>;"><center>13</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_14'] == 0){ echo "none"; } ?>;"><center>14</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_15'] == 0){ echo "none"; } ?>;"><center>15</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_16'] == 0){ echo "none"; } ?>;"><center>16</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_17'] == 0){ echo "none"; } ?>;"><center>17</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_18'] == 0){ echo "none"; } ?>;"><center>18</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_19'] == 0){ echo "none"; } ?>;"><center>19</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no=1;
      foreach($data as $pilih){
        $no_to = $no+$pilih['karton']-1;
        $tot_cbm = $pilih['karton']*0.09;
    ?>
    <tr class="belang">
      <td align='center'><?= $no; ?></td>
      <td align='center'><?= $no_to; ?></td>
      <td align='center' ><?= $pilih['karton'] ?></td>
      <td align='center' ><?= $pilih['jumlah_size']/$pilih['karton'] ?></td>
      <td align='center' ><?= $pilih['label'] ?></td>
      <td align='center'><?= $pilih['style'] ?></td>
      <td align='center'><?= $pilih['warna']; ?></td>
      <td align='center' style="display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;"><?= $pilih['size_1'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_2'] == 0){ echo "none"; } ?>;"><?= $pilih['size_2'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_3'] == 0){ echo "none"; } ?>;"><?= $pilih['size_3'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_4'] == 0){ echo "none"; } ?>;"><?= $pilih['size_4'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_5'] == 0){ echo "none"; } ?>;"><?= $pilih['size_5'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_6'] == 0){ echo "none"; } ?>;"><?= $pilih['size_6'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_7'] == 0){ echo "none"; } ?>;"><?= $pilih['size_7'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_8'] == 0){ echo "none"; } ?>;"><?= $pilih['size_8'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_9'] == 0){ echo "none"; } ?>;"><?= $pilih['size_9'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_10'] == 0){ echo "none"; } ?>;"><?= $pilih['size_10'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_11'] == 0){ echo "none"; } ?>;"><?= $pilih['size_11'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_12'] == 0){ echo "none"; } ?>;"><?= $pilih['size_12'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_13'] == 0){ echo "none"; } ?>;"><?= $pilih['size_13'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_14'] == 0){ echo "none"; } ?>;"><?= $pilih['size_14'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_15'] == 0){ echo "none"; } ?>;"><?= $pilih['size_15'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_16'] == 0){ echo "none"; } ?>;"><?= $pilih['size_16'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_17'] == 0){ echo "none"; } ?>;"><?= $pilih['size_17'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_18'] == 0){ echo "none"; } ?>;"><?= $pilih['size_18'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_19'] == 0){ echo "none"; } ?>;"><?= $pilih['size_19'] ?></td>
      <td align='center'><?= $pilih['jumlah_size']; ?></td>
      <td align='center'><?= $tot_cbm ?></td>
    </tr>
      <?php 
         $total_1 += $pilih['size_1'];
         $total_2 += $pilih['size_2'];
         $total_3 += $pilih['size_3'];
         $total_4 += $pilih['size_4'];
         $total_5 += $pilih['size_5'];
         $total_6 += $pilih['size_6'];
         $total_7 += $pilih['size_7'];
         $total_8 += $pilih['size_8'];
         $total_9 += $pilih['size_9'];
         $total_10 += $pilih['size_10'];
         $total_11 += $pilih['size_11'];
         $total_12 += $pilih['size_12'];
         $total_13 += $pilih['size_13'];
         $total_14 += $pilih['size_14'];
         $total_15 += $pilih['size_15'];
         $total_16 += $pilih['size_16'];
         $total_17 += $pilih['size_17'];
         $total_18 += $pilih['size_18'];
         $total_19 += $pilih['size_19'];
        $totalsemua_1 += $pilih['size_1'];
        $totalsemua_2 += $pilih['size_2'];
        $totalsemua_3 += $pilih['size_3'];
        $totalsemua_4 += $pilih['size_4'];
        $totalsemua_5 += $pilih['size_5'];
        $totalsemua_6 += $pilih['size_6'];
        $totalsemua_7 += $pilih['size_7'];
        $totalsemua_8 += $pilih['size_8'];
        $totalsemua_9 += $pilih['size_9'];
        $totalsemua_10 += $pilih['size_10'];
        $totalsemua_11 += $pilih['size_11'];
        $totalsemua_12 += $pilih['size_12'];
        $totalsemua_13 += $pilih['size_13'];
        $totalsemua_14 += $pilih['size_14'];
        $totalsemua_15 += $pilih['size_15'];
        $totalsemua_16 += $pilih['size_16'];
        $totalsemua_17 += $pilih['size_17'];
        $totalsemua_18 += $pilih['size_18'];
        $totalsemua_19 += $pilih['size_19'];
        $total_cbm += $tot_cbm;
        $qty_total += $pilih['jumlah_size'];
        $qty_total_semua += $pilih['jumlah_size'];
        $jmlh_karton += $pilih['karton'];
        $tot_jmlh_karton += $pilih['karton'];
        $no += $pilih['karton'];
        }
      ?>
    <tr class="belang">
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' colspan='7' >Total QTY :</td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;"><?= $total_1 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_2'] == 0){ echo "none"; } ?>;"><?= $total_2 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_3'] == 0){ echo "none"; } ?>;"><?= $total_3 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_4'] == 0){ echo "none"; } ?>;"><?= $total_4 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_5'] == 0){ echo "none"; } ?>;"><?= $total_5 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_6'] == 0){ echo "none"; } ?>;"><?= $total_6 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_7'] == 0){ echo "none"; } ?>;"><?= $total_7 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_8'] == 0){ echo "none"; } ?>;"><?= $total_8 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_9'] == 0){ echo "none"; } ?>;"><?= $total_9 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_10'] == 0){ echo "none"; } ?>;"><?= $total_10 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_11'] == 0){ echo "none"; } ?>;"><?= $total_11 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_12'] == 0){ echo "none"; } ?>;"><?= $total_12 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_13'] == 0){ echo "none"; } ?>;"><?= $total_13 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_14'] == 0){ echo "none"; } ?>;"><?= $total_14 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_15'] == 0){ echo "none"; } ?>;"><?= $total_15 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_16'] == 0){ echo "none"; } ?>;"><?= $total_16 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_17'] == 0){ echo "none"; } ?>;"><?= $total_17 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_18'] == 0){ echo "none"; } ?>;"><?= $total_18 ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_19'] == 0){ echo "none"; } ?>;"><?= $total_19 ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $qty_total ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= number_format($total_cbm,2) ?></td>
    </tr>
    <tr>
      <td colspan=24>
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan=24>
        Total Karton : <?= $jmlh_karton ?> Karton
      </td>
    </tr>
  </tbody>
</table>
<br><center>
<hr width="100%" />
</center><br>
<?php
  $qty_total=0;
  $total_1 =0;
  $total_2 =0;
  $total_3 =0;
  $total_4 =0;
  $total_5 =0;
  $total_6 =0;
  $total_7 =0;
  $total_8 =0;
  $total_9 =0;
  $total_10 =0;
  $total_11 =0;
  $total_12 =0;
  $total_13 =0;
  $total_14 =0;
  $total_15 =0;
  $total_16 =0;
  $total_17 =0;
  $total_18 =0;
  $total_19 =0;
  $jmlh_karton =0;
  $total_cbm = 0;

?>
</center>

<?php }} ?>
<center><h3>Total Scan Semuanya : </h3></center>
<table border='1' class='table table-striped table-hover' width=100% cellpadding=6>
  <thead>
    <tr>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="
      <?php
        if($pilih3['size_ss'] > 0) { $sizeSS = 1; }else{ $sizeSS = 0; }
        if($pilih3['size_s'] > 0){ $sizeS = 1; }else{ $sizeS = 0; }
        if($pilih3['size_m'] > 0){ $sizeM = 1; }else{ $sizeM = 0; }
        if($pilih3['size_l'] > 0){ $sizeL = 1; }else{ $sizeL = 0; }
        if($pilih3['size_ll'] > 0){ $sizeLL = 1; }else{ $sizeLL = 0; }
        if($pilih3['size_3l'] > 0){ $size3L = 1; }else{ $size3L = 0; }
        if($pilih3['size_4l'] > 0){ $size4L = 1; }else{ $size4L = 0; }
        if($pilih3['size_5l'] > 0){ $size5L = 1; }else{ $size5L = 0; }
        if($pilih3['size_6l'] > 0){ $size6L = 1; }else{ $size6L = 0; }
        if($pilih3['size_7l'] > 0){ $size7L = 1; }else{ $size7L = 0; }
        if($pilih3['size_8l'] > 0){ $size8L = 1; }else{ $size8L = 0; }
        if($pilih3['size_1'] > 0){ $size1 = 1; }else{ $size1 = 0; }
        if($pilih3['size_2'] > 0){ $size2 = 1; }else{ $size2 = 0; }
        if($pilih3['size_3'] > 0){ $size3 = 1; }else{ $size3 = 0; }
        if($pilih3['size_4'] > 0){ $size4 = 1; }else{ $size4 = 0; }
        if($pilih3['size_5'] > 0){ $size5 = 1; }else{ $size5 = 0; }
        if($pilih3['size_6'] > 0){ $size6 = 1; }else{ $size6 = 0; }
        if($pilih3['size_7'] > 0){ $size7 = 1; }else{ $size7 = 0; }
        if($pilih3['size_8'] > 0){ $size8 = 1; }else{ $size8 = 0; }
        if($pilih3['size_9'] > 0){ $size9 = 1; }else{ $size9 = 0; }
        if($pilih3['size_10'] > 0){ $size10 = 1; }else{ $size10 = 0; }
        if($pilih3['size_11'] > 0){ $size11 = 1; }else{ $size11 = 0; }
        if($pilih3['size_12'] > 0){ $size12 = 1; }else{ $size12 = 0; }
        if($pilih3['size_13'] > 0){ $size13 = 1; }else{ $size13 = 0; }
        if($pilih3['size_14'] > 0){ $size14 = 1; }else{ $size14 = 0; }
        if($pilih3['size_15'] > 0){ $size15 = 1; }else{ $size15 = 0; }
        if($pilih3['size_16'] > 0){ $size16 = 1; }else{ $size16 = 0; }
        if($pilih3['size_17'] > 0){ $size17 = 1; }else{ $size17 = 0; }
        if($pilih3['size_18'] > 0){ $size18 = 1; }else{ $size18 = 0; }
        if($pilih3['size_19'] > 0){ $size19 = 1; }else{ $size19 = 0; }
         if($pilih3['size_w70'] > 0){ $w70 = 1; }else{ $w70 = 0; }
         if($pilih3['size_w73'] > 0){ $w73 = 1; }else{ $w73 = 0; }
         if($pilih3['size_w76'] > 0){ $w76 = 1; }else{ $w76 = 0; }
         if($pilih3['size_w79'] > 0){ $w79 = 1; }else{ $w79 = 0; }
         if($pilih3['size_w82'] > 0){ $w82 = 1; }else{ $w82 = 0; }
         if($pilih3['size_w85'] > 0){ $w85 = 1; }else{ $w85 = 0; }
         if($pilih3['size_w88'] > 0){ $w88 = 1; }else{ $w88 = 0; }
         if($pilih3['size_w90'] > 0){ $w90 = 1; }else{ $w90 = 0; }
         if($pilih3['size_w91'] > 0){ $w91 = 1; }else{ $w91 = 0; }
         if($pilih3['size_w95'] > 0){ $w95 = 1; }else{ $w95 = 0; }
         if($pilih3['size_w96'] > 0){ $w96 = 1; }else{ $w96 = 0; }
         if($pilih3['size_w100'] > 0){ $w100 = 1; }else{ $w100 = 0; }
         if($pilih3['size_w105'] > 0){ $w105 = 1; }else{ $w105 = 0; }
         if($pilih3['size_w106'] > 0){ $w106 = 1; }else{ $w106 = 0; }
         if($pilih3['size_w110'] > 0){ $w110 = 1; }else{ $w110 = 0; }
         if($pilih3['size_w115'] > 0){ $w115 = 1; }else{ $w115 = 0; }
         if($pilih3['size_w120'] > 0){ $w120 = 1; }else{ $w120 = 0; }
         if($pilih3['size_w125'] > 0){ $w125 = 1; }else{ $w125 = 0; }
         if($pilih3['size_w130'] > 0){ $w130 = 1; }else{ $w130 = 0; }
        $total_hide = $sizeSS + $sizeS + $sizeM + $sizeL + $sizeLL + $size3L + $size4L + $size5L + $size6L + $size7L + $size8L
                      + $size1 + $size2 + $size3 + $size4 + $size5 + $size6 + $size7 + $size8  + $size9 + $size10 + $size11 + $size12
                       + $size13 + $size14 + $size15 + $size16 + $size17 + $size18 + $size19 
                       + $w70 + $w73 + $w76
                      + $w79 + $w82 + $w85 + $w88 + $w90 + $w91 + $w95 + $w96 + $w100 + $w105 + $w106 + $w110
                      + $w115 + $w120 + $w125 + $w130;
        echo $total_hide; 
        ?>"><center>SIZE</center>
        <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>TOTAL</center></th>
      </th>
    </tr>
    <tr>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;"><center>SS</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_s'] == 0){ echo "none"; } ?>;"><center>S</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_m'] == 0){ echo "none"; } ?>;"><center>M</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_l'] == 0){ echo "none"; } ?>;"><center>L</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_ll'] == 0){ echo "none"; } ?>;"><center>LL</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_3l'] == 0){ echo "none"; } ?>;"><center>3L</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_4l'] == 0){ echo "none"; } ?>;"><center>4L</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_5l'] == 0){ echo "none"; } ?>;"><center>5L</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_6l'] == 0){ echo "none"; } ?>;"><center>6L</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_7l'] == 0){ echo "none"; } ?>;"><center>7L</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_8l'] == 0){ echo "none"; } ?>;"><center>8L</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;"><center>1</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_2'] == 0){ echo "none"; } ?>;"><center>2</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_3'] == 0){ echo "none"; } ?>;"><center>3</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_4'] == 0){ echo "none"; } ?>;"><center>4</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_5'] == 0){ echo "none"; } ?>;"><center>5</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_6'] == 0){ echo "none"; } ?>;"><center>6</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_7'] == 0){ echo "none"; } ?>;"><center>7</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_8'] == 0){ echo "none"; } ?>;"><center>8</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_9'] == 0){ echo "none"; } ?>;"><center>9</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_10'] == 0){ echo "none"; } ?>;"><center>10</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_11'] == 0){ echo "none"; } ?>;"><center>11</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_12'] == 0){ echo "none"; } ?>;"><center>12</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_13'] == 0){ echo "none"; } ?>;"><center>13</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_14'] == 0){ echo "none"; } ?>;"><center>14</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_15'] == 0){ echo "none"; } ?>;"><center>15</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_16'] == 0){ echo "none"; } ?>;"><center>16</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_17'] == 0){ echo "none"; } ?>;"><center>17</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_18'] == 0){ echo "none"; } ?>;"><center>18</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_19'] == 0){ echo "none"; } ?>;"><center>19</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><center>W70</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><center>W71</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><center>W72</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><center>W73</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><center>W74</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><center>W75</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><center>W76</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><center>W77</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><center>W78</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><center>W79</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><center>W80</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><center>W81</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><center>W82</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><center>W83</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><center>W84</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><center>W85</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><center>W86</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><center>W87</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><center>W88</center></th>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><center>W89</center></th>
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
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><center>W130</center></th>
      </tr>
  </thead>
  <tbody>
      <tr>
        <td align="center"><?= $style ?></td>
        <td align="center"><?= $warna ?></td>
        <td align="center" style="display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;"><?= $totalsemua_ss ?></td>
        <td align="center" style="display: <?php if($pilih3['size_s'] == 0){ echo "none"; } ?>;"><?= $totalsemua_s ?></td>
        <td align="center" style="display: <?php if($pilih3['size_m'] == 0){ echo "none"; } ?>;"><?= $totalsemua_m ?></td>
        <td align="center" style="display: <?php if($pilih3['size_l'] == 0){ echo "none"; } ?>;"><?= $totalsemua_l ?></td>
        <td align="center" style="display: <?php if($pilih3['size_ll'] == 0){ echo "none"; } ?>;"><?= $totalsemua_ll ?></td>
        <td align="center" style="display: <?php if($pilih3['size_3l'] == 0){ echo "none"; } ?>;"><?= $totalsemua_3l ?></td>
        <td align="center" style="display: <?php if($pilih3['size_4l'] == 0){ echo "none"; } ?>;"><?= $totalsemua_4l ?></td>
        <td align="center" style="display: <?php if($pilih3['size_5l'] == 0){ echo "none"; } ?>;"><?= $totalsemua_5l ?></td>
        <td align="center" style="display: <?php if($pilih3['size_6l'] == 0){ echo "none"; } ?>;"><?= $totalsemua_6l ?></td>
        <td align="center" style="display: <?php if($pilih3['size_7l'] == 0){ echo "none"; } ?>;"><?= $totalsemua_7l ?></td>
        <td align="center" style="display: <?php if($pilih3['size_8l'] == 0){ echo "none"; } ?>;"><?= $totalsemua_8l ?></td>
        <td align="center" style="display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;"><?= $totalsemua_1 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_2'] == 0){ echo "none"; } ?>;"><?= $totalsemua_2 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_3'] == 0){ echo "none"; } ?>;"><?= $totalsemua_3 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_4'] == 0){ echo "none"; } ?>;"><?= $totalsemua_4 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_5'] == 0){ echo "none"; } ?>;"><?= $totalsemua_5 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_6'] == 0){ echo "none"; } ?>;"><?= $totalsemua_6 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_7'] == 0){ echo "none"; } ?>;"><?= $totalsemua_7 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_8'] == 0){ echo "none"; } ?>;"><?= $totalsemua_8 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_9'] == 0){ echo "none"; } ?>;"><?= $totalsemua_9 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_10'] == 0){ echo "none"; } ?>;"><?= $totalsemua_10 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_11'] == 0){ echo "none"; } ?>;"><?= $totalsemua_11 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_12'] == 0){ echo "none"; } ?>;"><?= $totalsemua_12 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_13'] == 0){ echo "none"; } ?>;"><?= $totalsemua_13 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_14'] == 0){ echo "none"; } ?>;"><?= $totalsemua_14 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_15'] == 0){ echo "none"; } ?>;"><?= $totalsemua_15 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_16'] == 0){ echo "none"; } ?>;"><?= $totalsemua_16 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_17'] == 0){ echo "none"; } ?>;"><?= $totalsemua_17 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_18'] == 0){ echo "none"; } ?>;"><?= $totalsemua_18 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_19'] == 0){ echo "none"; } ?>;"><?= $totalsemua_19 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $total_w70 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><?= $total_w71 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><?= $total_w72 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><?= $total_w73 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><?= $total_w74 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><?= $total_w75 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><?= $total_w76 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><?= $total_w77 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><?= $total_w78 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><?= $total_w79 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><?= $total_w80 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><?= $total_w81 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><?= $total_w82 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><?= $total_w83 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><?= $total_w84 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><?= $total_w85 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><?= $total_w86 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><?= $total_w87 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><?= $total_w88 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><?= $total_w89 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><?= $total_w90 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><?= $total_w91 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><?= $total_w95 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><?= $total_w96 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><?= $total_w100 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><?= $total_w105 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><?= $total_w106 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><?= $total_w110 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><?= $total_w115 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><?= $total_w120 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><?= $total_w125 ?></td>
        <td align="center" style="display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><?= $total_w130 ?></td>
        <td align="center" ><?= $qty_total_semua ?></td>

      <tr>
  </tbody>
</table>
<br>
<table width="100%" style="background-color:yellow; font-weight:bold">
    <tr>
        <td>    
            Jumlah Barang dalam PCS :<?php echo $qty_total_semua; ?> PCS 
        </td>
        <td  align="right">    
            
        </td>
    </tr>
    <tr>
        <td>    
            Jumlah Karton : <?=$tot_jmlh_karton;?> Karton
        </td>
        <td align="right">    
          
        </td>
    </tr>
</tr>
</table>
  
 </td>
</tr>
 </table>
</body>

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

  <center><h1>PT. FGX INDONESIA</h1>
  <h3>LAPORAN SCAN PACKING</h3>
  </center>
  <br>

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
  $total_0 =0;
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
  $subtotal =0;
  $qty_total=0;
  $qty_total_semua=0;
  $no_karton2=0;
  $no_karton3=0;
  $ctk =array(); 
  $laporan = tampilkan_laporan_packing_orc_full();
    while($pilih = mysqli_fetch_array($laporan)){
      $ctk[$pilih['orc']][$pilih['no_po']][$pilih['label']][$pilih['style']][$pilih['warna']][$pilih['kelompok_size']][]=array(
        'tanggal'=>$pilih['tanggal'],
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
        'size_0'=>$pilih['size_0'],
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

    foreach($ctk as $orc=>$po)
    foreach($po as $no_po=>$kode_label)
    foreach($kode_label as $label=>$kode_style)
    foreach($kode_style as $style=>$color)
    foreach($color as $warna=>$kelompok)
    foreach($kelompok as $kelompoksize=>$data){
 ?>

<table class='hlap' width='100%' >
  <tr>
    <td width='10%'>Style</td><td width='1%'>:</td><td width='20%' align='left'><?= $style. ' ( ' .$warna ?> ) </td>
    <td width='55%'></td>
    <td width='5%'>No PO</td><td width='1%'>:</td><td width='20%' align='left'><?= $no_po ?></td>
  </tr>
  <tr>
    <td width='10%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='20%' align='left'></td>
    <td width='55%'></td>
    <td width='5%'>Label</td><td width='1%'>:</td><td width='20%' align='left'><?= $label ?></td>
  </tr>
</table>

<?php 
  $laporan2 = tampilkan_laporan_packing_orc_full_hidesize();
  $pilih3 = mysqli_fetch_array($laporan2);
  if($kelompoksize == 'a'){
?>
<table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
  <thead>
  <tr>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Karton</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Scan</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Tanggal Scan</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
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
      $no=0;       
      foreach($data as $pilih){
      $no++; 
    ?>
    <tr class="belang">
      <td align='center'><?= $no ?></td>
      <td align='center'><?= $pilih['no_karton'] ?></td>
      <td align='center'><?= tgl_indonesia3($pilih['tanggal']) ?> </td>
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
        $total_8l += $pilih['size_8l'];
        $qty_total += $pilih['jumlah_size'];
        $qty_total_semua += $pilih['jumlah_size'];      
      }
    ?>
    <tr class="belang">
      <td colspan="6" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
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
      <td colspan=16>
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan=16>
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
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Tanggal Scan</center></th>
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
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>QTY/CTN</center></th>
  </tr>
  <tr>
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
      $no=0;       
      foreach($data as $pilih){
      $no++; 
    ?>
    <tr class="belang">
      <td align='center'><?= $no ?></td>
      <td align='center'><?= $pilih['no_karton'] ?></td>
      <td align='center'><?= tgl_indonesia3($pilih['tanggal']) ?> </td>
      <td align='center'><?= $pilih['label'] ?></td>
      <td align='center'><?= $pilih['style'] ?></td>
      <td align='center'><?= $pilih['warna'] ?></td>
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
      <td align='center'><?= $pilih['jumlah_size'] ?></td>
    </tr>
    
      <?php
        $no_karton2++;
        $no_karton3++;
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
        $qty_total += $pilih['jumlah_size'];
        $qty_total_semua += $pilih['jumlah_size'];      
      }
    ?>
    <tr class="belang">
      <td colspan="6" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
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
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><?= $total_w81 ?></td>
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
      <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
    </tr>
    <tr>
      <td colspan=24>
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan=24>
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
  $no_karton2=0;

?>
</center>
  
<?php }elseif ($kelompoksize == 'c') { ?>
  
  <table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
  <thead>
  <tr>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Karton</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Scan</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>Tanggal Scan</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" colspan="
    <?php 
       if($pilih3['size_0'] > 0){ $s0 = 0; }else{ $s0 = 1; }
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
       
       $total_hide = 21 - ($s0 + $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + 
           $s13 + $s14 + $s15 + $s16 + $s17 + $s18 + $s19);
       echo $total_hide;
     ?>"><center>SIZE</center></th>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>QTY/CTN</center></th>
  </tr>
  <tr>
        <th style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_0'] == 0){ echo "none"; } ?>;"><center>FREE</center></th>
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
      $no=0;       
      foreach($data as $pilih){
      $no++; 
    ?>
    <tr class="belang">
      <td align='center'><?= $no ?></td>
      <td align='center'><?= $pilih['no_karton'] ?></td>
      <td align='center'><?= tgl_indonesia3($pilih['tanggal']) ?> </td>
      <td align='center'><?= $pilih['label'] ?></td>
      <td align='center'><?= $pilih['style'] ?></td>
      <td align='center'><?= $pilih['warna'] ?></td>
      <td align='center' style="display: <?php if($pilih3['size_0'] == 0){ echo "none"; } ?>;"><?= $pilih['size_0'] ?></td>
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
      <td align='center'><?= $pilih['jumlah_size'] ?></td>
    </tr>
    
      <?php
        $no_karton2++;
        $no_karton3++;
        $total_0 += $pilih['size_0'];
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
        $qty_total += $pilih['jumlah_size'];
        $qty_total_semua += $pilih['jumlah_size'];      
      }
    ?>
    <tr class="belang">
      <td colspan="6" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; display: <?php if($pilih3['size_1'] == 0){ echo "none"; } ?>;"><?= $total_0 ?></td>
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
      <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
    </tr>
    <tr>
      <td colspan=24>
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan=24>
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
  $total_0 =0;
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
  $no_karton2=0;

?>
</center>

<?php } } ?> 



  TOTAL SCAN ORC : <?= $orc ?> - ( PO : <?= $no_po ?> - Label : <?= $label ?> ) - STYLE : <?= $style ?> Semuanya : <br>
  Jumlah Barang dalam PCS :<?= $qty_total_semua; ?> PCS 
  </br>
  Jumlah Karton : <?= $no_karton3; ?> Karton
 


</body>


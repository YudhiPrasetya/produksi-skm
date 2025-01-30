<?php require_once 'core/init.php'; 
 $tgl = $_POST['tgl'];
 $orc = $_POST['orc'];
 $costomer = $_POST['costomer'];
 $style = $_POST['style'];
 $no_po = $_POST['no_po'];
 $var_sumsize = $_POST['var_sumsize'];


?>

<center>
  <head>
  <title>LAPORAN SCAN PACKING</title>
  <link rel="icon" href="img/skm_icon.png">
  </head>
  <h3>LAPORAN SCAN PACKING</h3>
  
  <h4>
    <?php if($orc != ''){
        echo "ORC : ".$orc;
    }
    
    ?>
    </h4>
  </center>
  <br>


<?php
   
   


   $ListSize = tampilkan_size_transaksi_packing($tgl, $orc, $costomer, $no_po, $style);
   while($size = mysqli_fetch_array($ListSize)){
      ${$size['total_size']} = 0;
   }
 
   
    $subtotal =0;
    $qty_total=0;
    $qty_total_semua=0;
    $no_karton2=0;
    $no_karton3=0;
    $tot_jmlh_karton2 = 0;
    $tot_jmlh_karton3 = 0;

    if(cek_jumlah_size_packing_notmix($tgl, $orc, $costomer, $no_po, $style) != 0){
     
      $laporan = tampilkan_laporan_stok_packing($tgl, $orc, $costomer, $no_po, $style);
      while($pilih = mysqli_fetch_array($laporan)){
          
          $ctk[$pilih['orc']][$pilih['no_po']][$pilih['style']][$pilih['color']][$pilih['costomer']][$pilih['label']][]=array(
              'orc'=>$pilih['orc']
            
              
            );                                            
      }
      foreach($ctk as $orc2=>$no_po2)
      foreach($no_po2 as $po=>$kd_style)
      foreach($kd_style as $style2=>$kdcolor)
      foreach($kdcolor as $color=>$kdcostomer)
      foreach($kdcostomer as $costomer=>$kdlabel)
      foreach($kdlabel as $label=>$data){
      // print_r($ctk);
?>


<table class='hlap' width='100%' >
<tr>
    <td width='10%'>ORC</td><td width='1%'>:</td><td width='20%' align='left'><?= $orc2 ?>  </td>
    <td width='55%'></td>
    <td width='5%'>COSTOMER</td><td width='1%'>:</td><td width='20%' align='left'><?= $costomer ?></td>
  </tr>

  <tr>
    <td width='10%'>Style</td><td width='1%'>:</td><td width='20%' align='left'><?= $style2. ' ( ' .$color ?> ) </td>
    <td width='55%'></td>
    <td width='5%'>No PO</td><td width='1%'>:</td><td width='20%' align='left'><?= $po ?></td>
  </tr>
  <tr>
    <td width='10%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='20%' align='left'></td>
    <td width='55%'></td>
    <td width='5%'>Label</td><td width='1%'>:</td><td width='20%' align='left'><?= $label ?></td>
  </tr>
</table>

<table  border='1' class='table table-striped table-hover' width=100% cellpadding="2px"; cellspacing="0" style="font-size: 13px;">
  <thead>
    <tr>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>NO CTN</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>NO SCAN</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>TGL SCAN</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="<?= cek_jumlah_size_orc($tgl, $orc2); ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>QTY</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>KET CTN</center></th>
    </tr>
    <tr>
        <?php $ListSize2 = tampilkan_size_transaksi_packing_orc($tgl, $orc2); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
          <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
        <?php } ?>
        <th style="background-color:#20B2AA; color: #ffffff"><center>CTN</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=0; 
        $laporan2 = tampilkan_laporan_stok_packing2($tgl, $orc2, $var_sumsize);
      while($pilih2 = mysqli_fetch_array($laporan2)){      
        // foreach($data as $pilih){
        $no++; 
      ?>
    <tr class="belang">
      <td align='center'><?= $no ?></td>
      <td align='center'><?= $pilih2['no_trx'] ?></td>
      <td align='center'><?= tgl_indonesia3($pilih2['tanggal']) ?></td>
      <td align='center'><?= $pilih2['label'] ?></td>
      <td align='center'><?= $pilih2['style'] ?></td>
      <td align='center'><?= $pilih2['warna'] ?></td>
        <?php $ListSize2 = tampilkan_size_transaksi_packing_orc($tgl, $orc2); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
      <td align='center'><?= $pilih2[$size2['detail_size']]; ?> 
        <?php 
          ${$size2['total_size']} +=  $pilih2[$size2['detail_size']];
        ?>
    </td>
        <?php } ?>
        <td align='center'><?= $pilih2['jumlah_size'] ?></td>
        <td align='center'><?php 
          if($pilih2['kelompok'] == 'full'){
            echo 'FULL';
          }elseif($pilih2['kelompok'] == 'ecer'){
            echo 'NOT FULL';
          }elseif($pilih2['kelompok'] == 'mix'){
            echo 'MIX SIZE';
          }elseif($pilih2['kelompok'] == 'mix_color'){
            echo 'MIX COLOR';
          }elseif($pilih2['kelompok'] == 'mix_style'){
            echo 'MIX STYLE';
          } ?></td>
    </tr>
    <?php
        $no_karton2++;
        $no_karton3++;
        $qty_total += $pilih2['jumlah_size'];
        $qty_total_semua += $pilih2['jumlah_size'];
      }      
      ?>
    <tr class="belang">
      <td colspan="6" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
      <?php 
        $ListSize2 = tampilkan_size_transaksi_packing_orc($tgl, $orc2); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= ${$size2['total_size']} ?></td>
      <?php } ?>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; "></td>
    </tr> 
    <tr>
      <td colspan="<?php $total_size = cek_jumlah_size_orc($tgl, $orc2) + 8; echo $total_size;  ?>">
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan="<?php $total_size = cek_jumlah_size_orc($tgl, $orc2) + 8; echo $total_size;  ?>">
        Total Karton : <?= $no_karton2 ?> Karton
      </td>
    </tr>
   
    </table>
    <?php 
      $qty_total=0;
      $ListSize = tampilkan_size_transaksi_packing($tgl, $orc, $costomer, $no_po, $style);
      while($size = mysqli_fetch_array($ListSize)){
          ${$size['total_size']} = 0;
      }
      $no_karton2=0;

    ?>
    <br>

   
<?php } } ?>

<?php if(cek_jumlah_size_packing_mix_color($tgl, $orc, $costomer, $no_po, $style) != 0){ ?>
  <center><h3>TRANSAKSI MIX COLOR</h3></center>
<?php
    $no2 = 0;
    
    $laporan3 = tampilkan_laporan_stok_packing_mix_color($tgl, $orc, $costomer, $no_po, $style);
    $no2++;
    while($pilih3 = mysqli_fetch_array($laporan3)){
        $no_trx2 = $pilih3['no_trx'];
        $costomer2 = $pilih3['costomer'];
        $po2 = $pilih3['no_po'];
    ?>

<table class='hlap' width='100%' >
<tr>
    <td width='10%'>NO TRX</td><td width='1%'>:</td><td width='20%' align='left'><?= $no_trx2 ?> ( MIX COLOR )</td>
    <td width='55%'></td>
    <td width='5%'>COSTOMER</td><td width='1%'>:</td><td width='20%' align='left'><?= $costomer2 ?></td>
  </tr>

  <tr>
    <td width='10%'>STYLE</td><td width='1%'>:</td><td width='20%' align='left'><?= $pilih3['style']; ?></td>
    <td width='55%'></td>
    <td width='5%'>NO PO</td><td width='1%'></td><td width='20%' align='left'><?= $po2 ?></td>
  </tr>
  <tr>
    <td width='10%'><b>Detail</b></td><td width='1%'>:</td><td width='20%' align='left'></td>
    <td width='55%'></td>
    <td width='5%'></td><td width='1%'>:</td><td width='20%' align='left'></td>
  </tr>
</table>

<table  border='1' class='table table-striped table-hover' width=100% cellpadding="2px"; cellspacing="0" style="font-size: 13px;">
  <thead>
    <tr>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2" ><center>NO KARTON</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>ORC</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="<?= cek_jumlah_size_notrx_packing_mixcolor($tgl, $orc, $costomer, $no_po, $style, $no_trx2); ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>QTY</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>KET CTN</center></th>
    </tr>
    <tr>
        <?php $ListSize2 = tampilkan_size_transaksi_packing_mixcolor($tgl, $orc, $costomer, $no_po, $style, $no_trx2); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
          <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
        <?php } ?>
        <th style="background-color:#20B2AA; color: #ffffff"><center>CTN</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
          $no=1;       
        $laporan4 = tampilkan_laporan_stok_packing_mix_color2($tgl, $orc, $costomer, $no_po, $style, $no_trx2, $var_sumsize);
        while($pilih4 = mysqli_fetch_array($laporan4)){
      
        $no_to = $no+$pilih4['karton']-1;
      
      ?>
    <tr class="belang">
      <td align='center'><?= $no; ?></td>
      <td align='center'><?=  $pilih4['orc']; ?></td>
      <td align='center'><?= $pilih4['label'] ?></td>
      <td align='center'><?= $pilih4['style'] ?></td>
      <td align='center'><?= $pilih4['warna'] ?></td>
      <?php $ListSize2 = tampilkan_size_transaksi_packing_mixcolor($tgl, $orc, $costomer, $no_po, $style, $no_trx2); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
      <td align='center'><?= $pilih4[$size2['detail_size']]; ?> 
        <?php 
          ${$size2['total_size']} +=  $pilih4[$size2['detail_size']];
        ?>
    </td>
        <?php } ?>
        <td align='center'><?= $pilih4['jumlah_size'] ?></td>
        <td align='center'><?php 
          if($pilih4['kelompok'] == 'full'){
            echo 'FULL';
          }elseif($pilih4['kelompok'] == 'ecer'){
            echo 'NOT FULL';
          }elseif($pilih4['kelompok'] == 'mix'){
            echo 'MIX SIZE';
          }elseif($pilih4['kelompok'] == 'mix_color'){
            echo 'MIX COLOR';
          }elseif($pilih4['kelompok'] == 'mix_style'){
            echo 'MIX STYLE';
          } ?></td>
    </tr>
    <?php
       
       $qty_total += $pilih4['jumlah_size'];
       $qty_total_semua += $pilih4['jumlah_size'];
       $jmlh_karton = $no;
      
   } ?>
    <tr>
        <td colspan="5" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
        <?php 
            $ListSize2 = tampilkan_size_transaksi_packing_mixcolor($tgl, $orc, $costomer, $no_po, $style, $no_trx2); 
            while($size2 = mysqli_fetch_array($ListSize2)){ ?>
        <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= ${$size2['total_size']} ?></td>
        <?php } ?>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "></td>
    </tr> 
    <tr>
        <td colspan="<?php $total_size = cek_jumlah_size_notrx_packing_mixcolor($tgl, $orc, $costomer, $no_po, $style, $no_trx2) + 8; echo $total_size;  ?>">
          TOTAL QUANTITY : <?= $qty_total ?> PCS
        </td>
    </tr>
        <tr>
            <td colspan="<?php $total_size = cek_jumlah_size_notrx_packing_mixcolor($tgl, $orc, $costomer, $no_po, $style, $no_trx2) + 8; echo $total_size;  ?>">
                TOTAL CARTON : <?= $jmlh_karton ?> CTN
            </td>
    </tr>
  <?php 
  $tot_jmlh_karton2 += $no2;
  $qty_total=0;
  $jmlh_karton=0;
  
  $ListSize = tampilkan_size_transaksi_packing($tgl, $orc, $costomer, $no_po, $style);
  while($size = mysqli_fetch_array($ListSize)){
      ${$size['total_size']} = 0;
  }
  $no_karton2=0;

?>
  </tbody>
</table>     

 <?php } } ?>  


 <?php if(cek_jumlah_size_packing_mix_style($tgl, $orc, $costomer, $no_po, $style) != 0){ ?>
  <center><h3>TRANSAKSI MIX STYLE </h3></center>
<?php
    $no3 = 0;
    
    $laporan5 = tampilkan_laporan_stok_packing_mix_style($tgl, $orc, $costomer, $no_po, $style);
    $no3++;
    while($pilih5 = mysqli_fetch_array($laporan5)){
        $no_trx3 = $pilih5['no_trx'];
        $costomer3 = $pilih5['costomer'];
        $po3 = $pilih5['no_po'];
    ?>

<table class='hlap' width='100%' >
<tr>
    <td width='10%'>NO TRX</td><td width='1%'>:</td><td width='20%' align='left'><?= $no_trx3 ?> ( MIX STYLE )</td>
    <td width='55%'></td>
    <td width='5%'>COSTOMER</td><td width='1%'>:</td><td width='20%' align='left'><?= $costomer3 ?></td>
  </tr>

  <tr>
    <td width='10%'>STYLE</td><td width='1%'>:</td><td width='20%' align='left'>MIX STYLE</td>
    <td width='55%'></td>
    <td width='5%'>NO PO</td><td width='1%'></td><td width='20%' align='left'><?= $po3 ?></td>
  </tr>
  <tr>
    <td width='10%'><b>Detail</b></td><td width='1%'>:</td><td width='20%' align='left'></td>
    <td width='55%'></td>
    <td width='5%'></td><td width='1%'>:</td><td width='20%' align='left'></td>
  </tr>
</table>

<table  border='1' class='table table-striped table-hover' width=100% cellpadding="2px"; cellspacing="0" style="font-size: 13px;">
  <thead>
    <tr>
    <th style="background-color:#20B2AA; color: #ffffff" rowspan="2" ><center>NO KARTON</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>ORC</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>LABEL</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>STYLE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>COLOR</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" colspan="<?= cek_jumlah_size_notrx_packing_mixstyle($tgl, $orc, $costomer, $no_po, $style, $no_trx3); ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>QTY</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>KET CTN</center></th>
    </tr>
    <tr>
        <?php $ListSize2 = tampilkan_size_transaksi_packing_mixstyle_notrx($tgl, $orc, $costomer, $no_po, $style, $no_trx3); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
          <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
        <?php } ?>
        <th style="background-color:#20B2AA; color: #ffffff"><center>CTN</center></th>
        
    </tr>
  </thead>
  <tbody>
    <?php
          $no4=1;       
        $laporan4 = tampilkan_laporan_stok_packing_mix_style2($tgl, $orc, $costomer, $no_po, $style, $no_trx3, $var_sumsize);
        while($pilih4 = mysqli_fetch_array($laporan4)){
      
        $no_to = $no4+$pilih4['karton']-1;
      
      ?>
    <tr class="belang">
      <td align='center'><?= $no; ?></td>
      <td align='center'><?=  $pilih4['orc']; ?></td>
      <td align='center'><?= $pilih4['label'] ?></td>
      <td align='center'><?= $pilih4['style'] ?></td>
      <td align='center'><?= $pilih4['warna'] ?></td>
      <?php $ListSize2 = tampilkan_size_transaksi_packing_mixstyle_notrx($tgl, $orc, $costomer, $no_po, $style, $no_trx3); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
      <td align='center'><?= $pilih4[$size2['detail_size']]; ?> 
        <?php 
          ${$size2['total_size']} +=  $pilih4[$size2['detail_size']];
        ?>
    </td>
        <?php } ?>
        <td align='center'><?= $pilih4['jumlah_size'] ?></td>
        <td align='center'><?php 
          if($pilih4['kelompok'] == 'full'){
            echo 'FULL';
          }elseif($pilih4['kelompok'] == 'ecer'){
            echo 'NOT FULL';
          }elseif($pilih4['kelompok'] == 'mix'){
            echo 'MIX SIZE';
          }elseif($pilih4['kelompok'] == 'mix_color'){
            echo 'MIX COLOR';
          }elseif($pilih4['kelompok'] == 'mix_style'){
            echo 'MIX STYLE';
          } ?></td>
    </tr>
    <?php
       
       $qty_total += $pilih4['jumlah_size'];
       $qty_total_semua += $pilih4['jumlah_size'];
       $jmlh_karton = $no4;
      
   } ?>
    <tr>
        <td colspan="5" style="background-color:#20B2AA; color: #ffffff; align=center">Total QTY :</td>
        <?php 
            $ListSize2 = tampilkan_size_transaksi_packing_mixstyle_notrx($tgl, $orc, $costomer, $no_po, $style, $no_trx3); 
            while($size2 = mysqli_fetch_array($ListSize2)){ ?>
        <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= ${$size2['total_size']} ?></td>
        <?php } ?>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
        <td align="center" style="background-color:#20B2AA; color: #ffffff; "></td>
    </tr> 
    <tr>
        <td colspan="<?php $total_size = cek_jumlah_size_notrx_packing_mixstyle($tgl, $orc, $costomer, $no_po, $style, $no_trx3) + 8; echo $total_size;  ?>">
          TOTAL QUANTITY : <?= $qty_total ?> PCS
        </td>
    </tr>
        <tr>
            <td colspan="<?php $total_size = cek_jumlah_size_notrx_packing_mixstyle($tgl, $orc, $costomer, $no_po, $style, $no_trx3) + 8; echo $total_size;  ?>">
                TOTAL CARTON : <?= $jmlh_karton ?> CTN
            </td>
    </tr>
  <?php 
  $tot_jmlh_karton3 += $no3;
  $qty_total=0;
  $jmlh_karton=0;
  
  $ListSize = tampilkan_size_transaksi_packing($tgl, $orc, $costomer, $no_po, $style);
  while($size = mysqli_fetch_array($ListSize)){
      ${$size['total_size']} = 0;
  }
  $no_karton2=0;

?>
  </tbody>
</table>     
 <?php } } ?>  
 
<br>
TOTAL SCAN Semuanya : <br>
  Jumlah Barang dalam PCS :<?= $qty_total_semua; ?> PCS 
  </br>
  Jumlah Karton : <?php $total_ctn = $no_karton3 + $tot_jmlh_karton2 + $tot_jmlh_karton3; echo $total_ctn; ?> Karton




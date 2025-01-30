<?php require_once 'core/init.php'; 
 $tgl = $_POST['tgl'];
 $costomer = $_POST['costomer'];
 $var_sumsize = $_POST['var_sumsize'];


?>

<center>
  <title>LAPORAN SCAN PACKING</title>
  <h3>LAPORAN SCAN PACKING</h3>
  
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
    
    $laporan = tampilkan_laporan_stok_packing($tgl, $orc, $costomer, $no_po, $style);
    while($pilih = mysqli_fetch_array($laporan)){
        
        $ctk[$pilih['orc']][$pilih['no_po']][$pilih['style']][$pilih['color']][$pilih['costomer']][$pilih['label']][]=array(
            'orc'=>$pilih['orc']
           
            
          );                                            
    }
    foreach($ctk as $orc=>$no_po)
    foreach($no_po as $po=>$kd_style)
    foreach($kd_style as $style=>$kdcolor)
    foreach($kdcolor as $color=>$kdcostomer)
    foreach($kdcostomer as $costomer=>$kdlabel)
    foreach($kdlabel as $label=>$data){
      // print_r($ctk);
?>


<table class='hlap' width='100%' >
<tr>
    <td width='10%'>ORC</td><td width='1%'>:</td><td width='20%' align='left'><?= $orc ?>  </td>
    <td width='55%'></td>
    <td width='5%'>COSTOMER</td><td width='1%'>:</td><td width='20%' align='left'><?= $costomer ?></td>
  </tr>

  <tr>
    <td width='10%'>Style</td><td width='1%'>:</td><td width='20%' align='left'><?= $style. ' ( ' .$color ?> ) </td>
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
      <th style="background-color:#20B2AA; color: #ffffff" colspan="<?= cek_jumlah_size_orc($tgl, $orc); ?>"><center>SIZE</center></th>
      <th style="background-color:#20B2AA; color: #ffffff"><center>QTY</center></th>
    </tr>
    <tr>
        <?php $ListSize2 = tampilkan_size_transaksi_packing_orc($tgl, $orc); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
          <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
        <?php } ?>
        <th style="background-color:#20B2AA; color: #ffffff"><center>CTN</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=0; 
        $laporan2 = tampilkan_laporan_stok_packing2($tgl, $orc, $var_sumsize);
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
        <?php $ListSize2 = tampilkan_size_transaksi_packing_orc($tgl, $orc); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
      <td align='center'><?= $pilih2[$size2['detail_size']]; ?> 
        <?php 
          ${$size2['total_size']} +=  $pilih2[$size2['detail_size']];
        ?>
    </td>
        <?php } ?>
        <td align='center'><?= $pilih2['jumlah_size'] ?></td>
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
        $ListSize2 = tampilkan_size_transaksi_packing_orc($tgl, $orc); 
        while($size2 = mysqli_fetch_array($ListSize2)){ ?>
      <td align="center" style="background-color:#20B2AA; color: #ffffff;"><?= ${$size2['total_size']} ?></td>
      <?php } ?>
      <td align="center" style="background-color:#20B2AA; color: #ffffff; "><?= $qty_total ?></td>
    </tr> 
    <tr>
      <td colspan="<?php $total_size = cek_jumlah_size_orc($tgl, $orc) + 7; echo $total_size;  ?>">
        Total Quantity : <?= $qty_total ?> PCS
      </td>
    </tr>
    <tr>
      <td colspan="<?php $total_size = cek_jumlah_size_orc($tgl, $orc) + 7; echo $total_size;  ?>">
        Total Karton : <?= $no_karton2 ?> Karton
      </td>
    </tr>
   
    </table>
    <?php 
      $qty_total=0;
      $ListSize2 = tampilkan_size_transaksi_packing_orc($tgl, $orc); 
        while($size2 = mysqli_fetch_array($ListSize2)){
          ${$size2['total_size']} = 0;
        }  
      $no_karton2=0;

    ?>
    <br>

   
<?php } ?>
TOTAL SCAN Semuanya : <br>
  Jumlah Barang dalam PCS :<?= $qty_total_semua; ?> PCS 
  </br>
  Jumlah Karton : <?= $no_karton3; ?> Karton

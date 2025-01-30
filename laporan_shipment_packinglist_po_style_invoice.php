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
  $po=$_POST['no_po3'];
  $style=$_POST['style3'];

  $style = substr($style,0,3);
  $laporan2 = tampilkan_laporan_packing_po_style($po, $style);
  $data = mysqli_fetch_assoc($laporan2);

  $invoice=$_POST['invoice'];
  $laporan4 = tampilkan_master_shipment_id($invoice);
  $data4 = mysqli_fetch_assoc($laporan4);
?>

<center><h1>PT. GLOBALINDO INTIMATES</h1>
<h3>LAPORAN PACKING LIST</h3>
<h4>Nomer Purchasing Order : <?= $data['no_po']; ?> - STYLE : <?= $style; ?></h4>  
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
  $subtotal =0;
  $qty_total=0;
  $qty_total_semua=0;
  $no_karton2=0;
  $no_karton3=0;
  $ctk =array();
    $laporan = tampilkan_laporan_packinglist_perstyle_lengkap_invoice($po, $style, $invoice);
    while($pilih = mysqli_fetch_array($laporan)){
      $ctk[$pilih['style']][$pilih['warna']][$pilih['no_po']][$pilih['description']][]=array(
        'karton'=>$pilih['karton'],
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
        'size_7l'=>$pilih['size_7l']
  );      
} 
?>

<table border=1 width='100%' style="padding: 5px">
  <tr>
    <td>
<?php
  foreach($ctk as $style=>$color)
  foreach($color as $warna=>$po2)
  foreach($po2 as $no_po=>$desc)
  foreach($desc as $description=>$data){   
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
      <td width='12%'>Style</td><td width='1%'>:</td><td width='15%' align='left'><?= $style ?> </td>
      <td width='45%'></td>
      <td width='12%'>Customer</td><td width='1%'>:</td><td width='15%' align='left'>UNICO </td>
  </tr>
  <tr>
      <td width='12%'>PO No</td><td width='1%'>:</td><td width='15%' align='left'><?= $no_po ?></td>
      <td width='45%'></td>
      <td width='12%'>C/M</td><td width='1%'>:</td><td width='15%' align='left'>55 X 35 X 45 CM</td>
  </tr>
  <tr>
      <td width='12%'><b>Detail Transaksi</b></td><td width='1%'>:</td><td width='6%'></td>
      <td width='45%'></td>      
  </tr>
</table>

<table  border='1' class='table table-striped table-hover' width=100% cellpadding=6 >
  <thead>
    <tr>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No Karton</center></th>
      <th style="background-color:#20B2AA; color: #ffffff" rowspan="2"><center>No TRX</center></th>
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
      foreach($data as $pilih2){
      $no++;
    ?>
    <tr class="belang">
      <td align='center'><?php echo $no; ?></td>
      <td align='center'><?= $pilih2['no_karton']; ?></td>
      <td align='center'><?= tanggal_indo($pilih2['tanggal_scan'], false) ?></td>
      <td align='center'><?= $pilih2['style'] . ' ( ' . $pilih2['warna'] .' ) ' ?></td>
      <td align='center'><?= $pilih2['size_ss']; ?></td>
      <td align='center'><?= $pilih2['size_s']; ?></td>
      <td align='center'><?= $pilih2['size_m']; ?></td>
      <td align='center'><?= $pilih2['size_l']; ?></td>
      <td align='center'><?= $pilih2['size_ll']; ?></td>
      <td align='center'><?= $pilih2['size_3l']; ?></td>
      <td align='center'><?= $pilih2['size_4l']; ?></td>
      <td align='center'><?= $pilih2['size_5l']; ?></td>
      <td align='center'><?= $pilih2['size_6l']; ?></td>
      <td align='center'><?= $pilih2['size_7l']; ?></td>
      <td align='center'><?= $pilih2['jumlah_size']; ?></td>
    </tr>
      <?php 
        $total_ss += $pilih2['size_ss'];
        $total_s += $pilih2['size_s'];
        $total_m += $pilih2['size_m'];
        $total_l += $pilih2['size_l'];
        $total_ll += $pilih2['size_ll'];
        $total_3l += $pilih2['size_3l'];
        $total_4l += $pilih2['size_4l'];
        $total_5l += $pilih2['size_5l'];
        $total_6l += $pilih2['size_6l'];
        $total_7l += $pilih2['size_7l'];
        $qty_total += $pilih2['jumlah_size'];
        $qty_total_semua += $pilih2['jumlah_size'];
        $no_karton2++;
        $no_karton3++;
        }
      ?>
    <tr class="belang">
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' colspan='4' >Total QTY :</td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $total_ss ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $total_s ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $total_m ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_l ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_ll ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_3l ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_4l ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_5l ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_6l ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'> <?= $total_7l ?></td>
      <td style='background-color:#20B2AA; color: #ffffff; font-weight:bold' align='center'><?= $qty_total ?></td>
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
  $no_karton2=0;
}
?>
<br>
</center>
<?php
  $laporan = tampilkan_laporan_packing_po_style($po, $style);
  $data = mysqli_fetch_assoc($laporan) 
?>
<table width="100%" style="background-color:yellow; font-weight:bold">
    <tr>
        <td align="center" colspan="2">
        TOTAL SCAN PO : <?= $data['no_po']; ?> - STYLE : <?= substr($style,0,3) ?> Semuanya : <br>
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

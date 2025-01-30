<?php require_once 'core/init.php'; ?>
<!-- <body onLoad="window.print()"> -->
<title>Laporan PACKING LIST</title>

<?php
$po = $_POST['no_po'];
$style = $_POST['style'];
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
$karton = 0;
$laporan = tampilkan_laporan_packing_header($po, $style);
$data = mysqli_fetch_assoc($laporan)
?>
    <center><h1>PT. GLOBALINDO INTIMATES 2</h1>
    <h3>PACKING LIST</h3></center>

No Purchasing Order : <?php echo $data['no_po']; ?>
<br>
STYLE : <?php echo $data['style']; ?> ( <?php echo $data['warna']; ?> )
</center>

<br><br>
<center>
<table  border='1' class='table table-hover' width=100% cellpadding=6 >
<thead>
	<tr>
  <th style="background-color:#f4f4f4; "><center>No Karton</center></th>
		<th style="background-color:#f4f4f4; "><center>No TRX</center></th>
        <th style="background-color:#f4f4f4; "><center>Tanggal Scan</center></th>
        <th style="background-color:#f4f4f4; "><center>STYLE</center></th>
        <th style="background-color:#f4f4f4; "><center>SS</center></th>
        <th style="background-color:#f4f4f4; "><center>S</center></th>
        <th style="background-color:#f4f4f4; "><center>M</center></th>
        <th style="background-color:#f4f4f4; "><center>L</center></th>
        <th style="background-color:#f4f4f4; "><center>LL</center></th>
        <th style="background-color:#f4f4f4; "><center>3L</center></th>
          <th style="background-color:#f4f4f4; "><center>4L</center></th>
            <th style="background-color:#f4f4f4; "><center>5L</center></th>
            <th style="background-color:#f4f4f4; "><center>6L</center></th>
            <th style="background-color:#f4f4f4; "><center>7L</center></th>
        <th style="background-color:#f4f4f4; "><center>QTY/CTN</center></th>
  	</tr>
</thead>
<tbody>
		<?php
    $no=1;
    
    $laporan1 = tampilkan_laporan_packinglist($po, $style);
		while($pilih = mysqli_fetch_assoc($laporan1)){
		?>
	<tr>
    <td align='center'><?php echo $no; ?></td>
		<td align='center'><?php echo $pilih['no_karton'] ?></td>
    <td align='center'><?php echo tanggal_indo($pilih['tanggal'], false); ?></td>
    <td align='center'><?php echo $pilih['style'] ?> ( <?php echo $pilih['warna'] ?> )</td>
    <td align='center'>
    <?php
    $total_ss += $pilih['size_ss'];
    echo $pilih['size_ss'];
    ?>
    </td>
    <td align='center'>
    <?php
    $total_s += $pilih['size_s'];
    echo $pilih['size_s'];
    ?>
    </td>
    <td align='center'>
    <?php
    $total_m += $pilih['size_m'];
    echo $pilih['size_m'];
    ?>
    </td>
    <td align='center'>
      <?php
      $total_l += $pilih['size_l'];
      echo $pilih['size_l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_ll += $pilih['size_ll'];
      echo $pilih['size_ll'];
      ?>
    </td>
    </td>
    <td align='center'>
      <?php
      $total_3l += $pilih['size_3l'];
      echo $pilih['size_3l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_4l += $pilih['size_4l'];
      echo $pilih['size_4l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_5l += $pilih['size_5l'];
      echo $pilih['size_5l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_6l += $pilih['size_6l'];
      echo $pilih['size_6l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_7l += $pilih['size_7l'];
      echo $pilih['size_7l'];
      ?>
    </td>
        <td align='center'><?php
        $subtotal += $pilih['jumlah_size'];
        echo $pilih['jumlah_size'];
        ?></td>
	</tr>
	<?php
    $karton += $pilih['karton'];
    $no++;
    }
	?>
  <!-- Untuk mix -->
  <?php
    tampilkan_laporan_packinglist_mix($po, $style);
    $no2=$no;
    
    $laporan_mix = tampilkan_laporan_packinglist_mix($po, $style);
		while($pilih2 = mysqli_fetch_assoc($laporan_mix)){
  ?>
  <tr>
    <td align='center'><?php echo $no2; ?></td>
		<td align='center'><?php echo $pilih2['no_karton'] ?></td>
    <td align='center'><?php echo tanggal_indo($pilih2['tanggal'], false); ?></td>
    <td align='center'><?php echo $pilih2['style'] ?> ( <?php echo $pilih2['warna'] ?> )</td>
    <td align='center'>
    <?php
    $total_ss += $pilih2['size_ss'];
    echo $pilih2['size_ss'];
    ?>
    </td>
    <td align='center'>
    <?php
    $total_s += $pilih2['size_s'];
    echo $pilih2['size_s'];
    ?>
    </td>
    <td align='center'>
    <?php
    $total_m += $pilih2['size_m'];
    echo $pilih2['size_m'];
    ?>
    </td>
    <td align='center'>
      <?php
      $total_l += $pilih2['size_l'];
      echo $pilih2['size_l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_ll += $pilih2['size_ll'];
      echo $pilih2['size_ll'];
      ?>
    </td>
    </td>
    <td align='center'>
      <?php
      $total_3l += $pilih2['size_3l'];
      echo $pilih2['size_3l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_4l += $pilih2['size_4l'];
      echo $pilih2['size_4l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_5l += $pilih2['size_5l'];
      echo $pilih2['size_5l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_6l += $pilih2['size_6l'];
      echo $pilih2['size_6l'];
      ?>
    </td>
    <td align='center'>
      <?php
      $total_7l += $pilih2['size_7l'];
      echo $pilih2['size_7l'];
      ?>
    </td>
        <td align='center'><?php
        $subtotal += $pilih2['jumlah_size'];
        echo $pilih2['jumlah_size'];
        ?></td>
	</tr>
  <?php
    $karton += $pilih2['karton'];
    $no2++;
    }
	?>
  <tr>
    <td style="background-color:#f4f4f4;" colspan="4" align="center">Sub Total : </td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_ss; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_s; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_m; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_l; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_ll; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_3l; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_4l; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_5l; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_6l; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $total_7l; ?></td>
    <td style="background-color:#f4f4f4;" align='center'><?= $subtotal; ?></td>
  </tr>
  <tr>
    <td colspan="15">Total Quantity : <?= $subtotal; ?> PCS</td>
  </tr>
  <tr>
    <td colspan="15">Quantity Karton : <?= $karton; ?> Karton</td>
  </tr>

</tbody>
</table>
</center>
<br><br>
</body>

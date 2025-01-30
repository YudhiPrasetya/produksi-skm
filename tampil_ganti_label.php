<?php
  require_once 'core/init.php';
?>
  <link rel="stylesheet" href="view/style.css">

<br>

<?php
$temp_kenzin_total = tampilkan_temp_ganti_label();
$subtotal_qty=0;
while($data=mysqli_fetch_assoc($temp_kenzin_total)){

$subtotal_qty += $data['jumlah_size'];
}
?>

<table class="table atas">
<tr>
<td style="text-align:left">
 <font color="red" size="5">
 <?php
 $tanggal = date("Y-m-d");
 echo tanggal_indo ($tanggal, true);
?>
</font>
</td>
<td style="text-align:right">
<!-- <div class="qty"> -->
<font color="blue" size="5" background="green">
Total Qty Scan :
<?php
echo $subtotal_qty;

 ?>
</font>
<!-- </div> -->
</td>
</tr>
</table>

<!-- <div class="container"> -->
<table border="1px" class="table table-striped table-bordered data">
  <thead>
  <tr>
    <th class="tengah theader">No</th>
    <th class="tengah theader">NO PO</th>
    <th class="tengah theader">Label</th>
    <th class="tengah theader">Kode Barcode</th>
    <th class="tengah theader">Style</th>
    <th class="tengah theader">Color</th>
    <th class="tengah theader">SIZE</th>
    <th class="tengah theader">Waktu</th>
    <th class="tengah theader">Qty</th>
    <th class="tengah theader">Keterangan</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$subtotal_qty=0;
$temp_gantilabel = tampilkan_temp_ganti_label();
while($row=mysqli_fetch_assoc($temp_gantilabel))
{ 

// $subtotal_qty += $row['qty'];
   ?>
  <tr>
  <script type="text/javascript" language="JavaScript">
function konfirmasi_kurangi()
{
tanya3 = confirm("Yakin ingin kurangi stok STYLE ini  ?");
if (tanya3 == true) return true;
else return false;
}</script>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['no_po']; ?></td>
  <td class="tengah"><?= $row['label']; ?></td>
  <td class="tengah"><?= $row['kode_barcode']; ?></td>
  <td class="tengah"><?= $row['style'];  ?></td>
  <td class="tengah"> <?= $row['warna']; ?></td>
  <td class="tengah"> <?= $row['size']; ?></td>
  <td class="tengah"> <?= $row['jam']; ?></td>
  <td class="tengah"><?= $row['jumlah_size']; ?></td>
  <td class="tengah"><?= $row['ke_label']; ?></td>
  <td class="tengah"><a href="hapus_ganti_label_satu.php?id=<?= $row['ids_to_delete']; ?>" onclick="return konfirmasi_kurangi()">DELETE</a></td>
  </tr>

  <?php
    $no++;
    }
  ?>
</tbody>
</table>
</div>

<center>
  <!-- <button type="button" class="btn btn-danger" >RESET</button> -->
<a href="simpan_ganti_label.php" name="simpan"><button type="button" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN</button></a>
<a href="hapus_ganti_label.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()">RESET</button></a>
</center>

<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>


<script type="text/javascript" language="JavaScript">
function konfirmasi()
{
tanya = confirm("Anda Yakin Akan Menghapus Data ?");
if (tanya == true) return true;
else return false;
}
</script>

<script type="text/javascript" language="JavaScript">
function konfirmasi_simpan()
{
tanya2 = confirm("Yakin Data Sudah Benar dan ingin disimpan?");
if (tanya2 == true) return true;
else return false;
}</script>



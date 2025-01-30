<?php
  require_once 'core/init.php';
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'qcfinal' ) {
    $user = $_SESSION['username'];
    $trx = $_GET['trx'];
?>
  <link rel="stylesheet" href="view/style.css">

<br>
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
<td style="text-align:center">

 
<font color="blue" size="5" background="green">
NO TRANSAKSI : <?= $trx;   ?>
</font>
</td>
<td style="text-align:right">
<!-- <div class="qty"> -->
<font color="blue" size="5" background="green">
Total Qty Scan :
<?php
  $packing_total = tampilkan_total_packing_trx($trx);
 $data=mysqli_fetch_assoc($packing_total);
 echo $data['jumlah_size'];

 ?> PCS
</font>
<!-- </div> -->
</td>
</tr>
</table>
<?php
$temp_packing = tampilkan_transaksi_packing($trx);
?>
<!-- <div class="container"> -->
<table border="1px" class="table table-striped table-bordered data" style="font-size: 14">
  <thead>
  <tr>
    <th class="tengah theader">No</th>
    <th class="tengah theader">ORC</th>
    <th class="tengah theader">No PO</th>
    <th class="tengah theader">Kode Barcode</th>
    <th class="tengah theader">STYLE</th>
    <th class="tengah theader">Color</th>
    <th class="tengah theader">Label</th>
    <th class="tengah theader">Size</th>
    <th class="tengah theader">Qty</th>
    <th class="tengah theader">Waktu</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$subtotal_qty=0;
while($row=mysqli_fetch_assoc($temp_packing))
{ 

// $subtotal_qty += $row['qty'];
   ?>
  <tr>
  <script type="text/javascript" language="JavaScript">
function konfirmasi_kurangi()
{
tanya3 = confirm("Yakin ingin kurangi stok ini");
if (tanya3 == true) return true;
else return false;
}</script>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['orc']; ?></td>
  <td class="tengah"><?= $row['no_po']; ?></td>
  <td class="tengah"><?= $row['kode_barcode']; ?></td>
  <td class="tengah"><?= $row['style'];  ?> </td>
  <td class="tengah"><?= $row['warna'];  ?> </td>
  <td class="tengah"><?= $row['label'];  ?> </td>
  <td class="tengah"><?= $row['size'];  ?> </td> 
  <td class="tengah"><?= $row['qty']; ?></td>
  <td class="tengah"> <?= $row['jam']; ?></td>
  <td class="tengah"><a href="hapus_packing_edit_satu.php?id=<?= $row['id_transaksi_packing']; ?>&trx=<?= $row['no_trx']; ?>" onclick="return konfirmasi_kurangi()">DEL</a></td>
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
<!-- <a href="simpan_master_kenzin.php" name="simpan"><button type="button" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN</button></a>
<a href="hapus_kenzin.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()">RESET</button></a> -->
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

<?php
} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
  ?>



<?php require_once 'core/init.php';); ?>
<?php
$po2 = $_GET['no_po'];

$po_detail = tampilkan_cetak_packing($po2);
while($pilih = mysqli_fetch_array($po_detail)){
	// echo '<option value='.$pilih['kode_barcode'].'>'.$pilih['kode_barcode'].'</option>';
	echo "<option value=\"".$pilih['kode_barcode']."\">".$pilih['kode_barcode']."</option>\n";
	}
?>

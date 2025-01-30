<?php
  require_once 'core/init.php';

?>
  <link rel="stylesheet" href="view/style.css">

<br>
<table class="table atas">
<tr>
<td style="text-align:left">
 <font color="red" size="5">
 <?php
 $no_kenzin = $_GET['no_trx'];
 $user = $_SESSION['username'];
 $tanggal = date("Y-m-d");
 echo tanggal_indo ($tanggal, true);
?>
</font>
</td>
<td style="text-align:center">
<?php 
  $data1 = tampilkan_data_temp_packing($user);
    while($temp = mysqli_fetch_array($data1)){

    if($temp['data_no'] > 0){
      $data3 = tampilkan_no_transaksi_packing0($user);
        $trx2 = mysqli_fetch_array($data3);
        $no_scan=$trx2['no_trx'];
    }else{
      $data2 = tampilkan_no_transaksi_packing($user);
      $trx = mysqli_fetch_array($data2);
        $no_scan=$trx['no_trx'];
        $no_scan+=1;
    }
    ?>


 
<font color="blue" size="5" background="green">
NO TRANSAKSI : <?= $no_scan;  } ?>
</font>
</td>
<td style="text-align:right">
<!-- <div class="qty"> -->
<font color="blue" size="5" background="green">
Total Qty Scan :
<?php
  $temp_packing_total = tampilkan_total_temp_packing($_SESSION['username']);
 $data=mysqli_fetch_assoc($temp_packing_total);
 echo $data['jumlah_size'];

 ?> PCS
</font>
<!-- </div> -->
</td>
</tr>
</table>
<?php
$temp_packing = tampilkan_temp_packing_lockkenzin($user, $no_kenzin);
?>
<!-- <div class="container"> -->
<table border="1px" id="example2" class="table table-striped table-bordered data" style="font-size: 14">
  <thead>
  <tr>
    <th class="tengah theader" style="text-align:center">NO TRX</th>

    <th class="tengah theader" style="text-align:center">ORC</th>
    <th class="tengah theader" style="text-align:center">No PO</th>
    <th class="tengah theader" style="text-align:center">Label</th>
    <th class="tengah theader" style="text-align:center">Kode Barcode</th>
    <th class="tengah theader" style="text-align:center">STYLE</th>
    <th class="tengah theader" style="text-align:center">Color</th>
    <th class="tengah theader" style="text-align:center">Kenzin</t>
    <th class="tengah theader" style="text-align:center">Size</th>
    <th class="tengah theader" style="text-align:center;">PCS</th>
    <th class="tengah theader" style="text-align:center;">PACK</th>
    <th class="tengah theader" style="text-align:center">Waktu</th>
    <th class="tengah theader" style="text-align:center">Action</th>
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

  <td class="tengah"><?= $row['no_trx']; ?></td>

  <td class="tengah"><?= $row['orc']; ?></td>
  <td class="tengah"><?= $row['no_po']; ?></td>
  <td class="tengah"><?= $row['label'];  ?> </td>
  <td class="tengah"><?= $row['kode_barcode']; ?></td>
  <td class="tengah"><?= $row['style'];  ?> </td>
  <td class="tengah"><?= $row['warna'];  ?> </td>
  <td class="tengah" ><?= $row['total_kenzin']; ?></td>
  <td class="tengah" style="background-color: #87CEEB; font-weight: bold;"><?= $row['size'].$row['cup'];  ?> </td> 
  <td class="tengah" style="background-color: #87CEEB; font-weight: bold; color: red"><?= $row['qty_scan']; ?></td>
  <td class="tengah" style="background-color: #87CEEB; font-weight: bold; "><?= ceil($row['qty_pack']); ?></td>
  <td class="tengah"> <?= $row['jam']; ?></td>
  <td class="tengah">
  <button type="button" data-id="<?= $row['id_transaksi_packing'] ?>" class="btn btn-xs btn-danger kecil kurangi"><i class="glyphicon glyphicon-trash"></i></button>
  <!-- <a href="hapus_packing_satu.php?id=<?= $row['id_transaksi_packing']; ?>" >DEL</a> -->
  </td>
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
		$('#example2').DataTable();
	});
 

  $('#example2 tbody').on('click', '.kurangi', function () {
    swal.fire({
      title: "Anda Yakin ingin Mengurangi Hasil Scan ini?",
      text: "Tekan Yes, data akan berkurang satu!",
      type: "warning",

      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete',
      cancelButtonText: "Cancel",
      showCancelButton: true,
      reverseButtons: false,
    }).then((result) => {
      if (result.dismiss !== 'cancel') {
       var id_transaksi_packing = $(this).data('id');
       $.ajax({
        method: "POST",
        url: "proses_packing.php",
        data: { id : id_transaksi_packing,
            type : "kurangi"
        },
        success: function(data){
          console.log(data);
            if(data.trim() == "success"){
              swal("Data Berhasil di Berkurang 1 PCS / 1 PACK!", "Klik Ok untuk melanjutkan!", "success");
              var no_kenzin = $('#no_kenzin').val();
              url = "tampil_packing2.php?no_trx="+no_kenzin;
              $('#tampil_tabel').load(url);
            }else if(data.trim() == "errorDb"){
                alert("Gagal, Hubungi Team IT");
            }
        }
      });
    }else {
      swal.close();
    }
  });
  });
</script>



<?php

  ?>



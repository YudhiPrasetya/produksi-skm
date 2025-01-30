<?php
  require_once 'core/init.php';
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'kenzin' ) {
    // $user = $_SESSION['username'];
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
<?php 
  $data1 = tampilkan_data_temp_kenzin($_SESSION['username']);
    while($temp = mysqli_fetch_array($data1)){

    if($temp['data_no'] > 0){
      $data3 = tampilkan_no_transaksi_kenzin0($_SESSION['username']);
        $trx2 = mysqli_fetch_array($data3);
        $no_scan=$trx2['no_trx'];
    }else{
      $data2 = tampilkan_no_transaksi_kenzin($_SESSION['username']);
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
  $temp_kenzin_total = tampilkan_total_temp_kenzin($_SESSION['username']);
  $data=mysqli_fetch_assoc($temp_kenzin_total);
  echo $data['jumlah_size'];
  
 ?> PCS
</font>
<!-- </div> -->
</td>
</tr>
</table>
<?php
$temp_kenzin = tampilkan_temp_kenzin($_SESSION['username']);
?>
<!-- <div class="container"> -->
<table border="1px" id="example2" class="table table-striped table-bordered data" style="font-size: 14">
  <thead>
  <tr>
    <th style="text-align:center; background: #254681" class="tengah theader">No</th>
    <th style="text-align:center; background: #254681" class="tengah theader">Waktu</th>
    <th style="text-align:center; background: #254681" class="tengah theader">ORC</th>
    <th style="text-align:center; background: #254681" class="tengah theader">No PO</th>
    <th style="text-align:center; background: #254681" class="tengah theader">Kode Barcode</th>
    <th style="text-align:center; background: #254681" class="tengah theader">STYLE</th>
    <th style="text-align:center; background: #254681" class="tengah theader">Color</th>
    <!-- <th style="text-align:center" class="tengah theader">Label</th> -->
    <th style="text-align:center; ; background: #254681" class="tengah theader">Size</th> 

    <th style="text-align:center; background: #254681" class="tengah theader">PCS</th>
    <th style="text-align:center; background: #254681" class="tengah theader">PACK</th>
    <th style="text-align:center; background: #254681" class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$subtotal_qty=0;
while($row=mysqli_fetch_assoc($temp_kenzin))
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
  <td class="tengah"> <?= $row['jam']; ?></td>
  <td class="tengah"><?= $row['orc']; ?></td>
  <td class="tengah"><?= $row['no_po']; ?></td>
  <td class="tengah"><?= $row['kode_barcode']; ?></td>
  <td class="tengah"><?= $row['style'];  ?> </td>
  <td class="tengah"><?= $row['warna'];  ?> </td>
  <!-- <td class="tengah"><?= $row['label'];  ?> </td> -->
  <td class="tengah" style="background-color: #87CEEB; font-weight: bold;"><?= $row['size'].$row['cup'];  ?> </td> 

  <td class="tengah"  style="background-color: #87CEEB; font-weight: bold; color: red"><?= $row['qty']; ?></td>
  <td class="tengah"><?= ceil($row['qty_pack']); ?></td>
  <td class="tengah">
  <button type="button" data-id="<?= $row['id_transaksi_kenzin'] ?>" class="btn btn-xs btn-danger kecil kurangi"><i class="glyphicon glyphicon-trash"></i></button>
  <!-- <a href="hapus_kenzin_satu.php?id=<?= $row['id_transaksi_kenzin']; ?>" onclick="return konfirmasi_kurangi()">DEL</a> -->
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
		$('.data').DataTable();
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
       var id_transaksi_kenzin = $(this).data('id');
       $.ajax({
        method: "POST",
        url: "proses_kenzin.php",
        data: { id : id_transaksi_kenzin,
            type : "kurangi"
        },
        success: function(data){
          console.log(data);
            if(data.trim() == "success"){
              swal("Data Berhasil di Berkurang 1 PCS / 1 PACK !", "Klik Ok untuk melanjutkan!", "success");
              $('#tampil_tabel').load("tampil_kenzin.php");
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
} else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } 
  ?>


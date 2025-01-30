<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing' OR 
cek_status($_SESSION['username'] ) == 'kenzin' OR 
cek_status($_SESSION['username'] ) == 'ppic' ) {
  ?>
<center>
<br><br>
<?php
$error = '';
if(isset($_POST['tambah'])){
$contract = $_POST['contract'];
$total_order = $_POST['total_order'];

  if(!empty(trim($contract)) && !empty(trim($total_order)) ){
    if(cek_contract($contract) == 0){
    if(tambah_data_contract($contract, $total_order)){
      $error = "Data Berhasil di simpan";
    }else {
      $error = "Gagal Menyimpan data";
    }
  }else{
    $error = "No Contract Sudah ada";
  }
  }else{
    $error = "Ada Data yang masih kosong";
  }
}

if(isset($_POST['update'])){
  $id   = $_POST['id_contract'];
  $contract   = $_POST['contract'];
  $totalOrder   = $_POST['total_order'];
  $status   = $_POST['status'];

  if(!empty(trim($contract)) && !empty(trim($totalOrder)) && !empty(trim($status))){
    //query data po master
    if(edit_data_contract($id, $contract, $totalOrder, $status)){
      $_SESSION['pesan'] = 'Data Berhasil Diedit';
      // header('Location: master-po.php');
    } else {
      $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
    }
  }else{
    $_SESSION['pesan']='Ada data yang masih kosong, wajib di isi semua';
  }
}
 ?>
</center>
<div class="row">
  <!-- <div> -->
  <div class="col-sm-4"></div>
 <div class="col-sm-3 tetep">
     <br><br>
 <form method="post" action="master-contract.php">
   <h3><center>Tambah Data Master Kontrak Kerja</center></h3>
   <br><br><br>
   <div class="form-group">
   <label>Contract Number</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
      <input type="text" class="form-control" placeholder="Masukkan Contract Number" value="---/AKM/SC/FGX/IX/2019" name="contract" id="contract" required>
   </div>
    </div>

   <div class="form-group">
   <label>Total Order</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-pencil"></i>
   </div>
      <input type="number" class="form-control" placeholder="Masukkan Total Order" name="total_order" id="total_order" required>
   </div>

 
   <br>
   <span class="error" style="background-color: lightblue;">
  <?= $error; ?> 
  </span>
 </div>

 <br>
<center>
   <input type="submit" class="btn btn-primary" name="tambah" value="SIMPAN DATA" id="submit_barang" >
</center>
<!-- </div> -->

</form>
</div>

<!-- <div id="hasil"></div> -->
<div class="col-sm-8 diam">
<center><h2>Master Kontrak Kerja</h2></center>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>
<br>
<!-- <div class="container"> -->
<table border="1px" class="table table-striped table-bordered data">
  <thead>
  <tr>
    <th class="tengah theader">No</th>
    <th class="tengah theader">No Contract</th>
    <th class="tengah theader">Total Order</th>
    <th class="tengah theader">Status</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$contract = tampilkan_masterContract();
while($row=mysqli_fetch_assoc($contract))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['no_contract']; ?></td>
  <td class="tengah"><?= $row['total_order']; ?></td>
  <td class="tengah"><?= $row['status']; ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_contract']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <a href="hapus_contract_satu.php?id=<?= $row['id_contract']; ?>"><button type="button" class="btn btn-xs btn-danger kecil" onclick="return konfirmasi()"><i class="glyphicon glyphicon-trash"></i></button></a>

  </td>
  </tr>

  <?php
    $no++;
    }
  ?>
</tbody>
</table>
</div>

<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master Purchasing Order</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data"></div>
        </div>

    </div>
</div>
</div>
<!-- Modal Edit data kelas-->


</div>
</div>



<script type="text/javascript">

// penutup hak akses level
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
// $('#kode_barcode').on('change',function(){
//   $('#tampil_tabel').load(tampil.php);
// });
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});

</script>

<!-- Script ajax menampilkan Edit kelas -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_contract.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
        </script>

<script type="text/javascript" language="JavaScript">
function konfirmasi()
{
tanya = confirm("Anda Yakin Akan Menghapus Data ini?");
if (tanya == true) return true;
else return false;
}
</script>

</body>
</html>

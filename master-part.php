<?php
  require_once 'core/init.php';
  require_once 'view/header.php';

  $error='';

	// cek apakah yang mengakses halaman ini sudah login
	if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  // header('Location: index.php');
  }
?>

<?php
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'ppic') {
    $username = $_SESSION['username'];
?>
<br>
<?php
  if(isset($_POST['tambah'])){
    $part = strtoupper($_POST['part']);
    $status = $_POST['status'];

      if(!empty(trim($part)) && !empty(trim($status))){
      //memasukkan ke database
        if(cek_part_duplicate($part) == 0){
          if(tambah_data_master_part($part, $status, $username)){
            $_SESSION['pesan'] = 'Data Berhasil di Tambah';
          }else{
            $_SESSION['pesan'] = 'gagal';
          }
        }else{
          $_SESSION['pesan'] = 'Master Part sudah Ada';
        }
      }else{
        $_SESSION['pesan'] = 'Data tidak boleh ada yang kosong';
      }
    }
?>

<?php
  if(isset($_POST['update'])){
    $id   = $_POST['id_part'];
    $part = strtoupper($_POST['part']);
    $status = $_POST['status'];
  
    if(!empty(trim($part))){
      if(edit_data_master_part($id, $part, $status, $username)){
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
      }else{
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    }else{
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }
 ?>

<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-3 tetep">
    <br><br><br><br>
    <h3><center>Tambah Data Master Costomer</center></h3>
    <br>

    <form method="post" action="master-part.php">
    <div class="form-group">
    <label id="part">MASTER PART</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="text" class="form-control" placeholder="PART BARU" name="part" id="part" required>
      </div>
 </div>

 <div class="form-group">
    <label id="status">STATUS</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <select name="status" id="status" class="form-control" required>
          <option value="aktif" selected>AKTIF</option>
          <option value="tidak">TIDAK</option>
        </select>
      </div>
    </div>

    <span class="error" style="background-color: lightblue;">
<?= $error; ?> 
</span>
<center>

   <INPUT type="submit" class="btn btn-primary" name="tambah" value="SIMPAN DATA" id="submit_barang" >
</center>
</form>
</div>

</form>


<!-- <div id="hasil"></div> -->
<div class="col-sm-8 diam" >
<center><h2>MASTER PART CUTTING</h2></center>
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

<table border="1px" class="table table-striped table-bordered data" style="font-size: 12px">
  <thead>
  <tr>
    <th class="theader" style="width: 5%"><center>NO</center></th>
    <th class="theader" style="width: 65%"><center>PART</center></th>
    <th class="theader" style="width: 15%"><center>STATUS</center></th>
    <th class="theader" style="width: 15%"><center>ACTION<center></th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$part = tampilkan_master_part();
while($row=mysqli_fetch_assoc($part))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['part']; ?></td>
  <td class="tengah"><?= $row['status']; ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_part']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <a href="hapus_part_satu.php?id=<?= $row['id_part']; ?>"><button type="button" class="btn btn-xs btn-danger kecil" onclick="return konfirmasi()"><i class="glyphicon glyphicon-trash"></i></button></a>

  </td>
  </tr>

  <?php
    $no++;
    }
  ?>
</tbody>

</table>
</div>
<script type="text/javascript" language="JavaScript">
function konfirmasi()
{
tanya = confirm("Anda Yakin akan menghapus data ini ?");
if (tanya == true) return true;
else return false;
}
</script>

<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><font face="Calibri" color="red"><b>EDIT DATA PART</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data"></div>
        </div>

    </div>
</div>
</div>
<!-- Modal Edit data kelas-->

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
			url	 : 'edit_part.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
<!-- Script ajax menampilkan Edit kelas -->

</div>
</div>

<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
<!-- // $('#kode_barcode').on('change',function(){
//   $('#tampil_tabel').load(tampil.php);
// }); -->
</script>
<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
        </script>
</body>
</html>

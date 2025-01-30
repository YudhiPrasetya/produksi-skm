<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
if( !isset($_SESSION['username']) ){
  echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  // header('Location: index.php');    
}
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing' OR 
cek_status($_SESSION['username'] ) == 'kenzin' OR 
cek_status($_SESSION['username'] ) == 'ppic' ) {
  $user = $_SESSION['username'];
  $tgl = date("Y-m-d");
?>
<center>
<br><br>
<?php
// $error = '';
if(isset($_POST['tambah'])){
$line = $_POST['line'];
$lantai = $_POST['lantai'];
$supervisor = $_POST['supervisor'];
$chief = $_POST['chief'];



  if(!empty(trim($line))){
    if(cek_line($line) == 0){
    if(tambah_data_line($line, $lantai, $supervisor, $chief, $user)){
      $_SESSION['pesan'] = "Data Berhasil di simpan";
    }else {
      $_SESSION['pesan']  = "Gagal Menyimpan data";
    }
  }else{
    $_SESSION['pesan']  = "Nama Line Sudah ada";
  }
  }else{
    $_SESSION['pesan']  = "Ada Data yang masih kosong";
  }
}

if(isset($_POST['update'])){
  $id   = $_POST['id_line'];
  $line   = ucwords($_POST['line']);
  $lantai   = $_POST['lantai'];
  $supervisor   = ucwords($_POST['supervisor']);
  $chief   = ucwords($_POST['chief']);
  $status   = $_POST['status'];

  if(!empty(trim($line))){
    //query data po master
    if(edit_data_master_line($id, $line, $lantai, $supervisor, $chief, $status, $user)){
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
</div> 
<div style="margin-left: 20px; margin-right: 20px">

  <div class="col-sm-3">
    <form method="POST" >
      <h3><center>Tambah Data Master Line</center></h3>
      <br><br>

      <div class="form-group">
        <label for="line">Nama Line</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-bookmark"></i>
          </div>
          <input type="text" class="form-control" placeholder="Masukkan Nama Line" name="line" id="line" required>
        </div>
      </div>

      <div class="form-group">
        <label for="lantai">Lantai</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-text-height"></i>
          </div>
          <input type="number" class="form-control" placeholder="Masukkan Lantai" name="lantai" id="lantai" required>
        </div>
      </div>

      <div class="form-group">
        <label for="supervisor">Supervisor</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-tag"></i>
          </div>
          <input type="text" class="form-control" placeholder="Masukkan Supervisor" name="supervisor" id="supervisor">
        </div>
      </div>

      <div class="form-group">
        <label for="chief">Chief</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="glyphicon glyphicon-tags"></i>
          </div>
          <input type="text" class="form-control" placeholder="Masukkan Chief" name="chief" id="chief">
        </div>
      </div>

 <br>
<center>
   <input type="submit" class="btn btn-primary" name="tambah" value="SIMPAN DATA" id="submit_barang" >
</center>
<!-- </div> -->

</form>
</div>

<div class="col-sm-9">
<center><h2>Master Line</h2></center>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>
<br>
<?php
$line = tampilkan_master_line2($tgl);
?>
<table border="1px" class="table table-striped table-bordered data">
  <thead>
  <tr>
    <th class="tengah theader">No</th>
    <th class="tengah theader">Line</th>
    <th class="tengah theader">Lantai</th>
    <th class="tengah theader">Supervisor</th>
    <th class="tengah theader">Chief</th>
    <th class="tengah theader">Jmlh operator</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;

while($row=mysqli_fetch_assoc($line))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= ucfirst($row['nama_line']) ?></td>
  <td class="tengah"><?= $row['lantai'] ?></td>
  <td class="tengah"><?= ucfirst($row['supervisor']) ?></td>
  <td class="tengah"><?= ucfirst($row['chief']) ?></td>
  <td class="tengah"><?= $row['jmlh_operator'] ?></td>
  <td class="tengah">
  <a href="master-line-register-hrd.php?id=<?= $row['id_line']; ?>"><button type="button" class="btn btn-xs btn-info kecil"><i class="glyphicon glyphicon-plus"></i></button></a>
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_line']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <a href="hapus_line_satu.php?id=<?= $row['id_line']; ?>"><button type="button" class="btn btn-xs btn-danger kecil"><i class="glyphicon glyphicon-trash"></i></button></a>

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
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master Line</b></font></h4>
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

<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
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
			url	 : 'edit_line.php',
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
</body>
</html>

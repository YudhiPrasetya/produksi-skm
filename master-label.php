<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
$error='';

	// cek apakah yang mengakses halaman ini sudah login
	if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');
    
  }
	?>

<?php
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'packing' OR 
  cek_status($_SESSION['username'] ) == 'kenzin' OR 
  cek_status($_SESSION['username'] ) == 'kenzin2' OR 
  cek_status($_SESSION['username'] ) == 'kenzin3' OR 
  cek_status($_SESSION['username'] ) == 'ppic') {
?>
<center>
<br>

<?php
  if(isset($_POST['tambah'])){
    $label = $_POST['label'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
 
    if(!empty(trim($label)) && !empty(trim($bulan)) && !empty(trim($tahun))){
      //memasukkan ke database
      if(cek_label($label) == 0){
        if(tambah_data_label($label, $bulan, $tahun)){
          // header('Location: master-label.php');
          $error = 'Data Berhasil diinput';
            }else{
          $error = 'gagal';
          }
        }else{
          $error = 'Label sudah Ada didata';
        }
      
      }else{
        $error = 'Data tidak boleh ada yang kosong';
      }
    }  
?>


<?php
  if(isset($_POST['update'])){
    $id   = $_POST['id_label'];
    $label   = $_POST['label'];
    $bulan   = $_POST['bulan'];
    $tahun   = $_POST['tahun'];
    $status   = $_POST['status'];

    if(!empty(trim($label)) && !empty(trim($status)) && !empty(trim($bulan)) && !empty(trim($tahun))){
      if(edit_data_label($label, $id, $bulan, $tahun, $status)){
        // header('Location: master-style.php');
        $_SESSION['pesan'] = 'Data Berhasil di Edit';
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
  <div class="col-sm-4"></div>
    <div class="col-sm-3 tetep">
       <br><br><br><br><br><br><br>
       <h3><center>Tambah Data Master Label</center></h3>
  <br>
   
  <form method="post" action="master-label.php">
    <div class="form-group">
      <label>LABEL BARU</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="text" class="form-control" placeholder="LABEL BARU" name="label" id="label" required>
      </div>
    </div>

    <div class="form-group">
      <label for="bulan">Bulan</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
          <select name="bulan" id="bulan" class="form-control">
          <option value=""> -- Pilih Bulan -- </option>
          <?php
           $bulan = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');   
          for($i= 0; $i<count($bulan); $i++){
          ?>
          <option value="<?= $bulan[$i] ?>"><?= $bulan[$i] ?></option>
          <?php } ?>
          </select>
      </div>
    </div>

    <div class="form-group">
      <label for="tahun">Tahun</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
          <select name="tahun" id="tahun" class="form-control">
              <option value=""> -- Pilih Tahun -- </option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
          </select>
      </div>

   <br>
    <span class="error" style="background-color: lightblue;">
      <?= $error; ?> 
    </span>
 </div>
<center>
   <INPUT type="submit" class="btn btn-primary" name="tambah" value="SIMPAN DATA" id="submit_barang" >
</center>
</form>
</div>

<!-- <div id="hasil"></div> -->
<div class="col-sm-8 diam" >
  <center><h2>MASTER LABEL </h2></center>
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
  $style = tampilkan_master_label();
?>

<table border="1px" class="table table-striped table-bordered data">
  <thead>
    <tr>
      <th class="tengah theader">No</th>
      <th class="tengah theader">Label</th>
      <th class="tengah theader">Bulan</th>
      <th class="tengah theader">Tahun</th>
      <th class="tengah theader">Status</th>
      <th class="tengah theader">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no=1;
      while($row=mysqli_fetch_assoc($style)){
    ?>
    <tr>
      <td class="tengah"><?= $no; ?></td>
      <td class="tengah"><?= $row['label']; ?></td>
      <td class="tengah"><?= $row['bulan']; ?></td>
      <td class="tengah"><?= $row['tahun']; ?></td>
      <td class="tengah"><?= $row['status']; ?></td>
      <td class="tengah">
        <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_label']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
        <a href="hapus_label_satu.php?id=<?= $row['id_label']; ?>"><button type="button" class="btn btn-xs btn-danger kecil"><i class="glyphicon glyphicon-trash"></i></button></a>
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
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master Label</b></font></h4>
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

<!-- Script ajax menampilkan Edit  -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_label.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
<!-- Script ajax menampilkan Edit -->
</div>
</div>

 <!-- penutup hak akses level -->

<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>

<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
        </script>
</body>
</html>

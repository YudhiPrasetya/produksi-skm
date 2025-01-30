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
  cek_status($_SESSION['username'] ) == 'packing' OR 
  cek_status($_SESSION['username'] ) == 'kenzin' OR
  cek_status($_SESSION['username'] ) == 'kenzin2' OR
  cek_status($_SESSION['username'] ) == 'kenzin3' OR
  cek_status($_SESSION['username'] ) == 'ppic') {
?>
<br>
<?php
  if(isset($_POST['tambah'])){
    $costomer = $_POST['costomer'];
    $barcode_costomer = $_POST['barcode_costomer'];

      if(!empty(trim($costomer, $barcode_costomer))){
      //memasukkan ke database
        if(cek_description($costomer) == 0){
          if(tambah_data_description($costomer, $barcode_costomer)){
            $_SESSION['pesan'] = 'Data Berhasil di Tambah';
          }else{
            $_SESSION['pesan'] = 'gagal';
          }
        }else{
          $_SESSION['pesan'] = 'Costomer sudah Ada';
        }
      }else{
        $_SESSION['pesan'] = 'Data tidak boleh ada yang kosong';
      }
    }
?>

<?php
  if(isset($_POST['update'])){
    $id   = $_POST['id_costomer'];
    $costomer   = $_POST['costomer'];
    $barcode_costomer   = $_POST['barcode_costomer'];
  
    if(!empty(trim($costomer))){
      if(edit_data_costomer($id, $costomer, $barcode_costomer)){
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

    <form method="post" action="master-costomer.php">
    <div class="form-group">
    <label id="costomer">Buyer Baru</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <input type="text" class="form-control" placeholder="COSTOMER BARU" name="costomer" id="costomer" required>
      </div>
 </div>

 <div class="form-group">
    <label id="barcode_costomer">BARCODE COSTOMER</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tag"></i>
        </div>
        <select name="barcode_costomer" id="barcode_costomer" class="form-control" required>
          <option value="y">Yes</option>
          <option value="n">No</option>
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
<center><h2>MASTER COSTOMER</h2></center>
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
$costomer = tampilkan_master_costomer();
?>
<!-- <div class="container"> -->

<table border="1px" class="table table-striped table-bordered data">
  <thead>
  <tr>
    <th class="tengah theader">No</th>
    <th class="tengah theader">Costomer</th>
    <th class="tengah theader">Barcode Buyer</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;

while($row=mysqli_fetch_assoc($costomer))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['costomer']; ?></td>
  <td class="tengah">
    <?php if($row['barcode_costomer'] == 'y'){
      echo "Yes";
    }else{
      echo "No";
    } ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_costomer']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <a href="hapus_costomer_satu.php?id=<?= $row['id_costomer']; ?>"><button type="button" class="btn btn-xs btn-danger kecil" onclick="return konfirmasi()"><i class="glyphicon glyphicon-trash"></i></button></a>

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
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Costomer</b></font></h4>
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
			url	 : 'edit_costomer.php',
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



<!-- <script type="text/javascript">
  $('#submit_barang').on('click',function(){
    var style = $('#style_baru').val();
    $.ajax({
      method: "POST",
      url: "proses_style.php",
      data: { style : style,
       },
      success: function(data){
        // $('#tampil_tabel').prepend("<p>" + barcode + "</p>");
        $('#tampil_tabel').load("tampil_style.php");
      }
    });
    document.getElementById("kode_barcode").value = "";
  });

$(document).ready(function(){
    $('#tampil_tabel').load("tampil_style.php");
}); -->

 <!-- penutup hak akses level -->

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

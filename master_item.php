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
  ?>
<center>
<br><br>
<?php
$error = '';
if(isset($_POST['tambah'])){
$item = $_POST['item'];
$category = $_POST['category'];

  if(!empty(trim($item)) && !empty(trim($category))){
    if(cek_item($item) == 0){
    if(tambah_data_item($item, $category)){
      $error = "Data Berhasil di simpan";
    }else {
      $error = "Gagal Menyimpan data";
    }
  }else{
    $error = "Item Sudah ada sebelumnya";
  }
  }else{
    $error = "Ada Data yang masih kosong";
  }
}

if(isset($_POST['update'])){
  $id   = $_POST['id_item'];
  $item = $_POST['item'];
  $category = $_POST['category'];
  

  if(!empty(trim($item)) && !empty(trim($category)) ){
    //query data po master
    if(edit_data_item($id, $item, $category)){
      $_SESSION['pesan'] = 'Data Berhasil Diedit';
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
 <form method="post">
   <h3><center>Tambah Data Master ITEM</center></h3>
   <br><br><br>
   <div class="form-group">
   <label for="item">Nama Item</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
      <input type="text" class="form-control" placeholder="Masukkan Nama Item" name="item" id="item" required>
   </div>
    </div>

   <div class="form-group">
   <label for="category">Category</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-pencil"></i>
   </div>
      <select name="category" id="category" class="form-control" required>
          <option value="">PILIH CATEGORY ITEM</option>
          <option value="OUTERWEAR">OUTERWEAR</option>
          <option value="UNDERWEAR">UNDERWEAR</option>
      </select>
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
<center><h2>Master ITEM</h2></center>
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
    <th class="tengah theader">ITEM</th>
    <th class="tengah theader">CATEGORY</th>
    <th class="tengah theader">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$item = tampilkan_item();
while($row=mysqli_fetch_assoc($item))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['item']; ?></td>
  <td class="tengah"><?= $row['category']; ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_item']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <a href="hapus_item_satu.php?id=<?= $row['id_item']; ?>"><button type="button" class="btn btn-xs btn-danger kecil" onclick="return konfirmasi()"><i class="glyphicon glyphicon-trash"></i></button></a>

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
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master Items</b></font></h4>
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
			url	 : 'edit_item.php',
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

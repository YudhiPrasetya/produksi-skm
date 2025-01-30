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
cek_status($_SESSION['username'] ) == 'ie' 
) {
  ?>
<center>
<br><br>
<?php
$error = '';
if(isset($_POST['tambah'])){
$style = $_POST['style'];
$nilai_smv = $_POST['nilai_smv'];
$username = $_SESSION['username'];

  if(!empty(trim($style)) && !empty(trim($nilai_smv))){
    if(cek_style_smv($style) == 0){
    if(tambah_data_master_smv($style, $nilai_smv, $username)){
      $error = "Data Berhasil di simpan";
    }else {
      $error = "Gagal Menyimpan data";
    }
  }else{
    $error = "Nilai SMV di Style ini udah dimasukkan";
  }
  }else{
    $error = "Ada Data yang masih kosong";
  }
}

if(isset($_POST['update'])){
  $id   = $_POST['id'];
  $nilai_smv = $_POST['nilai_smv'];
  $username = $_SESSION['username'];

  if(!empty(trim($nilai_smv)) ){
    //query data po master
    if(edit_master_nilai_smv($id, $nilai_smv, $username)){
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
</div>
<div class="row" style="margin-left: 20px; margin-right: 20px">
  <!-- <div> -->
  <div class="col-sm-4" ></div>
 <div class="col-sm-4 tetep"> 
     <br><br>
 <form method="post">
   <h3><center>Tambah Data Master SMV</center></h3>
   <br><br><br>

   <div class="form-group">
      <label for="style">STYLE</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-list"></i>
        </div>
        <select id="style" class="form-control" name="style" required>
          <option value="" selected>--- Pilih STYLE ---</option>
          <?php
            $style = tampilkan_style_smv();
            while($pilih = mysqli_fetch_assoc($style)){
              echo '<option value='.$pilih['id_style'].'>'.$pilih['style'].'</option>';
            }
          ?>
        </select>
      </div>
    </div> 


   <div class="form-group">
   <label for="nilai_smv">NILAI SMV</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list-alt"></i>
   </div>
      <input type="number" class="form-control" step=".01" placeholder="Masukkan Nilai SMV" name="nilai_smv" id="nilai_smv" required>
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
<center><h2>Master Karton</h2></center>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>
<br>

<table border="1px" class="table table-striped table-bordered data">
  <thead>
  <tr>
    <th class="tengah theader" style="text-align: center">No</th>
    <th class="tengah theader" style="text-align: center">STYLE</th>
    <th class="tengah theader" style="text-align: center">NILAI SMV</th>
    <th class="tengah theader" style="text-align: center">COSTOMER</th>
    <th class="tengah theader" style="text-align: center">Action</th>
  </tr>
</thead>
<tbody>
<?php
$no=1;
$item = tampilkan_master_smv();
while($row=mysqli_fetch_assoc($item))
{

// $subtotal_qty += $row['qty'];
   ?>
  <tr>

  <td class="tengah"><?= $no; ?></td>
  <td class="tengah"><?= $row['style']; ?></td>
  <td class="tengah"><?= $row['nilai_smv']; ?></td>
  <td class="tengah"><?= $row['costomer']; ?></td>
  <td class="tengah">
    <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <!-- <a href="hapus_item_satu.php?id=<?= $row['id']; ?>"><button type="button" class="btn btn-xs btn-danger kecil" onclick="return konfirmasi()"><i class="glyphicon glyphicon-trash"></i></button></a> -->

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
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Master SMV</b></font></h4>
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
        console.log(rowedit);
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_master_smv.php',
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
<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#style").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
    
                
            });

            
        </script>
</body>
</html>

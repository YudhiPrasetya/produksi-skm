<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>

<?php
	

	// cek apakah yang mengakses halaman ini sudah login
	if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');
    
  }
	?>


<!-- <?php if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing_outerware' OR 
cek_status($_SESSION['username'] ) == 'kenzin' OR 
cek_status($_SESSION['username'] ) == 'kenzin2' OR 
cek_status($_SESSION['username'] ) == 'kenzin3') {
  ?> -->



<center> 
<br><br>
<?php
$error='';
if(isset($_POST['tambah'])){

    $style = $_POST['style_baru'];

    if(tambah_data_style($style)){
      header('Location: master-barang.php');
    } else {
      $error = 'Ada masalah saat menambah data';
    }
  }


if(isset($_POST['update'])){
  $barcode   = $_POST['kode_barcode'];
  $style       = $_POST['id_style'];
  $warna     = $_POST['warna'];
  $size     = $_POST['size'];

  if(!empty(trim($barcode)) && !empty(trim($style)) && !empty(trim($warna)) && !empty(trim($size))){

    if(edit_data_barang($barcode, $style, $warna, $size)){
      header('Location: master-barang.php');
    } else {
      $error = 'Ada masalah saat mengedit data';
    }
  }else{
     $error='Ada data yang masih kosong, wajib di isi semua';
  }
}
 ?>
</center>
<div class="row">
  <div><?= $error; ?>
  <div class="col-sm-4"></div>
 <div class="col-sm-3 tetep">
   <h3><center>Tambah Data Master Barang</center></h3>
   <br>
   <div class="form-group">
   <label>KODE BARCODE</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-barcode"></i>
   </div>
   <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" required>
 </div>
</div>

   <div class="form-group">
   <label>STYLE <br> ( Jika Style Belum Ada Tekan Button Tambahkan Style dibawah )</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-list"></i>
   </div>
   <select id="style" class="form-control" name="style" required>
     <option value="" selected>--- Pilih STYLE ---</option>
       <?php
       $style = tampilkan_style();
       while($pilih = mysqli_fetch_assoc($style)){
       echo '<option value='.$pilih['id_style'].'>'.$pilih['style'].'</option>';

       }
       ?>
     </select>
   </div>
 </div>

   <div class="form-group">
   <label>WARNA</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-tint"></i>
   </div>
   <select id="warna" class="form-control" name="warna" required>
     <option value="" selected>--- Pilih Warna ---</option>
       <?php
       $warna = tampilkan_master_warna();
       while($pilih = mysqli_fetch_assoc($warna)){
       echo '<option value='.$pilih['id_warna'].'>'.strtoupper($pilih['kode_warna']).' - '.ucwords($pilih['warna']).'</option>';

       }
       ?>
     </select>
   </div>
  </div>

   <div class="form-group">
   <label>SIZE</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-text-width"></i>
   </div>
      <input type="text" class="form-control" placeholder="SIZE" name="size" id="size" required>
   </div>
  </div>

   <INPUT type="submit" class="btn btn-primary" name="submit_barcode" value="SIMPAN DATA" id="submit_barang" >
<button type="button" class="btn btn-success cetak" data-toggle="modal" data-target="#myModal">Tambahkan Style Baru</button>
</div>

</form>

<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<center><h4 class="modal-title">TAMBAH STYLE BARU</h4></center>
				</div>
				<!-- body modal -->
				<div class="modal-body">
          <form name="modal_popup"  enctype="multipart/form-data" method="post">
          <div class="form-group">
          <label>STYLE BARU</label>
          <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-list"></i>
          </div>
             <input type="text" class="form-control" placeholder="STYLE BARU" name="style_baru" id="style_baru" required>
          </div>
        </div>

				</div>
				<!-- footer modal -->
				<div class="modal-footer">
          <input name="tambah" type="submit" value="Tambah" id="button" class="btn btn-success cetak" />
				</div>
			</div>
    </form>
		</div>
	</div>
<!-- <div id="hasil"></div> -->
<div class="col-sm-8 diam" id="tampil_tabel"></div>
</div>



<script type="text/javascript">
  $('#submit_barang').on('click',function(){
    var barcode = $('#kode_barcode').val();
    var style = $('#style').val();
    var warna = $('#warna').val();
    var size = $('#size').val();
    $.ajax({
      method: "POST",
      url: "proses_barang.php",
      data: { isi_barcode : barcode,
        id_style : style,
        warna : warna,
        size : size
       },
      success: function(data){
        // $('#tampil_tabel').prepend("<p>" + barcode + "</p>");
        $('#tampil_tabel').load("tampil_barang.php");
      }
    });
    document.getElementById("kode_barcode").value = "";
  });

$(document).ready(function(){
    $('#tampil_tabel').load("tampil_barang.php");
});

// $('#kode_barcode').on('change',function(){
//   $('#tampil_tabel').load(tampil.php);
// });
</script>
<!-- <?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?> -->
</body>
</html>

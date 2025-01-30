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

<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'packing' OR 
  cek_status($_SESSION['username'] ) == 'kenzin' OR 
  cek_status($_SESSION['username'] ) == 'kenzin2' OR 
  cek_status($_SESSION['username'] ) == 'kenzin3' OR 
  cek_status($_SESSION['username'] ) == 'ppic') {
?>
<style>
 ul.list-unstyled{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width: 93%;
        padding-left:40px;
        z-index: 3;
      }
      li.size{
        padding:5px;
        border:thin solid #F0F8FF;
        z-index: 2;
        padding-left:30px;
      }
      li.size:hover{
        background-color:#254681;
        z-index: 2;
        padding-left:30px;
      }
</style>
<center> 
<?php
  $error='';
  if(isset($_POST['tambah'])){
    $style = $_POST['style_baru'];
    if(tambah_data_style($style)){
      header('Location: master-barang.php');
    }else{
      $error = 'Ada masalah saat menambah data';
    }
  }

if(isset($_POST['update'])){
  $barcode  = $_POST['kode_barcode'];
  $style    = $_POST['id_style'];
  $warna    = $_POST['warna'];
  $size     = $_POST['size'];
  $berat     = $_POST['berat'];

  if(!empty(trim($barcode)) && !empty(trim($style)) && !empty(trim($warna)) && !empty(trim($size))){
    if(edit_data_barang($barcode, $style, $warna, $size, $berat)){
      $_SESSION['pesan'] = 'Data Berhasil di edit';
    }else{
      $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
    }
  }else{
    $_SESSION['pesan'] ='Ada data yang masih kosong, wajib di isi semua';
  }
}
?>
</center>

<div style="height:55px;">
  <?php
    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
      echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
    }
      $_SESSION['pesan'] = '';
    ?>
</div>

<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-3 tetep">
    <h3><center>Tambah Master Barang</center></h3>
    <br>
    
    <div class="form-group">
      <label for="kode_barcode">KODE BARCODE</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-barcode"></i>
        </div>
        <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" required>
      </div>
    </div>

    <div class="form-group">
      <label for="style">STYLE <br> ( Jika Style Belum Ada Tekan Button Tambahkan Style dibawah )</label>
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
      <label for="size">SIZE</label>
      <div class="input-group">
        <div class="input-group-addon">  
          <i class="glyphicon glyphicon-text-width"></i>
        </div>
        <input type="text" name="size" id="size" class="form-control" onkeyup="this.value.toUpperCase()" placeholder="Ketikkan Size" />
        </div>
    </div>

    <div class="form-group">
      <label for="warna">WARNA</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-tint"></i>
        </div>
        <input type="text" class="form-control" placeholder="WARNA" name="warna" id="warna" required>
      </div>
    </div>

    <div class="form-group">
      <label for="berat">BERAT (KG)</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-pencil"></i>
        </div>
        <input onchange="setTwoNumberDecimal" min="0" max="10" step="0.01" value="0.00" type="number" class="form-control" placeholder="Berat dalam KG" name="berat" id="berat">
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
<!-- 
<script>  
  $(document).ready(function(){  
    $('#size').keyup(function(){  
      var query = $(this).val();  
      if(query != ''){  
        $.ajax({  
          url:"search-size.php",  
          method:"POST",  
          data:{query:query},  
          success:function(data){  
            $('#sizeList').fadeIn();  
            $('#sizeList').html(data);  
          }  
        });  
      }  
    });  
      
    $(document).on('click', 'li.size', function(){  
      $('#size').val($(this).text());  
      $('#sizeList').fadeOut(); 
    });
  });
</script> -->

<script type="text/javascript">
  $('#submit_barang').on('click',function(){
    var barcode = $('#kode_barcode').val();
    var style = $('#style').val();
    var warna = $('#warna').val();
    var size = $('#size').val();
    var berat = $('#berat').val();
    $.ajax({
      method: "POST",
      url: "proses_barang.php",
      data: { isi_barcode : barcode,
        id_style : style,
        warna : warna,
        size : size,
        berat : berat
       },
      success: function(data){
        $('#tampil_tabel').load("tampil_barang.php");
      }
    });
    document.getElementById("kode_barcode").value = "";
  });

$(document).ready(function(){
    $('#tampil_tabel').load("tampil_barang.php");
});

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

<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?> 

<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600); 
</script>    
</body>
</html>

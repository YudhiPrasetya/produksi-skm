<?php
  require_once 'core/init.php';
  require_once 'view/header.php';
  // date_default_timezone_set('Asia/Jakarta');

  
if(isset($_POST['update'])){
    $barcode  = $_POST['kode_barcode'];
    $style    = $_POST['id_style'];
    $warna    = $_POST['warna'];
    $size     = $_POST['size'];
    $cup     = $_POST['cup'];
    $weight     = $_POST['weight'];
    $qty_barcode     = $_POST['qty_barcode'];
  
    if(!empty(trim($barcode)) && !empty(trim($style)) && !empty(trim($warna)) && !empty(trim($size)) && !empty(trim($qty_barcode))){
      if(edit_data_barang($barcode, $style, $warna, $size, $cup, $qty_barcode, $weight)){
        $_SESSION['pesan'] = 'Data Berhasil di edit';
      }else{
        $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
      }
    }else{
      $_SESSION['pesan'] ='Ada data yang masih kosong, wajib di isi semua';
    }
  }

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

  </div>
<div style="height:55px;">
  <?php
    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
      echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
    }
      $_SESSION['pesan'] = '';
    ?>
</div>

<div class="row" style="margin-left: 20px; margin-right: 20px">

<div class="col-sm-3">
  <font color="#254681"><b>FILTER COSTOMER</font><br></b>
  <select id="costomer" class="form-control ganti" name="costomer" required>
     <option value="">- Pilih Costomer -</option>
       <?php
       $costomer = tampilkan_master_costomer();
       while($pilih = mysqli_fetch_assoc($costomer)){
       echo '<option value='.$pilih['costomer'].'>'.$pilih['costomer'].'</option>';

       }
       ?>
     </select>
  </div>  

  <div class="col-sm-3">
        <font color="#254681"><b> <input type="checkbox" class="ganti" id="check_style" value="pilih_style">FILTER STYLE </b></font> ( CHECKLIST UTK FILTER = )<br>
        <input type="text" id="filter_style" class="form-control ganti" required>
    </div>

    <div class="col-sm-2">
        <font color="#254681"><b>FILTER COLOR</font><br></b>
        <input type="text" id="color" class="form-control ganti" required>
    </div>
<!-- <div id="hasil"></div> -->
<div class="col-sm-12" id="tampil_tabel"></div>
</div>


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

 $('.ganti').on('change',function(){
    $('#tampil_tabel').load("tampil_barang.php");
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

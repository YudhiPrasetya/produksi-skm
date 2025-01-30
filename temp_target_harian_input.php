
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');

?>
<link href="assets/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="assets/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'ie' ) {
  $user = $_SESSION['username'];
  $tanggal = date("Y-m-d");
  $hari = tgl_indonesia_hari(date("D"));

  // if(isset($_POST['kirim'])){
  //   $id_order = $_POST['id_order'];
  //   $username = $_SESSION['username'];
  //   $nilai_smv = $_POST['nilai_smv'];
  //   $date_target = $_POST['date_target']; 
  //   $man_power = $_POST['man_power'];
  //   $jml_jam = $_POST['jml_jam'];
  //   $jml_lembur = $_POST['jml_lembur'];
  //   $id_line = $_POST['line'];
  //   $persentase = $_POST['persentase'];
 
    
    
  //   // if(cek_category_style($style) != 0){  
  //     if(!empty(trim($id_order)) && !empty(trim($username)) && !empty(trim($nilai_smv)) && !empty(trim($date_target)) 
  //     && !empty(trim($man_power)) && !empty(trim($jml_jam)) && !empty(trim($jml_lembur)) && !empty(trim($id_line)) && !empty(trim($persentase))){

  //         if(tambah_data_master_target($id_order, $username, $nilai_smv, $date_target, $man_power, $jml_jam, $jml_lembur, $id_line, $persentase)) {
  //           $_SESSION['pesan'] = 'Data Order Berhasil disimpan';
  //         }else{
  //           echo "gagal menyimpan data";
  //         }
        
          
  //       }else{
  //         $_SESSION['pesan'] = 'Data Masih ada yang kosong silakan diulang';
  //       }
  //     } 
  ?>

<style>
     .modal-dialog{
            width: 1175px;
        }

    thead input {
        width: 100%;
    }
</style>

  
<center>
<h2>INPUT TARGET HARIAN</h2>
<div style="height:55px;">
  <?php
      if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
      echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
      }
      $_SESSION['pesan'] = '';
  ?>
</div>
</center>
</div>
<!-- <form action="temp_target_harian_input.php" method="post"> -->
<div style="margin: 0 30px">
<div class="row">
<div class="col-sm-3">
 <font color="blue"><b>Masukkan ORC</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-shopping-cart"></i>
   </div>
   <!-- <input type="text" name="orc" id="orc" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Tulis No ORC" /> -->
   <input type="text" class="form-control pilcek" id="orc2" style="width: 180px; display: inline-block" disabled >
   <input type="hidden" value = <?= $_SESSION['username']; ?> id="user" >
   <input type="hidden" name="id_order" id="id_order" required >
   <button type="button" class="btn btn-info" id="search_button" style="margin: 0px 0 0 7px;" data-toggle="modal" data-target="#myModal"><b><span class="glyphicon glyphicon-search"></span> Cari</b></button>
 </div>
 <!-- <div id="orcList"></div> -->
</div>

<div class="col-sm-2">
 <font color="blue"><b>COSTOMER</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <input type="checkbox" id="check_costomer" value="pilih_costomer">
   </div>
   <input type="text" id="costomer" class="form-control"  />
 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>No PO</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <input type="checkbox" id="check_po" value="pilih_po">
   </div>
   <input type="text" id="no_po" class="form-control"  />
 </div>
</div>

<div class="col-sm-2">
    <font color="blue"><b>STYLE</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <input type="checkbox" id="check_style" value="pilih_style">
      </div>
      <input type="text" class="form-control" id="style" >
    </div>
  </div>

<div class="col-sm-2">
    <font color="blue"><b>COLOR</font><br></b>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-list-alt "></i>
      </div>
      <input type="text" class="form-control" id="color" disabled>
    </div>
  </div>
  <div class="col-sm-1">
 <font color="blue"><b>NILAI SMV</font><br></b>
  <input type="hidden" name="nilai_smv" id="nilai_smv2" required>
   <input type="text" id="nilai_smv" class="form-control" disabled />

</div>
<br><br><br><br>


<div class="col-sm-2">
<font color="blue"><b>DATE TARGET</font><br></b>
   <div class="input-group">
   <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-calendar"></i>
    </div>
   <input type="date" class="form-control" name="date_target" id="date_target" value="<?= $tanggal; ?>">

 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>MAN POWER</font><br></b>
   <div class="input-group">
   <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-user"></i>
    </div>
   <input type="number" class="form-control" name="man_power" id="man_power">

 </div>
</div>




<div class="col-sm-2">
 <font color="blue"><b>JAM AKTIF</font><br></b>
   <div class="input-group">
   <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-time"></i>
    </div>
   <input type="number" class="form-control" name="jml_jam" id="jml_jam" value="<?php 
   if($hari == 'sabtu'){
    echo 5;
   }elseif($hari == 'minggu'){
    echo 0;
   }else{
    echo 8;
   } ?>" required>
  
 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>MAN POWER LEMBUR</font><br></b>
   <div class="input-group">
   <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-user"></i>
    </div>
   <input type="number" class="form-control" name="man_power_lembur" id="man_power_lembur" value="0" >

 </div>
</div>

<div class="col-sm-2">
 <font color="blue"><b>JAM LEMBUR</font><br></b>
   <div class="input-group">
   <div class="input-group-addon">
        <i class="glyphicon  glyphicon glyphicon-time"></i>
    </div>
   <input type="number" class="form-control" name="jml_lembur" id="jml_lembur" value="0" required>
  
 </div>
</div>



 

<div class="col-sm-2">
 <font color="blue"><b>PERSENTASE TARGET ( % ) </font><br></b>
   <div class="input-group">
   <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
     </div>
   <input type="number" class="form-control" name="persentase" id="persentase" value="100" required>
  
 </div>
</div>

<br><br><br><br>

<div class="col-sm-3">
 <font color="blue"><b>LINE</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
     </div>
     <select id="line" class="form-control" name="line" required >
            <option value="">- Pilih LINE -</option>
              <?php
              $line = tampilkan_master_line(); 
              while($hasil = mysqli_fetch_assoc($line)){
                  echo "<option value = '$hasil[nama_line]'>LINE ". strtoupper($hasil['nama_line'])."</option>";
              }
              ?>
       </select>
  </div>
</div>
   <!-- <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required> -->
   <!-- <input type="submit"  name="submit_barcode" value="TAMBAH" id="submit_barcode" hidden> -->
</div>

</div>
 

 
<!-- Modal Tambah -->
<div class="modal fade" id="myModal" class="modal-backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>Data Order</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
      <div class="lihat-data"></div>  
    </div>
  </div>
  </div>            
</div>
<!-- Modal Tambah -->
</form>

<div id="tampil_tabel"></div>

<center>
    
    <br>
    <div>
    
    <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" id="kirim" style="margin-right: 30px; margin-top: 20px">
    <a href="master_target_harian.php"><button class="btn btn-danger" type="button" >
<i class="glyphicon glyphicon glyphicon-share"></i><b>&nbsp; LIST TARGET</b></button></a>
    <!-- <button type="button" name="kirim" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN</button> -->
  <!-- </form> -->

    </div>


  <script type="text/javascript">
  $('#kirim').on('click',function(){
    swal.fire({
        title: "Anda Yakin ingin Menyimpan Data Target ini?",
        text: "Data yang disimpan tidak bisa di edit lagi!",
        type: "info",

        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Simpan',
        cancelButtonText: "Cancel",
        showCancelButton: true,
        reverseButtons: false,
      }).then((result) => {
        
        if (result.dismiss !== 'cancel') {
          var id_order = $('#id_order').val();
          var user = $('#user').val();
          var nilai_smv = $('#nilai_smv2').val();
          var date_target = $('#date_target').val();
          var man_power = $('#man_power').val();
          var jml_jam = $('#jml_jam').val();
          var man_power_lembur = $('#man_power_lembur').val();
          var jml_lembur = $('#jml_lembur').val();
          var line = $('#line').val();
          var persentase = $('#persentase').val();
          $.ajax({
            method: "POST",
            url: "proses_target_harian.php",
            data: { id_order : id_order,
              user : user,
              nilai_smv : nilai_smv,
              date_target : date_target,
              man_power : man_power,
              jml_jam : jml_jam,
              man_power_lembur : man_power_lembur,
              jml_lembur : jml_lembur,
              line : line,
              persentase : persentase,
              type : "simpan",

            },
            success: function(data){
              console.log(data.trim());
              if(data.trim() == "success"){
                swal("Data Berhasil Disimpan!", "Klik Ok untuk melanjutkan!", "success");
                window.location = "master_target_harian.php";
              }else if(data.trim() == "errorDb"){
                swal("Gagal Error Penyimpanan Database!", "Hubungi IT", "error");
              }else if(data.trim() == "kosong"){
                swal("Gagal Ada Data yang masih kosong!", "Silakan Cek Data Anda", "error");
              }else if(data.trim() == "duplicate"){
                swal("Gagal Duplicate !", "Silakan Cek Data Inputan Target sebelumnya udah pernah di input di tanggal yang sama !", "error");
              }
            }
          });
        }else{
          swal.close();
        }
      });
  });


</script>

<script type="text/javascript">

$(document).ready(function() {
	$('body').on('show.bs.modal','#myModal', function (e) {
        var check_po = $("#check_po:checked").val();
        var check_style = $("#check_style:checked").val();
        var check_costomer = $("#check_costomer:checked").val();
        if(check_po == 'pilih_po'){
          var no_po = $('#no_po').val();
        }else{
          var no_po = '';
        }
        if(check_style == 'pilih_style'){
          var style = $('#style').val();
        }else{
          var style = '';
        }
        
        if(check_costomer == 'pilih_costomer'){
          var costomer = $('#costomer').val();
        }else{
          var costomer = '';
          
        }
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'temp_target_orc.php',
			data: { 
               no_po : no_po,
               style : style,
               costomer : costomer
            },
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});

</script>
<!-- <script src="style/jquery.min.js"></script> -->
<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<script src="assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#line").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
    
            });
        </script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>

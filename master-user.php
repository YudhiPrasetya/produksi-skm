<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<script src="assets/js/select2.min.js"></script>
<?php
	// cek apakah yang mengakses halaman ini sudah login
	if( !isset($_SESSION['username']) ){
    echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
    // header('Location: index.php');
    
  }
	?>


<?php if(cek_status($_SESSION['username'] ) == 'admin') {
?>



<center> 
<br><br>
<?php


if( isset($_POST['tambah'])){
  $username = $_POST['username'];
  $pass =  $_POST['password'];
  $nama = $_POST['nama'];
  $level = $_POST['level'];
  $line = $_POST['line'];

  if(!empty(trim($username)) && !empty(trim($pass)) && !empty(trim($nama)) && !empty(trim($level))){
    //memasukkan ke database
    if(cek_username($username) == 0){
      if(register_user($username, $pass, $nama, $level, $line)){
        $_SESSION['pesan'] = 'Data Berhasil disimpan';
        // header('Location: master-user.php');
      }else{
        $_SESSION['pesan'] = 'gagal';
      }
    }else{
      $_SESSION['pesan'] = 'Username sudah terpakai';
    }

    }else{
      $_SESSION['pesan'] = 'Data tidak boleh ada yang kosong';
    }
  }
    


if(isset($_POST['update'])){
  $id = $_POST['id_user'];
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $level = $_POST['level'];
  $status = $_POST['status'];
  $line = $_POST['line'];

  if(!empty(trim($username)) && !empty(trim($nama)) && !empty(trim($level)) && !empty(trim($status))){

    if(edit_data_user($id, $username, $nama, $level, $status, $line)){
      $_SESSION['pesan'] = 'Data Berhasil diedit';
      
    } else {
      $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
    }
  }else{
    $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
  }
}

if(isset($_POST['lupa'])){
  $id = $_POST['id_user'];
  $password1 = $_POST['password2'];
  $password2 = $_POST['password3'];

  if(!empty(trim($password1)) && !empty(trim($password2))){
    if($password1 == $password2){
    if(lupa_password($id, $password1)){
      header('Location: master-user.php');
    } else {
      $_SESSION['pesan']  = 'Ada masalah saat mengedit data';
    }
  }else{
    $_SESSION['pesan'] ='Konfirmasi Password belum sama silakan ketik ulang lagi !';
  }
  }else{
    $_SESSION['pesan'] ='Ada data yang masih kosong, wajib di isi semua';
  }
  }
 ?>
</center>
</div>
<div style="margin-left: 20px; margin-right: 20px">

  <!-- <div class="col-sm-4"></div> -->
 <div class="col-sm-3">
   <h3><center>Tambah USER BARU</center></h3>
   <br>
   <div class="form-group">
   <form action="master-user.php" method="post" id="form">
   <label for="nama">Nama Lengkap</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="	glyphicon glyphicon-user"></i>
   </div>
   <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="nama" required>
 </div>
</div>

   <div class="form-group">
   <label for="username">Username</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-text-width"></i>
   </div>
      <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
   </div>
 </div>

   <div class="form-group">
   <label>PASSWORD</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-cog"></i>
   </div>
      <input type="password" class="form-control" placeholder="password" name="password" id="password" required>
   </div>
   <input type="checkbox" id="show-hide" name="show-hide" onclick="myFunction()" value="" /> <label for="show-hide" style="color:blue">Lihat Password</label>
  </div>

   <div class="form-group">
   <label for="level">LEVEL</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-th-list"></i>
   </div>
   <select id="level" class="form-control" name="level" required >
            <option value="">- Pilih Level -</option>
              <?php
              $level = tampilkan_level_user();
              while($hasil = mysqli_fetch_assoc($level)){
                  echo "<option value = '$hasil[level]'>".strtoupper($hasil['level'])."</option>";
              }
              ?>
            </select>
   </div>
  </div>

  <div class="form-group">
   <label for="line">LINE SEWING</label>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-th-list"></i>
   </div>
   <select id="line" class="form-control ganti" name="line" required >
    <option value="" selected>-- Pilih Line --</option>
    <option value="" >NOT LINE</option>
        <?php
          $line = tampilkan_master_line();
          while($hasil = mysqli_fetch_assoc($line)){ ?>
              <option value = "<?= $hasil['nama_line'] ?>">LINE <?= strtoupper($hasil['nama_line']) ?></option>
        <?php } ?>
    </select>
   </div>

  </div>
   <INPUT type="submit" class="btn btn-primary" name="tambah" value="SIMPAN DATA" >
</div>

</form>


<div class="col-sm-9" >
<center><h2>MASTER USER</h2></center>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>
<form method="post" action="print_kartu_scan.php" id="form-kirim">            
<table border="1px" class="table table-striped table-bordered data">
  <thead>
  <tr>
    <th class="tengah theader"><input type="checkbox" id="check-all"></th>
    <th class="tengah theader">NAMA LENGKAP</th>
    <th class="tengah theader">USERNAME</th>
    <th class="tengah theader">LEVEL</th>
    <th class="tengah theader">LINE</th>
    <th class="tengah theader">STATUS</th>
    <th class="tengah theader">ACTION</th>
  </tr>
</thead> 
<tbody>
<?php
$no=1;
$tampiluser = tampilkan_user();
while($row=mysqli_fetch_assoc($tampiluser))
{

// $subtotal_qty += $row['qty'];
   ?>

<script type="text/javascript" language="JavaScript">
function konfirmasi()
{
tanya = confirm("Anda Yakin akan menghapus akun Username <?= $row['username']; ?> ?");
if (tanya == true) return true;
else return false;
}
</script>
  <tr>

  <td align='center'><input type="checkbox" class="check-item" name="idtrx[]" value="<?= $row['id_user']; ?>"></td>
  <td class="tengah"><?= ucwords($row['nama']) ?></td>
  <td class="tengah"><?= $row['username']; ?></td>
  <td class="tengah"><?=  ucfirst($row['level']) ?></td>
  <td class="tengah"><?=  ucfirst($row['line']) ?></td>
  <td class="tengah"><?=  ucfirst($row['status']) ?></td>
  <td class="tengah">
    <button type="button"  data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $row['id_user']; ?>"><i class="glyphicon glyphicon-edit"></i></button>
    <a href="hapus_user_satu.php?id=<?= $row['id_user']; ?>"><button type="button" class="btn btn-xs btn-danger kecil" onclick="return konfirmasi()"><i class="glyphicon glyphicon-trash"></i></button></a>
    <button type="button" class="btn btn-warning besar" data-toggle="modal"  data-target="#myLupa" data-id="<?= $row['id_user']; ?>"> Reset PWD</button>
  </td>
  </tr>

  <?php
    $no++;
    }
  ?>
</tbody>

</table>

<center><button name="kirim" type="button" class="btn btn-primary" id="btn-kirim">CETAK KARTU LOGIN</button></center>
</form>
</div>

<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" role="dialog">
<div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data User</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data"></div>
        </div>

    </div>
</div>
</div>
<!-- Modal Edit data kelas-->

<!-- Modal Reset Password-->
<div id="myLupa" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><font face="Calibri" color="red"><b>RESET PASSWORD</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data2"></div>
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

<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-kirim").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin Ingin Mengirim Data ini utk Shipment?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-kirim").submit(); // Submit forM
    });
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
			url	 : 'edit_user.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
<!-- Script ajax menampilkan Edit kelas -->

<!-- Script ajax Reset Password -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myLupa', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'lupa-password.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data2').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>

<!-- melihat password -->
<script>
   function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

       <script>
            $(document).ready(function () {
              $("#level").select2({
                theme: 'bootstrap4',
                placeholder: "Please Select"
              });

                $("#line").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
              });

        </script>
 
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>

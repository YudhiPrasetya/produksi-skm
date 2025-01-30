
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'sewing' ) {
  $user = $_SESSION['username'];
  $proses = 'sewing';
 
  $temp1 = mencari_data_master_transaksi($proses);
  $datatransaksi = mysqli_fetch_array($temp1);
  $table = $datatransaksi['table_transaksi'];
  $temp_table = $datatransaksi['table_temporary'];
  $tipe = $datatransaksi['tipe'];

  $temp2 = tampilkan_line_username($_SESSION['username']);
  $dataline = mysqli_fetch_array($temp2);
  

  if(isset($_POST['update'])){
    $id   = $_POST['id_transaksi'];
    $update_qty_tambah   = $_POST['qty_scan'];
    $balance   = $_POST['balance'];

    $tanggal = date("Y-m-d");
    $jam     = date("H:i:s");

    if(!empty(trim($update_qty_tambah))){
      if($balance <= 0){  
        if(update_tambah_qty_production_idx($tanggal, $jam, $id, $update_qty_tambah, $temp_table)){
          $_SESSION['pesan'] = 'Qty Berhasil Di Edit';
        }else{
          $_SESSION['pesan'] = 'Ada masalah saat mengedit data';
        }
      }else{
        $_SESSION['pesan'] = 'Qty Lebih dari isi Bundle';
      }
    }else{
      $_SESSION['pesan'] = 'Ada data yang masih kosong, wajib di isi semua';
    }
  }
 ?>

<center>
<font color="blue">
<h2>TRANSAKSI INPUT SEWING</h2>
Username Aktif : <?= cek_status($_SESSION['username']) ?></font>

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
<div style="margin: 0 30px">
<div class="row">


 <div class="col-sm-12">
 <font color="blue"><b>Kode Barcode</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-barcode"></i>
   </div>
   <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required>
 </div>

   <!-- <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required> -->
   <input type="submit"  name="submit_barcode" value="TAMBAH" id="submit_barcode" hidden>
</div>

</div>
 

<div id="tampil_tabel"></div>
<form action="simpan_trx_produksi_bundle.php" method="post" 
    <input type="hidden" id="user" name="user" value="<?= $_SESSION['username']; ?>">
    <input type="hidden" id="temp_table" name="temp_table" value="<?= $temp_table ?>">
    <input type="hidden" id="table" name="table" value="<?= $table ?>">
    <input type="hidden" id="proses" name="proses" value="<?= $proses ?>">
    <input type="hidden" id="tipe" name="tipe" value="<?= $tipe ?>">
    <center>
    <div  style="width: 40%; border: 2px solid blue; padding:20px;">
      <font color="blue" align="left"><b>PILIH LINE SEWING</font><br><br></b>
        <div class="input-group">
          <div class="input-group-addon">
          <i class="glyphicon glyphicon-barcode"></i>
        </div>
        <select id="line" class="form-control" name="line" required >
            <option value="">- Pilih LINE -</option>
              <?php
              // $line = tampilkan_master_line();
              $line = tampilkan_master_line_open();
              while($hasil = mysqli_fetch_assoc($line)){
                if($hasil['nama_line'] == $dataline['line']){
                  echo "<option value = '$hasil[nama_line]' selected>Line $hasil[nama_line]</option>";
                }else{
                  echo "<option value = '$hasil[nama_line]'>Line $hasil[nama_line]</option>";
                }
              }
              ?>
            </select>
        </div>
        <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" id="submit_barang" onclick="return konfirmasi_simpan()" style="margin-right: 40px; margin-top: 20px">
        <button type="button" class="btn btn-danger" id="reset" > RESET</button>
        </div>
        

        <br>
    <div>
    
    </div>
    </form>

<script type="text/javascript" src="assets/idle/jquery.idle.js"></script>
<script>
    $(document).idle({
        onIdle: function(){
            window.location="logout.php";                
        },
        idle: 300000
    });
</script>

<script type="text/javascript">
  $('#kode_barcode').on('change',function(){
    var barcode = $('#kode_barcode').val();
    var temp_table = $('#temp_table').val();
    var table = $('#table').val();
    var proses = $('#proses').val();
    var tipe = $('#tipe').val();
    var url = "tampil_trx_produksi.php?trx="+proses;
    $.ajax({
      method: "POST",
      url: "proses_trx_produksi_bundle.php",
      data: { isi_barcode : barcode,
        temp_table : temp_table,
        table : table,
        proses : proses,
        tipe : tipe
      },
      success: function(data){
        console.log(data.trim());
        if(data.trim() == "success"){
          $('#tampil_tabel').load(url);
        }else if(data.trim() == "errorDb"){
          alert("Gagal Ada masalah dengan kode barcode");
        }else if(data.trim() == "error_username"){
          alert("Gagal Username Tidak Sama");
        }else if(data.trim() == "no_proses"){
          Swal.fire({
                  type: 'error',
                  title: 'Gagal Tidak Ada Proses ini di Bundle tersebut.',
                  text: 'Silahkan Hubungi Team IT utk Bantu Cek !',
                  allowEnterKey: false,  
          });
        }else if(data.trim() == "over_bundle"){
          Swal.fire({
                  type: 'error',
                  title: 'Qty Scan Lebih dari QTY Ticket bundle',
                  text: 'Silakan Laporan Sistem Bundle Record  !',
                  allowEnterKey: false,  
          });
        }else if(data.trim() == "over_before"){
          Swal.fire({
                  type: 'error',
                  title: 'Qty Scan Lebih dari Total Scan QTY Ticket di Proses Sebelumnya ',
                  text: 'Silakan Cek di Proses Sebelumnya !',
                  allowEnterKey: false,  
          });
        }else if(data.trim() == "before_no_scan"){
          Swal.fire({
                  type: 'error',
                  title: 'Bundle Belum Di Scan Di Proses Sebelumnya',
                  text: 'Silakan Cek di Proses Sebelumnya !',
                  allowEnterKey: false,  
          });
        }else if(data.trim() == "logout"){
          alert("Session Login Habis data belum masuk, silakan login ulang");
          location.href = "index.php";
        }
      }
    });
    document.getElementById("kode_barcode").value = "";
  });

  $('#reset').on('click',function(){
    swal.fire({
      title: "Anda Yakin ingin Reset hasil scan ini?",
      text: "Data yang Sudah di Reset Tidak Dapat diKembalikan Lagi!",
      type: "warning",

      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Reset',
      cancelButtonText: "Cancel",
      showCancelButton: true,
      reverseButtons: false,
    }).then((result) => {
      if (result.dismiss !== 'cancel') {
         var temp_table = $('#temp_table').val();
          var user = $('#user').val();
          var proses = $('#proses').val();
        $.ajax({
          method: "POST",
          url: "proses_trx_produksi_bundle2.php",
          data: { 
            temp_table : temp_table,
            user : user,
            type : "reset", 
          },
          success: function(data){
            console.log(data.trim()); 
            if(data.trim() == "success"){
              swal("Data Berhasil di Reset!", "Klik Ok untuk melanjutkan!", "success");
              $('#tampil_tabel').load("tampil_trx_produksi.php?trx="+proses);
            }else if(data.trim() == "errorDb"){
              alert("Gagal Ada masalah dengan kode barcode");
            }
          }
        });
      }else {
      swal.close();
    }
  });
  });

  $(document).ready(function(){
    var proses = $('#proses').val();
    var url = "tampil_trx_produksi.php?trx="+proses;
    $('#tampil_tabel').load(url);
  });
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

<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>

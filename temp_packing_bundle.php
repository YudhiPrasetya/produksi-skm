
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing_bundle' ) {
  $user = $_SESSION['username'];
  $proses = 'packing_bundle';
  
  $temp1 = mencari_data_master_transaksi($proses);
  $datatransaksi = mysqli_fetch_array($temp1);
  $table = $datatransaksi['table_transaksi'];
  $temp_table = $datatransaksi['table_temporary'];
  $tipe = $datatransaksi['tipe'];
  
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
<h2>TRANSAKSI PACKING BUNDLE CARTON</h2>
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

<div class="col-sm-2">
 <font color="blue"><b>QTY FULL KARTON</font><br></b>
   <div class="input-group">
     <div class="input-group-addon">
     <i class="glyphicon glyphicon-edit"></i>
     </div>
   <input type="text" class="form-control" placeholder="QTY FULL KARTON" name="qty_karton" id="qty_karton" required>
 </div>
</div>

 <div class="col-sm-10">
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
<form action="simpan_trx_produksi_bundle.php" method="post" >
<center>
    <input type="hidden" id="user" name="user" value="<?= $_SESSION['username']; ?>">
    <input type="hidden" id="temp_table" name="temp_table" value="<?= $temp_table ?>">
   <input type="hidden" id="table" name="table" value="<?= $table ?>">
   <input type="hidden" id="proses" name="proses" value="<?= $proses ?>">
   <input type="hidden" id="tipe" name="tipe" value="<?= $tipe ?>">
   <center>
  <div  style="width: 40%; border: 2px solid blue; padding:20px;">
    <br>
    <b><font color="blue">Pastikan Pilihan Kelompok Karton Benar Sebelum Disimpan</font></b>
    <br><br>
  
    <div class="col-sm-12">
      <font color="red"><b>Kelompok Karton</b>
        <select class="form-control pilcek3" name="kelompok" id="kelompok" >
          <option value="">--- Pilih Kelompok Karton ---</option>
          <option value="full">Full Karton (No Mix)</option>
          <option value="ecer">Isi Karton Tidak Full</option>
          <option value="mix">MIX SIZE</option>
          <!-- <option value="mix_color">Mix Color</option> -->
          <option value="mix_style">MIX STYLE</option>
        </select>
    </div>
    <br>
    <div>
     <button type="button" id="kirim_js" name="kirim" class="btn btn-primary" >SIMPAN</button>
      <!-- <a href="hapus_packing.php" name="reset"> -->
      <button type="button" class="btn btn-danger" id="reset" > RESET</button>
    </a>
    </a>
    </div> 
    </form>
</center>
    <br>
    <div>
    
    </div>
    </form>

<script type="text/javascript" src="assets/idle/jquery.idle.js"></script>


    
<script type="text/javascript">
  $('#kode_barcode').on('change',function(){
    var qty_karton = $('#qty_karton').val();
    if(qty_karton == ""){ 
        alert("QTY KARTON MASIH KOSONG");
    }else{
    var barcode = $('#kode_barcode').val();
    var temp_table = $('#temp_table').val();
    var table = $('#table').val();
    var proses = $('#proses').val();
    var user = $('#user').val();
    var tipe = $('#tipe').val();
    var url = "tampil_trx_produksi.php?trx="+proses;
    
    }
    $.ajax({
      method: "POST",
      url: "proses_trx_produksi_bundle.php",
      data: { isi_barcode : barcode,
        temp_table : temp_table,
        table : table,
        proses : proses,
        user : user,
        tipe : tipe,
        qty_karton : qty_karton
      },
      success: function(data){
        console.log(data.trim());
        if(data.trim() == "success"){
          $('#tampil_tabel').load(url);
        }else if(data.trim() == "errorDb"){
          alert("Gagal Ada masalah dengan kode barcode");
        }else if(data.trim() == "error_username"){
          alert("Gagal Username Tidak Sama");
        }else if(data.trim() == "over_ctn"){
          Swal.fire({
                  type: 'error',
                  title: 'Gagal Melebihi Quantity Muatan Karton.',
                  text: 'Cek Kembali Data Scan',
                  allowEnterKey: false,  
          });
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
        }
      }
    });
    document.getElementById("kode_barcode").value = "";
  });


  $('#kirim_js').on('click',function(){
    var yakin = confirm("Anda Yakin Ingin Menyimpan Data Scan ini, Pastiin data sesuai !");
    if (yakin) {
      var kelompok = $('#kelompok').val();
      var temp_table = $('#temp_table').val();
      var table = $('#table').val();
      var proses = $('#proses').val();
      var user = $('#user').val();
      var qty_karton = $('#qty_karton').val();
      if (kelompok != "") {
      
        $.ajax({
          method: "POST",
          url: "proses_packing.php",
          data: { 
            kelompok : kelompok,
            temp_table : temp_table,
            table : table, 
            proses : proses,
            qty_karton : qty_karton,
            type : "simpan_packing_bundle"
          },
          success: function(data){
            console.log(data.trim()); 
            if(data.trim() == "success"){
              alert("Berhasil Menyimpan data");
              document.getElementById("kelompok").value = "";
              $('#tampil_tabel').load("tampil_trx_produksi.php?trx="+proses);
            }else if(data.trim() == "error_buyer"){
              alert("Silakan Cek Data Scan, Ada Scan Lebih dari 1 Buyer di dlm satu karton !");
            }else if(data.trim() == "over_before"){
              alert("Qty lebih dari scan proses sebelumnya, Silkan Refresh Halaman, utk Melihat Ulang Transaksi, ada scan masuk baru dari user lain !");
            }else if(data.trim() == "over_bundle"){
              alert("Qty lebih dari Qty Bundle, Silkan Refresh Halaman, utk Melihat Ulang Transaksi, ada scan masuk baru dari user lain !");
            }else if(data.trim() == "over_carton"){
              alert("Qty Scan Lebih dari Qty ISI Full Carton");
            }else if(data.trim() == "error_full_ecer"){
              alert("Salah pilih Harusnya Isi Karton Tidak Full, kelompok yg dipilih malah FULL KARTON. Silahkan Ganti !");
            }else if(data.trim() == "error_ecer_full"){
              alert("Salah pilih Harusnya Full Karton, kelompok yg dipilih malah Isi Carton Tidak Full. Silahkan Ganti !");
            }else if(data.trim() == "error_mix_full"){
              alert("Salah pilih Harusnya Full Karton, kelompok yg dipilih malah MIX SIZE. Silahkan Ganti !");
            }else if(data.trim() == "error_mix_ecer"){
              alert("Salah pilih Harusnya ISI KARTON TIDAK FULL, kelompok yg dipilih malah MIX SIZE. Silahkan Ganti !");
            }else if(data.trim() == "error_mixstyle_ecer"){
              alert("Salah pilih Harusnya MIX STYLE, kelompok yg dipilih malah ISI KARTON TIDAK FULL. Silahkan Ganti !");
            }else if(data.trim() == "error_mixstyle_full"){
              alert("Salah pilih Harusnya FULL, kelompok yg dipilih malah MIX STYLE. Silahkan Ganti !");
            }else if(data.trim() == "error_full_mix"){
              alert("Salah pilih Harusnya MIX SIZE, kelompok yg dipilih malah FULL KARTON. Silahkan Ganti !");
            }else if(data.trim() == "error_ecer_mix"){
              alert("Salah pilih Harusnya MIX SIZE, kelompok yg dipilih malah ISI KARTON TIDAK FULL. Silahkan Ganti !");
            }else if(data.trim() == "error_mixstyle_mix"){
              alert("Salah pilih Harusnya MIX SIZE, kelompok yg dipilih malah MIX STYLE. Silahkan Ganti !");
            }else if(data.trim() == "error_full_mixstyle"){
              alert("Salah pilih Harusnya MIX STYLE, kelompok yg dipilih malah FULL KARTON. Silahkan Ganti !");
            }else if(data.trim() == "error_ecer_mixstyle"){
              alert("Salah pilih Harusnya MIX STYLE, kelompok yg dipilih malah ISI KARTON TIDAK FULL KARTON. Silahkan Ganti !");
            }else if(data.trim() == "error_mix_mixstyle"){
              alert("Salah pilih Harusnya MIX STYLE, kelompok yg dipilih malah MIX SIZE. Silahkan Ganti !");
            }else if(data.trim() == "errorDb"){
              alert("Gagal Ada masalah dengan kode barcode");
            }
          }
        });
    
  }else{
			alert('Kelompok Karton harus dipilih terlebih dahulu !');
	}
}else {
      return false;
}
});


$('#reset').on('click',function(){
  var yakin = confirm("Anda Yakin Akan Mereset Hasil Scan Data Ini, data akan terhapus semua ?");
    if (yakin) {
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
          alert("Data Berhasil di Reset");
          document.getElementById("kelompok").value = "";
          $('#tampil_tabel').load("tampil_trx_produksi.php?trx="+proses);
        }else if(data.trim() == "errorDb"){
          alert("Gagal Ada masalah dengan kode barcode");
        }
      }
    });
  }else {
      return false;
  }
  });


  $(document).ready(function(){
    var proses = $('#proses').val();
    var url = "tampil_trx_produksi.php?trx="+proses;
    $('#tampil_tabel').load(url);
  });
</script>




<script type="text/javascript">
  $(document).on('click', '.pilih', function (e) {
    document.getElementById("orc").value = $(this).attr('data-order');
    document.getElementById("orc2").value = $(this).attr('data-order');
    document.getElementById("no_po").value = $(this).attr('data-po');
    document.getElementById("label").value = $(this).attr('data-label');
    document.getElementById("buyer").value = $(this).attr('data-costomer');
    $('#myModal').modal('hide');
  });
			

// tabel lookup mahasiswa
    $(function () {
      $("#lookup").dataTable();
    });
 
</script>

<!-- <script src="style/jquery.min.js"></script> -->
<script>
  $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
  setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<!-- // penutup hak akses level -->
<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
</body>
</html>

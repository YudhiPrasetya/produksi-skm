
<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'kensa' ) {
  $user = $_SESSION['username'];
  ?>


<center>
<h2>TRANSAKSI QC KENSA</h2>
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
   <input type="hidden" id="user" value="<?= $user; ?>">
   <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required>
 </div>

   <!-- <input type="text" class="form-control" placeholder="KODE BARCODE" name="kode_barcode" id="kode_barcode" autofocus required> -->
   <input type="submit"  name="submit_barcode" value="TAMBAH" id="submit_barcode" hidden>
</div>

</div>
 

<div id="tampil_tabel"></div>
<form action="simpan_master_qc_kensa.php" method="post" >
<center>
    <input type="hidden" name="user" value="<?= $_SESSION['username']; ?>">
    <br>
    <div>
    <!-- <button type="button" class="btn btn-danger" >RESET</button> -->
    <!-- <a href="simpan_master_packing.php" name="simpan"><button type="button" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN</button></a> -->
    <INPUT type="submit" class="btn btn-primary" name="kirim" value="SIMPAN DATA" id="submit_barang" onclick="return konfirmasi_simpan()" style="margin-right: 40px; margin-top: 20px">
    <!-- <button type="button" name="kirim" class="btn btn-primary" onclick="return konfirmasi_simpan()">SIMPAN</button> -->
    <a href="hapus_qc_kensa.php" name="reset"><button type="button" class="btn btn-danger" onclick="return konfirmasi()"> RESET</button></a>
    </div>
    </form>
<script type="text/javascript">
  $('#kode_barcode').on('change',function(){
    var barcode = $('#kode_barcode').val();
    var user = $('#user').val();
    $.ajax({
      method: "POST",
      url: "proses_qc_kensa.php",
      data: { isi_barcode : barcode,
        user : user
      },
      success: function(data){
        console.log(data.trim());
        if(data.trim() == "success"){
          $('#tampil_tabel').load("tampil_qc_kensa.php");
        }else if(data.trim() == "errorDb"){
          alert("Gagal Ada masalah dengan kode barcode");
        }else if(data.trim() == "errorQtyOrder"){
          alert("Gagal Qty Sudah Memenuhi Order Atau Tidak Ada Orderan untuk Label ini");
        }
      }
    });
    document.getElementById("kode_barcode").value = "";
  });

  $(document).ready(function(){
    $('#tampil_tabel').load("tampil_qc_kensa.php");
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

<?php
  require_once 'core/init.php';
  require_once 'view/header.php';
  // date_default_timezone_set('Asia/Jakarta');
  $error='';
  if(cek_status($_SESSION['username'] ) == 'admin' OR 
  cek_status($_SESSION['username'] ) == 'packing' OR 
  cek_status($_SESSION['username'] ) == 'kenzin') {
?>
<br>  
<style type="text/css" class="init">
	div.dataTables_wrapper {
		width: 100%;
		margin: 0 auto;
	}
	</style>
    <script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#example').DataTable( {
				"scrollX": true
			} );
		} );
</script>
  
<center><h2>DATA REJECT PACKING</h2></center>
</div>
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
<div style="margin-left: 15px; margin-right:15px">
  <form method="post" action="kirim_balik_reject_packing.php" id="form-kirim">
  <table id="example" border="1px" width="110%"  class="table table-striped table-bordered data">
    <thead>
      <tr>
        <th style="background-color: #8A2BE2; color: #ffffff; vertical-align:middle" rowspan="2"><input type="checkbox" id="check-all"></th>
        <th style="background-color: #8A2BE2; color: #ffffff; vertical-align:middle" rowspan="2" ><center>No TRX</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff; vertical-align:middle" rowspan="2" ><center>WAKTU SCAN</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff; vertical-align:middle" rowspan="2"><center>STYLE</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff; vertical-align:middle" colspan=11><center>SIZE</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff; vertical-align:middle" rowspan="2"><center>TOT</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff; vertical-align:middle" rowspan="2"><center>KETERANGAN</center></th>
      </tr>
      <tr>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>SS</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>S</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>M</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>L</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>LL</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>3L</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>4L</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>5L</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>6L</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>7L</center></th>
        <th style="background-color:#8A2BE2; color: #ffffff"><center>8L</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no=1;
        $laporan3 = transaksi_reject_packing();
        while($pilih2 = mysqli_fetch_array($laporan3)){
      ?>
      <tr class="belang">
        <td align='center'><input type="checkbox" class="check-item" name="id[]" value="<?= $pilih2['ids_to_delete']; ?>"></td>
        <td align='center'><?= $pilih2['no_karton']; ?></td>
        <td align='center'><?= tgl_indonesia2($pilih2['waktu_reject']) ?></td>
        <td align='center'><?= $pilih2['style'] ?></td>
        <td align='center' ><?= $pilih2['size_ss']; ?></td>
        <td align='center'><?= $pilih2['size_s']; ?></td>
        <td align='center'><?= $pilih2['size_m']; ?></td>
        <td align='center'><?= $pilih2['size_l']; ?></td>
        <td align='center'><?= $pilih2['size_ll']; ?></td>
        <td align='center'><?= $pilih2['size_3l']; ?></td>
        <td align='center'><?= $pilih2['size_4l']; ?></td>
        <td align='center'><?= $pilih2['size_5l']; ?></td>
        <td align='center'><?= $pilih2['size_6l']; ?></td>
        <td align='center'><?= $pilih2['size_7l']; ?></td>
        <td align='center'><?= $pilih2['size_8l']; ?></td>
        <td align='center'><?= $pilih2['jumlah_size']; ?></td>
        <td align='center'><?= $pilih2['keterangan']; ?></td>
      </tr>
        <?php
          $no++;
          }
        ?>
    </tbody>
  </table>
  <br>
<center>
  <div style="width: 550px; border: 2px solid #8A2BE2; padding:20px;">
    <b><font color="8A2BE2">BATAL REJECT BALIKAN BARANG KE PACKING</font></b>
    <br>  
   
        <button  type="button" class="btn btn-primary" id="btn-kirim">KIRIM BALIK KE PACKING</button>
       
      
  </form>
  </center>
  </div>
</div>
<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-kirim").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin Ingin Melakukan Reject utk Barang ini?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-kirim").submit(); // Submit form

        
    });
  });
  </script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});

</script>

<script src="style/jquery.min.js"></script>
        <script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
        </script>

<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>

</body>
</html>

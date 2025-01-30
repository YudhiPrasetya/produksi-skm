<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
$error='';
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'shipment') {
  ?>
<br><br>
  
<center><h2>DATA SHIPMENT STATUS AKTIF</h2></center>
</div>
<div style="height:55px;">
                 <?php
                    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    echo '<div id="pesan" class="alert alert-success" style="display:none;">'.$_SESSION['pesan'].'</div>';
                    }
                    $_SESSION['pesan'] = '';
                ?>
            </div>
</div>
<br>

<!-- <div class="container"> -->
<div style="margin-left: 15px; margin-right:15px">
<center>
<?php 
  $laporan2 = tampilkan_laporan_shipment_a_hidesize();
  $pilih3 = mysqli_fetch_array($laporan2);
?>
<form method="post" action="reject-ke-packing.php" id="form-kirim">
<table border="1px" id="example" class="table table-striped table-bordered data">
<thead>
      <tr>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><input type="checkbox" id="check-all"></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>No TRX</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TANGGAL</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>NO INVOICE</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>NO PO</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>LABEL</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>STYLE</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>COLOR</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" colspan="
         <?php 
            if($pilih3['size_ss'] > 0){ $c_ss = 0; }else{ $c_ss = 1; }
            if($pilih3['size_s'] > 0){ $c_s = 0; }else{ $c_s = 1; }
            if($pilih3['size_m'] > 0){ $c_m = 0; }else{ $c_m = 1; }
            if($pilih3['size_l'] > 0){ $c_l = 0; }else{ $c_l = 1; }
            if($pilih3['size_ll'] > 0){ $c_ll = 0; }else{ $c_ll = 1; }
            if($pilih3['size_3l'] > 0){ $c_3l = 0; }else{ $c_3l = 1; }
            if($pilih3['size_4l'] > 0){ $c_4l = 0; }else{ $c_4l = 1; }
            if($pilih3['size_5l'] > 0){ $c_5l = 0; }else{ $c_5l = 1; }
            if($pilih3['size_6l'] > 0){ $c_6l = 0; }else{ $c_6l = 1; }
            if($pilih3['size_7l'] > 0){ $c_7l = 0; }else{ $c_7l = 1; }
            if($pilih3['size_8l'] > 0){ $w96 = 0; }else{ $c_8l = 1; }
            $total_hide = 11 - ($c_ss + $c_s + $c_m + $c_l + $c_ll + $c_3l + $c_4l + $c_5l + $c_6l + $c_7l + $c_8l);
            echo $total_hide;
     ?>"><center>SIZE</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TOT</center></th>
      </tr>  
      <tr>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;"><center>SS</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_s'] == 0){ echo "none"; } ?>;"><center>S</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_m'] == 0){ echo "none"; } ?>;"><center>M</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_l'] == 0){ echo "none"; } ?>;"><center>L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_ll'] == 0){ echo "none"; } ?>;"><center>LL</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_3l'] == 0){ echo "none"; } ?>;"><center>3L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_4l'] == 0){ echo "none"; } ?>;"><center>4L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_5l'] == 0){ echo "none"; } ?>;"><center>5L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_6l'] == 0){ echo "none"; } ?>;"><center>6L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_7l'] == 0){ echo "none"; } ?>;"><center>7L</center></th>
        <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_8l'] == 0){ echo "none"; } ?>;"><center>8L</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no=1;
        $laporan3 = transaksi_shipment();
        while($pilih2 = mysqli_fetch_array($laporan3)){
      ?>
      <tr class="belang">
        <td align='center'><input type="checkbox" class="check-item" name="id[]" value="<?= $pilih2['ids_to_delete']; ?>"></td>
        <td align='center'><?= $pilih2['no_karton']; ?></td>
        <td align='center'><?= tanggal_indo3($pilih2['tanggal_scan'], true) ?></td>
        <td align='center'><?= $pilih2['no_invoice']; ?></td>
        <td align='center'><?= $pilih2['no_po']; ?></td>
        <td align='center' ><?= $pilih2['label']; ?></td>
        <td align='center'><?= $pilih2['style'] ?></td>
        <td align='center'><?= $pilih2['warna'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_ss']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_s'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_s']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_m'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_m']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_ll'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_ll']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_3l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_3l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_4l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_4l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_5l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_5l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_6l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_6l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_7l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_7l']; ?></td>
        <td align='center' style="display: <?php if($pilih3['size_8l'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_8l']; ?></td>
        <td align='center' style="background-color: #87CEEB;"><b><?= $pilih2['jumlah_size']; ?></b></td>
       </tr>
      <?php
        $no++;
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th class="tengah"></th>
        <th class="tengah">No TRX</th>
        <th class="tengah">TANGGAL</th>
        <th class="tengah">INVOICE</th>
        <th class="tengah">NO PO</th>
        <th class="tengah">LABEL</th>
        <th class="tengah">STYLE</th>
        <th class="tengah">COLOR</th>
        <th class="tengah" style="display: <?php if($pilih3['size_ss'] == 0){ echo "none"; } ?>;">SS</th>
        <th class="tengah" style="display: <?php if($pilih3['size_s'] == 0){ echo "none"; } ?>;">S</th>
        <th class="tengah" style="display: <?php if($pilih3['size_m'] == 0){ echo "none"; } ?>;">M</th>
        <th class="tengah" style="display: <?php if($pilih3['size_l'] == 0){ echo "none"; } ?>;">L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_ll'] == 0){ echo "none"; } ?>;">LL</th>
        <th class="tengah" style="display: <?php if($pilih3['size_3l'] == 0){ echo "none"; } ?>;">3L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_4l'] == 0){ echo "none"; } ?>;">4L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_5l'] == 0){ echo "none"; } ?>;">5L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_6l'] == 0){ echo "none"; } ?>;">6L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_7l'] == 0){ echo "none"; } ?>;">7L</th>
        <th class="tengah" style="display: <?php if($pilih3['size_8l'] == 0){ echo "none"; } ?>;">8L</th>
        <th class="tengah">TOTAL</th>
      </tr>
    </tfoot>
</table>
<br>
<div style="width: 500px; border: 2px solid red; padding:20px;">
<center>
<b><font color="red">TEKAN REJECT UNTUK MENGEMBALIKAN DATA KE PACKING</font></b><br>
      <button type="button" class="btn btn-danger" id="btn-kirim">REJECT KE PACKING</button>
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
      var confirm = window.confirm("Apakah Anda yakin ingin mengembalikan data ini ke packing?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-kirim").submit(); // Submit form
    });
  });
  </script>

<!-- <script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});

</script> -->

<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>

<script>
            $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
            setTimeout(function(){$("#pesan").fadeOut('slow');}, 3600);
</script>

<?php } else {
  echo 'Anda tidak memiliki akses kehalaman ini'; } ?>

</body>
</html>

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
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" colspan="7"><center>SIZE</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TOT</center></th>
      </tr> 
      <tr>
      <th style="background-color:#f44336; color: #ffffff;"><center>7</center></th>
        <th style="background-color:#f44336; color: #ffffff;"><center>9</center></th>
        <th style="background-color:#f44336; color: #ffffff;"><center>11</center></th>
        <th style="background-color:#f44336; color: #ffffff;"><center>13</center></th>
        <th style="background-color:#f44336; color: #ffffff;"><center>15</center></th>
        <th style="background-color:#f44336; color: #ffffff;"><center>17</center></th>
        <th style="background-color:#f44336; color: #ffffff;"><center>19</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no=1;
        $laporan3 = transaksi_shipment_c();
        while($pilih2 = mysqli_fetch_array($laporan3)){
      ?>
      <tr class="belang">
        <td align='center'><input type="checkbox" class="check-item" name="id[]" value="<?= $pilih2['ids_to_delete']; ?>"></td>
        <td align='center'><?= $pilih2['no_karton']; ?></td>
        <td align='center'><?= tanggal_indo3($pilih2['tanggal_scan'], true) ?></td>
        <td align='center'><?= $pilih2['no_invoice']; ?></td>
        <td align='center'><?= $pilih2['no_po']; ?></td>
        <td align='center' ><?= $pilih2['label']; ?></td>
        <td align='center'><?= $pilih2['style']; ?></td>
        <td align='center'><?= $pilih2['warna'];  ?></td>
        <td align='center'><?= $pilih2['size_7']; ?></td>
        <td align='center'><?= $pilih2['size_9']; ?></td>
        <td align='center'><?= $pilih2['size_11']; ?></td>
        <td align='center'><?= $pilih2['size_13']; ?></td>
        <td align='center'><?= $pilih2['size_15']; ?></td>
        <td align='center'><?= $pilih2['size_17']; ?></td>
        <td align='center'><?= $pilih2['size_19']; ?></td>
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
        <th class="tengah">NO INVOICE</th>
        <th class="tengah">NO PO</th>
        <th class="tengah">LABEL</th>
        <th class="tengah">STYLE</th>
        <th class="tengah">WARNA</th>
        <th class="tengah">7</th>
        <th class="tengah">9</th>
        <th class="tengah">11</th>
        <th class="tengah">13</th>
        <th class="tengah">15</th>
        <th class="tengah">17</th>
        <th class="tengah">19</th>
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

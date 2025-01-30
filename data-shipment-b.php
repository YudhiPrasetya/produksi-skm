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
  $laporan2 = tampilkan_laporan_shipment_b_hidesize();
  $pilih3 = mysqli_fetch_array($laporan2);
?>
<form method="post" action="reject-ke-packing.php" id="form-kirim">
<table border="1px" id="example" class="table table-striped table-bordered data">
<thead>
      <tr>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><input type="checkbox" id="check-all"></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>No TRX</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TANGGAL</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>No Invoice</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>NO PO</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>LABEL</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>STYLE</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>COLOR</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" colspan="
         <?php 
            if($pilih3['size_w70'] > 0){ $w70 = 0; }else{ $w70 = 1; }
            if($pilih3['size_w73'] > 0){ $w73 = 0; }else{ $w73 = 1; }
            if($pilih3['size_w76'] > 0){ $w76 = 0; }else{ $w76 = 1; }
            if($pilih3['size_w79'] > 0){ $w79 = 0; }else{ $w79 = 1; }
            if($pilih3['size_w82'] > 0){ $w82 = 0; }else{ $w82 = 1; }
            if($pilih3['size_w85'] > 0){ $w85 = 0; }else{ $w85 = 1; }
            if($pilih3['size_w88'] > 0){ $w88 = 0; }else{ $w88 = 1; }
            if($pilih3['size_w90'] > 0){ $w90 = 0; }else{ $w90 = 1; }
            if($pilih3['size_w91'] > 0){ $w91 = 0; }else{ $w91 = 1; }
            if($pilih3['size_w95'] > 0){ $w95 = 0; }else{ $w95 = 1; }
            if($pilih3['size_w96'] > 0){ $w96 = 0; }else{ $w96 = 1; }
            if($pilih3['size_w100'] > 0){ $w100 = 0; }else{ $w100 = 1; }
            if($pilih3['size_w105'] > 0){ $w105 = 0; }else{ $w105 = 1; }
            if($pilih3['size_w106'] > 0){ $w106 = 0; }else{ $w106 = 1; }
            if($pilih3['size_w110'] > 0){ $w110 = 0; }else{ $w110 = 1; }
            if($pilih3['size_w115'] > 0){ $w115 = 0; }else{ $w115 = 1; }
            if($pilih3['size_w120'] > 0){ $w120 = 0; }else{ $w120 = 1; }
            if($pilih3['size_w125'] > 0){ $w125 = 0; }else{ $w125 = 1; }
            if($pilih3['size_w130'] > 0){ $w130 = 0; }else{ $w130 = 1; }
            if($pilih3['size_100'] > 0){ $s100 = 0; }else{ $s100 = 1; }
            if($pilih3['size_110'] > 0){ $s110 = 0; }else{ $s110 = 1; }
            if($pilih3['size_120'] > 0){ $s120 = 0; }else{ $s120 = 1; }
            if($pilih3['size_130'] > 0){ $s130 = 0; }else{ $s130 = 1; }
            if($pilih3['size_140'] > 0){ $s140 = 0; }else{ $s140 = 1; }
            if($pilih3['size_150'] > 0){ $s150 = 0; }else{ $s150 = 1; }
            if($pilih3['size_86_3'] > 0){ $s86_3 = 0; }else{ $s86_3 = 1; }
            if($pilih3['size_90_4'] > 0){ $s90_4 = 0; }else{ $s90_4 = 1; }
            if($pilih3['size_94_5'] > 0){ $s94_5 = 0; }else{ $s94_5 = 1; }
            if($pilih3['size_98_6'] > 0){ $s98_6 = 0; }else{ $s98_6 = 1; }
            $total_hide = 19 - ($w70 + $w73 + $w76 + $w79 + $w82 + $w85 + $w88 + $w90 + $w91 + $w95 + $w96 + $w100
            + $w105 + $w106 + $w110 + $w115 + $w120 + $w125 + $w130);
            echo $total_hide;
          ?>"><center>SIZE</center></th>
         <th style="background-color: #f44336; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TOT</center></th>
      </tr> 
      <tr>
      <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><center>W70</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><center>W73</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><center>W76</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><center>W79</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><center>W82</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><center>W85</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><center>W88</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><center>W90</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><center>W91</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><center>W95</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><center>W96</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><center>W100</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><center>W105</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><center>W106</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><center>W110</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><center>W115</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><center>W120</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><center>W125</center></th>
    <th style="background-color:#f44336; color: #ffffff; display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><center>W130</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no=1;
        $laporan3 = transaksi_shipment_b();
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
        <td align='center' style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w70'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w73'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w76'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w79'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w82'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w85'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w88'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w90'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w91'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w95'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w96'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w100'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w105'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w106'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w110'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w115'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w120'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w125'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w130'] ?></td>
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
        <th class="tengah" style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;">W70</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;">W73</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;">W76</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;">W79</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;">W82</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;">W85</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;">W88</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;">W90</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;">W91</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;">W95</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;">W96</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;">W100</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;">W105</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;">W106</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;">W110</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;">W115</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;">W120</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;">W125</th>
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

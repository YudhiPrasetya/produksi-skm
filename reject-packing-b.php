<?php
require_once 'core/init.php';
require_once 'view/header.php';
// date_default_timezone_set('Asia/Jakarta');
$error='';
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing' OR 
cek_status($_SESSION['username'] ) == 'kenzin') {
  ?>
<br><br>

  
<center><h2>DATA SCAN PACKING UNTUK TRANSAKSI REJECT BARANG</h2></center>
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
<form method="post" action="kirim-reject-packing.php" id="form-kirim">
<?php 
  $laporan2 = tampilkan_laporan_packing_b_hidesize();
  $pilih3 = mysqli_fetch_array($laporan2);
?>
  <table border="1px" id="tabel" class="table table-striped table-bordered data">
    <thead>
      <tr>
         <th style="background-color: #FF0000; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><input type="checkbox" id="check-all"></th>
         <th style="background-color: #FF0000; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>No TRX</center></th>
         <th style="background-color: #FF0000; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TANGGAL</center></th>
         <th style="background-color: #FF0000; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>NO PO</center></th>
         <th style="background-color: #FF0000; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>LABEL</center></th>
         <th style="background-color: #FF0000; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>STYLE</center></th>
         <th style="background-color: #FF0000; color: #ffffff; vertical-align:middle; color: #ffffff" colspan="
         <?php 
            if($pilih3['size_w70'] > 0){ $w70 = 0; }else{ $w70 = 1; }
            if($pilih3['size_w71'] > 0){ $w71 = 0; }else{ $w71 = 1; }
            if($pilih3['size_w72'] > 0){ $w72 = 0; }else{ $w72 = 1; }
            if($pilih3['size_w73'] > 0){ $w73 = 0; }else{ $w73 = 1; }
            if($pilih3['size_w74'] > 0){ $w74 = 0; }else{ $w74 = 1; }
            if($pilih3['size_w75'] > 0){ $w75 = 0; }else{ $w75 = 1; }
            if($pilih3['size_w76'] > 0){ $w76 = 0; }else{ $w76 = 1; }
            if($pilih3['size_w77'] > 0){ $w77 = 0; }else{ $w77 = 1; }
            if($pilih3['size_w78'] > 0){ $w78 = 0; }else{ $w78 = 1; }
            if($pilih3['size_w79'] > 0){ $w79 = 0; }else{ $w79 = 1; }
            if($pilih3['size_w80'] > 0){ $w80 = 0; }else{ $w80 = 1; }
            if($pilih3['size_w81'] > 0){ $w81 = 0; }else{ $w81 = 1; }
            if($pilih3['size_w82'] > 0){ $w82 = 0; }else{ $w82 = 1; }
            if($pilih3['size_w83'] > 0){ $w83 = 0; }else{ $w83 = 1; }
            if($pilih3['size_w84'] > 0){ $w84 = 0; }else{ $w84 = 1; }
            if($pilih3['size_w85'] > 0){ $w85 = 0; }else{ $w85 = 1; }
            if($pilih3['size_w86'] > 0){ $w86 = 0; }else{ $w86 = 1; }
            if($pilih3['size_w87'] > 0){ $w87 = 0; }else{ $w87 = 1; }
            if($pilih3['size_w88'] > 0){ $w88 = 0; }else{ $w88 = 1; }
            if($pilih3['size_w89'] > 0){ $w89 = 0; }else{ $w89 = 1; }
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
            $total_hide = 32 - ($w70 + $w71 + $w72 + $w73 + $w74 + $w75 + $w76 + $w77 + $w78 + $w79 + $w80 + $w81 + 
                $w82 + $w83 + $w84 + $w85 + $w86 + $w87 + $w88 + $w89 + $w90 + $w91 + $w95 + $w96 + $w100
            + $w105 + $w106 + $w110 + $w115 + $w120 + $w125 + $w130);
            echo $total_hide;
          ?>"><center>SIZE</center></th>
         <th style="background-color: #FF0000; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TOT</center></th>
      </tr> 
      <tr>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><center>W70</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><center>W71</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><center>W72</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><center>W73</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><center>W74</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><center>W75</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><center>W76</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><center>W77</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><center>W78</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><center>W79</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><center>W80</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><center>W81</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><center>W82</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><center>W83</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><center>W84</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><center>W85</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><center>W86</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><center>W87</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><center>W88</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><center>W89</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w90'] == 0){ echo "none"; } ?>;"><center>W90</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w91'] == 0){ echo "none"; } ?>;"><center>W91</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w95'] == 0){ echo "none"; } ?>;"><center>W95</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w96'] == 0){ echo "none"; } ?>;"><center>W96</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w100'] == 0){ echo "none"; } ?>;"><center>W100</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w105'] == 0){ echo "none"; } ?>;"><center>W105</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w106'] == 0){ echo "none"; } ?>;"><center>W106</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w110'] == 0){ echo "none"; } ?>;"><center>W110</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w115'] == 0){ echo "none"; } ?>;"><center>W115</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w120'] == 0){ echo "none"; } ?>;"><center>W120</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w125'] == 0){ echo "none"; } ?>;"><center>W125</center></th>
    <th style="background-color:#FF0000; color: #ffffff; display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;"><center>W130</center></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no=1;
        $laporan3 = transaksi_scan_packing_b();
        while($pilih2 = mysqli_fetch_array($laporan3)){
      ?>
      <tr class="belang">
        <td align='center'><input type="checkbox" class="check-item" name="id[]" value="<?= $pilih2['ids_to_delete']; ?>"></td>
        <td align='center'><?= $pilih2['no_karton']; ?></td>
        <td align='center'><?= tanggal_indo3($pilih2['tanggal'], true) ?></td>
        <td align='center'><?= $pilih2['no_po']; ?></td>
        <td align='center' ><?= $pilih2['label']; ?></td>
        <td align='center'><?= $pilih2['style'] . ' ( ' . $pilih2['warna'] .' ) ' ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w70'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w71'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w72'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w73'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w74'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w75'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w76'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w77'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w78'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w79'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w80'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w81'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w82'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w83'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w84'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w85'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w86'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w87'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w88'] ?></td>
        <td align='center' style="display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;"><?= $pilih2['size_w89'] ?></td>
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
        <th class="tengah">NO PO</th>
        <th class="tengah">LABEL</th>
        <th class="tengah">STYLE</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w70'] == 0){ echo "none"; } ?>;">W70</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w71'] == 0){ echo "none"; } ?>;">W71</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w72'] == 0){ echo "none"; } ?>;">W72</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w73'] == 0){ echo "none"; } ?>;">W73</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w74'] == 0){ echo "none"; } ?>;">W74</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w75'] == 0){ echo "none"; } ?>;">W75</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w76'] == 0){ echo "none"; } ?>;">W76</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w77'] == 0){ echo "none"; } ?>;">W77</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w78'] == 0){ echo "none"; } ?>;">W78</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w79'] == 0){ echo "none"; } ?>;">W79</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w80'] == 0){ echo "none"; } ?>;">W80</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w81'] == 0){ echo "none"; } ?>;">W81</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w82'] == 0){ echo "none"; } ?>;">W82</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w83'] == 0){ echo "none"; } ?>;">W83</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w84'] == 0){ echo "none"; } ?>;">W84</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w85'] == 0){ echo "none"; } ?>;">W85</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w86'] == 0){ echo "none"; } ?>;">W86</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w87'] == 0){ echo "none"; } ?>;">W87</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w88'] == 0){ echo "none"; } ?>;">W88</th>
        <th class="tengah" style="display: <?php if($pilih3['size_w89'] == 0){ echo "none"; } ?>;">W89</th>
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
        <th class="tengah" style="display: <?php if($pilih3['size_w130'] == 0){ echo "none"; } ?>;">W130</th>
        <th class="tengah">TOTAL</th>
      </tr>
    </tfoot>
  </table>
<br>
<center>
<div style="width: 550px; border: 2px solid #f44336; padding:20px;">
<center>
<b><font color="f44336">REJECT BARANG PERKARTON</font></b>
<br>
<b><font color="f44336">Jika Ingin Reject Masukkan Keterangan dan klik Reject</font></b>
</center>
<table width="100%">
  <tr>
    <td style="margin:10; padding-left:25px" >
      <input class="form-control pilcek" type="text" name="keterangan" placeholder="Masukkan Keterangan Reject" required/>
    </td>
     <td style="padding-bottom:20px">
      <button type="button" class="btn btn-danger" id="btn-kirim">REJECT BARANG</button>
  </form>
      </td>
  </tr>
</table>
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
	$(document).ready(function() {
    $('#tabel').DataTable( {
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

<?php
require_once 'core/init.php';
// require_once 'view/header_tv.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing') {

 $costomer = $_POST['costomer'];
 $style = $_POST['style'];
 $no_po = $_POST['po'];
 $var_sumsize = $_POST['var_sumsize'];

?>
<input type="hidden" value="<?= $pl ?>" id="pl">
<input type="hidden" value="<?= $orc ?>" id="orc">
<input type="hidden" value="<?= $style ?>" id="style">
<input type="hidden" value="<?= $no_po ?>" id="po">
<table border="1px" id="example" class="table table-striped table-bordered data" >
    <thead>
        <tr>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><input type="checkbox" id="check-all"></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>No TRX</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TANGGAL</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>NO PO</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>ORC</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>LABEL</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>STYLE</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" colspan="<?= cek_jumlah_transaksi_shipment_from_packing($id_costomer, $orc, $style, $no_po); ?>"><center>SIZE</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TOT</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>KARTON</center></th>
        </tr>
        <tr>
            <?php $ListSize2 = tampilkan_size_transaksi_shipment_from_packing($id_costomer, $orc, $style, $no_po); 
            while($size2 = mysqli_fetch_array($ListSize2)){ ?>
            <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
            <?php } ?>
        </tr>
        <tbody>
        <?php
            $no=1;
            $laporan3 = transaksi_scan_packing_to_packinglist($id_costomer, $orc, $style, $no_po, $var_sumsize);
                while($pilih2 = mysqli_fetch_array($laporan3)){ 
        ?>

<tr class="belang">
        <td align='center'><input type="checkbox" class="check-item" name="idtrx" value="<?= $pilih2['ids_to_delete']; ?>"></td>
        <td align='center'>
          <!-- <a class="btn-klik" href="edit_packing.php?trx=<?= $pilih2['no_trx']; ?>"> -->
            <?= $pilih2['no_trx']; ?>
        <!-- </a> -->
        </td>
        <td align='center'><?= tanggal_indo3($pilih2['tanggal'], true) ?></td>
        <td align='center'><?= $pilih2['no_po']; ?></td>
        <td align='center'><?= $pilih2['orc']; ?></td>
        <td align='center' ><?= $pilih2['label']; ?></td>
        <td align='center'><?= $pilih2['style'] . ' ( ' . $pilih2['warna'] .' ) ' ?></td>
        <?php $ListSize2 = tampilkan_size_transaksi_shipment_from_packing($id_costomer, $orc, $style, $no_po); 
            while($size2 = mysqli_fetch_array($ListSize2)){ ?>
        <td align='center'><?= $pilih2[$size2['detail_size']]; ?></td>
            <?php } ?>
        <td align='center' style="background-color: #87CEEB;"><b><?= $pilih2['jumlah_size']; ?></b></td>
        <td align='center'><?php 
          if($pilih2['kelompok'] == 'full'){
            echo 'FULL';
          }elseif($pilih2['kelompok'] == 'ecer'){
            echo 'NOT FULL';
          }elseif($pilih2['kelompok'] == 'mix'){
            echo 'MIX SIZE';
          }elseif($pilih2['kelompok'] == 'mix_color'){
            echo 'MIX COLOR';
          }elseif($pilih2['kelompok'] == 'mix_style'){
            echo 'MIX STYLE';
          } ?></td>
        <?php } ?>
       </tr>
        </table>

       <button id="tambahkan" class="btn btn-md btn-success"><i class="glyphicon glyphicon-plus"></i> TAMBAHKAN KE INVOICE</button>
</center>

<div id="tampil_tabel3"></div>


<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $(".btn-klik").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin Ingin Mengedit Data Transaksi Ini?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-kirim").submit(); // Submit forM
    });
  });
</script>


<script type="text/javascript">
  $('#tambahkan').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Menyimpan Data ?");
    if (yakin) {
      
      var po = $('#po').val();
      var orc = $('#orc').val();
      var style = $('#style').val();
      var pl = $('#packinglist').val();
      url = "transaksi_shipment_all2.php?po="+po+"&orc="+orc+"&style="+style+"&pl="+pl;
      var selectedId = new Array();
        $('input[name="idtrx"]:checked').each(function() {
          selectedId.push(this.value);
        });
        console.log(selectedId);
      $.ajax({
        method: "POST",
        url: "kirim-shipment.php",
        data: { id : selectedId,
          packinglist : pl
        },
        success: function(data){
          console.log(data);
          if(data.trim() == "success"){
            
            $('#tampil_tabel2').load(url);
          }else if(data.trim() == "error"){
            alert("Gagal Ada masalah dengan query nya");
          }
        }
      });
    } else {
      return false;
    }
   
  });


</script>

<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        true,
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        searching : true,
        fixedColumns:   {
            left: 5,
        }
    } );
} );
</script>         

    <?php } else {
        echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
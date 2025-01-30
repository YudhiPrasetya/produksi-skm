<?php
require_once 'core/init.php';
// require_once 'view/header_tv.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php


 $orc = $_GET['orc'];
 $id_costomer = $_GET['costomer'];
 $style = $_GET['style'];
 $checkstyle = $_GET['checkstyle'];
 $no_po = $_GET['po'];
 $kelompok = $_GET['kelompok'];
 $color = $_GET['color'];
 

        $ListSize = tampilkan_size_transaksi_kenzin_belum_shipment($orc, $id_costomer, $no_po, $style, $kelompok, $color, $checkstyle);
        while($size = mysqli_fetch_array($ListSize)){
           ${$size['total_size']} = 0;
           $sumsize[] = $size['sum_size'];
           $size_detail[] = $size['size_detail'];
          
        }
        // print_r($arraysize);
        
        $var_sumsize =implode(", ",$sumsize);
        $var_detailsize =implode(",",$size_detail);

            
?>


<input type="hidden" value="<?= $id_costomer ?>" class="ganti" name="id_costomer" id="id_costomer">
<input type="hidden" value="<?= $var_sumsize ?>" name="var_sumsize" id="var_sumsize">
<input type="hidden" value="<?= $var_detailsize; ?>" name="var_detailsize" id="var_detailsize">

<table border="1px" id="example" class="table table-striped table-bordered data" style="font-size: 13px">
    <thead>
        <tr>
        <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2">ACT</th>
            <th style="background-color: #20B2AA; color: #ffffff; color: #ffffff" colspan="3"><center>KENZIN</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; color: #ffffff" colspan="3"><center>PACKING</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>NO PO</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2" width="20%"><center>ORC</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>LABEL</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>STYLE</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>COLOR</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" colspan="<?= cek_jumlah_transaksi_kenzin_belum_shipment($id_costomer, $orc, $style, $no_po, $kelompok, $color, $checkstyle); ?>"><center>SIZE</center></th>
            <th style="background-color: blue; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TOT</center></th>
            <th style="background-color: blue; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>KARTON</center></th>
        </tr>
        <tr>
            <th style="background-color: #20B2AA; color: #ffffff; color: #ffffff"><center>NO TRX</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; color: #ffffff"><center>TANGGAL</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; color: #ffffff"><center>JAM</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; color: #ffffff"><center>NO TRX</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; color: #ffffff"><center>TANGGAL</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; color: #ffffff"><center>JAM</center></th>
          
            <?php $ListSize2 = tampilkan_size_transaksi_kenzin_belum_shipment2($id_costomer, $orc, $style, $no_po, $kelompok, $color, $checkstyle); 
            while($size2 = mysqli_fetch_array($ListSize2)){ ?>
            <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
            <?php } ?>
        </tr>
        <tbody>
        </tbody>
       </tr>
        </table>

      
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

<script type="text/javascript" language="JavaScript">
function konfirmasi_edit()
{
tanya3 = confirm("Yakin Mengedit transaksi ini ");
if (tanya3 == true) return true;
else return false;
}</script>

<script type="text/javascript">

  $(document).on('click', '.delete_target', function (e) {
    swal.fire({
        title: "Apakah Anda yakin ingin Mereset transaksi ini?",
        text: "Tekan iya jika sudah yakin ingin menghapus, dan scan ulang data ini!",
        type: "warning",

        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: "Tidak",
        showCancelButton: true,
        reverseButtons: false,
      }).then((result) => {
        
        if (result.dismiss !== 'cancel') {
          var trx_kenzin = $(this).data('kenzin');
          var trx_packing = $(this).data('packing');
          $.ajax({
          method: "POST",
          url: "proses_reset_scan_barcode_buyer.php",
          data: { trx_kenzin : trx_kenzin,
            trx_packing : trx_packing,
            type : "reset"
          },
          success: function(data){ 
           console.log(data);
            if(data.trim() == "success"){
              swal("Data Berhasil Diedit!", "Klik Ok untuk melanjutkan!", "success");
              $('#example').DataTable().ajax.reload();
            }else if(data.trim() == "errorDb"){
              swal("Gagal Error Penyimpanan Database!", "Hubungi IT", "error");
            }else if(data.trim() == "gagal_backup"){
              swal("Gagal, Script Backup Gagal!", "Hubungi IT", "error");
            }
            
          }
        });
        }else{
            swal.close();
        }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    var po = $('#po').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var id_costomer = $('#id_costomer').val();
    var color = $('#color').val();
    var kelompok = $('#kelompok').val();
    var var_sumsize = $('#var_sumsize').val();
    var var_detailsize = $('#var_detailsize').val();
    myArr = var_detailsize.split(",");
    var check_style = $("#check_style:checked").val();
        if(check_style=='pilih_style'){
          checkstyle = 'iya';
        }else{
          checkstyle = 'tidak';
        }
    
    
    let columns = [
      { 'data': 'no_trx_trash' },
      { 'data': 'no_trx' },
      { 'data': 'tanggal' },
      { 'data': 'jam' },
      { 'data': 'no_trx_pack' },
      { 'data': 'tanggal_pack' },
      { 'data': 'jam_pack' },
      { 'data': 'no_po' },
      { 'data': 'orc' },
      { 'data': 'label' },
      { 'data': 'style' },
      { 'data': 'warna' },
    ];
    for (var i = 0; i < myArr.length; i++) {
      columns.push({ 'data' : myArr[i] },);
      
    }
    columns.push({ 'data' : 'jumlah_size', 'className' : 'warnaKolom' },);
    columns.push({ 'data' : 'kelompok', 'className' : 'warnaKolom' },);
            $('#example').DataTable({
                         
                "colReorder": true,
                "processing": true,
                "serverSide": true,
                "deferRender":    true,
                "scrollY":        true,
                "scrollX":        true,
                "scrollCollapse": true,
                "scroller":       true,
                "fixedColumns":   {
                  "left": 4,
                  "right": 2,
                },
                
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "order": [], 
                "ajax":{
                        "url": "transaksi_reset_scan_barcode_buyer_ss.php",
                        "dataType": "json",
                        "type": "POST",
                        "data" : {
                            "action" : "table_data",
                            "po" : po,
                            "orc" : orc,
                            "style" : style,
                            "id_costomer" : id_costomer,
                            "var_detailsize" : var_detailsize,
                            "var_sumsize" : var_sumsize,
                            "checkstyle" : checkstyle,
                            "color" : color,
                            "kelompok" : kelompok,
                        },
                    },

                    "columns": columns,

                    "columnDefs": [
        { 
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        },],
               
        });
       
    });
</script>         


<?php
require_once 'core/init.php';
// require_once 'view/header_tv.php';
// date_default_timezone_set('Asia/Jakarta');
?>
<?php
if(cek_status($_SESSION['username'] ) == 'admin' OR 
cek_status($_SESSION['username'] ) == 'packing_outerware') {

 $orc = $_GET['orc'];
 $pl = $_GET['pl'];
 $style = $_GET['style'];
 $no_po = $_GET['po'];
 

$laporan4 = tampilkan_master_shipment_id($pl);
    $data4 = mysqli_fetch_assoc($laporan4);
    $id_costomer = $data4['id_costomer'];
    $user = $_SESSION['username'];


        $ListSize = tampilkan_size_transaksi_packing_tarikpl($orc, $id_costomer, $no_po, $style);
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
        <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><input type="checkbox" id="check-all"></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>No TRX</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TANGGAL</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>NO PO</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>ORC</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>LABEL</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>STYLE</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>COLOR</center></th>
            <th style="background-color: #20B2AA; color: #ffffff; vertical-align:middle; color: #ffffff" colspan="<?= cek_jumlah_transaksi_shipment_from_packing($id_costomer, $orc, $style, $no_po); ?>"><center>SIZE</center></th>
            <th style="background-color: blue; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>TOT</center></th>
            <th style="background-color: blue; color: #ffffff; vertical-align:middle; color: #ffffff" rowspan="2"><center>KARTON</center></th>
        </tr>
        <tr>
            <?php $ListSize2 = tampilkan_size_transaksi_shipment_from_packing($id_costomer, $orc, $style, $no_po); 
            while($size2 = mysqli_fetch_array($ListSize2)){ ?>
            <th style="background-color:#20B2AA; color: #ffffff"><center><?= $size2['ukuran']; ?></center></th>
            <?php } ?>
        </tr>
        <tbody>
        </tbody>
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

<script type="text/javascript" language="JavaScript">
function konfirmasi_edit()
{
tanya3 = confirm("Yakin Mengedit transaksi ini ");
if (tanya3 == true) return true;
else return false;
}</script>

<script type="text/javascript">
  $('#tambahkan').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Menyimpan Data ?");
    if (yakin) {
      
      var po = $('#po').val();
      var orc = $('#orc').val();
      var style = $('#style').val();
      var pl = $('#packinglist').val();
      // url = "transaksi_shipment_all2.php?po="+po+"&orc="+orc+"&style="+style+"&pl="+pl;
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
            alert("Data Berhasil dikirim");
            $('#example').DataTable().ajax.reload();
            
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
    var po = $('#po').val();
    var orc = $('#orc').val();
    var style = $('#style').val();
    var id_costomer = $('#id_costomer').val();
    var var_sumsize = $('#var_sumsize').val();
    var var_detailsize = $('#var_detailsize').val();
    myArr = var_detailsize.split(",");
    console.log(myArr);
    let columns = [
      { 'data': 'id_trx' },
      { 'data': 'no_trx' },
      { 'data': 'tanggal' },
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
                  "left": 5,
                  "right": 2,
                },
                
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "order": [], 
                "ajax":{
                        "url": "transaksi_shipment_all_ss.php",
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
                        },
                    },

                    "columns": columns,
               
        });
       
    });
</script>         

    <?php } else {
        echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
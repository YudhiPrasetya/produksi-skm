<?php
  require_once 'core/init.php';
?>
    <!-- <link rel="stylesheet" href="view/style.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/SearchPanes/css/SearchPanes.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/Select/css/select.dataTables.min.css">
    <script type="text/javascript" src="assets/SearchPanes/js/dataTables.searchPanes.min.js"></script>
    <script type="text/javascript" src="assets/Select/js/dataTables.select.min.js"></script>
<style>
    div.dtsp-panesContainer button.dtsp-clearAll, div.dtsp-panesContainer button.dtsp-collapseAll, div.dtsp-panesContainer button.dtsp-showAll {
    border: 1px solid transparent;
    background-color: #20B2AA;
}

div.dtsp-verticalContainer{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-content: flex-start;
    align-items: flex-start;
}
 
div.dtsp-verticalContainer div.dtsp-verticalPanes,
div.dtsp-verticalContainer div.container{
    width: 30%;
    flex-grow: 0;
    flex-shrink: 0;
    flex-basis: 0;
}
 
div.dtsp-verticalContainer div.dtsp-verticalPanes{
    flex-grow: 1;
    flex-shrink: 0;
    flex-basis: 26%;
}
 
div.dtsp-verticalPanes {
    margin-right: 20px;
}
 
div.dtsp-title {
    margin-right: 0px !important;
    margin-top: 13px !important;
}
 
input.dtsp-search {
    min-width: 0px !important;
    padding-left: 0px !important;
    margin: 0px !important;
}
 
div.dtsp-verticalContainer div.dtsp-verticalPanes div.dtsp-searchPanes{
    flex-direction: column;
    flex-basis: 0px;
}
 
div.dtsp-verticalContainer div.dtsp-verticalPanes div.dtsp-searchPanes div.dtsp-searchPane{
    flex-basis: 0px;
}
 
div.dtsp-verticalContainer div.container{
    flex-grow: 1;
    flex-shrink: 0;
    flex-basis: 60%;
}
 
div.dtsp-panesContainer {
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 5px;
}
</style>

<?php
    if(cek_status($_SESSION['username'] ) == 'admin'){
   
$user = $_SESSION['username'];
$id = $_GET['id'];
$sql = tampilkan_jumlah_order_edit($id);
$data = mysqli_fetch_array($sql);

?>
<div class="dtsp-verticalContainer">
        <div class="dtsp-verticalPanes"></div>
        <div class="container">
<table border="1px" id="example" class="display nowrap table table-striped table-bordered data" >
    <thead>
        <tr>
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff"><center><input type="checkbox" id="check-all"></center></th>
            <!-- <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff"><center>KODE BARCODE</center></th> -->
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff">SIZE</th>
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff">CUP</th>
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff">URUTAN</th>
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff">NO BUNDLE</th>
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff">QTY</th>
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff">LOT</th>
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff">KETERANGAN</th>
            <th style="background-color: #20B2AA; vertical-align:middle; color: #ffffff"><center>ACTION</center></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $data2 = tampil_master_bundle($id);
        while($pilih2 = mysqli_fetch_array($data2)){ 
    ?>
    <tr class="belang">
        <td align='center'><input type="checkbox" class="check-item" name="id_bundle" value="<?= $pilih2['id_bundle']; ?>"></td>
        <!-- <td align='center'><?= $pilih2['barcode_bundle']; ?></td> -->
        <td align='center'><?= $pilih2['size']; ?></td>
        <td align='center'><?= $pilih2['cup']; ?></td>
        <td align='center'><?= $pilih2['no_urut']; ?></td>
        <td align='center'><?= $pilih2['no_bundle']; ?></td>
        <td align='center'><?= $pilih2['qty_isi_bundle']; ?></td>
        <td align='center' ><?= $pilih2['lot']; ?></td>
        <td align='center'><?= $pilih2['keterangan']; ?></td>
        <td align='center'> <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" data-id="<?= $pilih2['id_bundle']; ?>"><i class="glyphicon glyphicon-edit"></i></button></td>
       </tr>

        <?php } ?>
        
    </tbody>
 
</table>
</div>
</div>
<br>

<div style="margin-left: 30%">
    <div class="col-sm-3">
        <font color="blue"><b>LOT</font><br></b>
        <div class="input-group">
            <div class="input-group-addon">
            <i class="glyphicon glyphicon-tags"></i>
        </div>
        <input type="hidden"  name="user" value="<?= $user ?>" id="username">
        <input type="hidden"  name="id_order" value="<?= $id ?>" id="id_order">
        <input type="text" class="form-control" placeholder="LOT" name="lot" value="" id="lot">
        </div>
    </div>

    <div class="col-sm-2">
        <button id="simpan" class="btn btn-md btn-success"><i class="glyphicon glyphicon-save"></i> SIMPAN</button>
    </div>

    <div class="col-sm-2" >
        <button id="print" class="btn btn-md btn-primary" style="margin-left: -30px"><i class="glyphicon glyphicon-print"></i> PRINT TICKET</button>
    </div>

</div>
<br><br>


<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Data Costomer</b></font></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
           <div class="lihat-data"></div>
        </div>

    </div>
</div>
</div>
<!-- Modal Edit data kelas-->
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
    $(document).ready( function () {
    var table = $('#example').DataTable({
   
        searchPanes: {
            layout: 'columns-1', 
            initCollapsed: true,
            cascadePanes: true,
        },
   
        lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
        
    });
  table.searchPanes()
  $("div.dtsp-verticalPanes").append(table.searchPanes.container());
} );
</script>


<script type="text/javascript">
  $('#simpan').on('click',function(){
    var yakin = confirm("Anda Yakin Akan Menyimpan Data Lot ini ?");
    if (yakin) {
      
      var lot = $('#lot').val();
      var username = $('#username').val();
      var id_order = $('#id_order').val();
      url = "tampil_master_bundle.php?id="+id_order;
      var selectedId = new Array();
        $('input[name="id_bundle"]:checked').each(function() {
          selectedId.push(this.value);
        });
        console.log(selectedId);
      $.ajax({
        method: "POST",
        url: "simpan_lot_master_bundle.php",
        data: { id : selectedId,
            username : username,
            lot : lot
        },
        success: function(data){
          console.log(data);
          if(data.trim() == "success"){
            
            $('#tampil_tabel').load(url);
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
  $('#print').on('click',function(){
    var yakin = confirm("Apakah Mau Print Bundle ini ?");
    if (yakin) {
      
      var id_order = $('#id_order').val();
      
      var selectedId = new Array();
        $('input[name="id_bundle"]:checked').each(function() {
          selectedId.push(this.value);
        });
        
        url = "print_ticket_bundle_record_manual.php?id="+selectedId+"&id_order="+id_order;
        console.log(url);
        window.open(
            url, "_blank");
    } else {
      return false;
    }
   
  });


</script>

<!-- Script ajax menampilkan Edit kelas -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_master_bundle.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>


<?php } else {
     echo 'Anda tidak memiliki akses kehalaman ini'; } ?>
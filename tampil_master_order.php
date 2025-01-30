
<?php
    require_once 'core/init.php';
//     $po = $_GET['po'];

//     $orc = $_GET['orc'];
//     $style = $_GET['style'];
    $status = $_GET['status'];
//     $costomer = $_GET['costomer'];
// ?>
<style>
  td{
    text-align: center;
  }
</style>
<!-- <div class="container"> -->
<div style="margin: 0 20px">
<form method="post" action="ubah_status_master_order.php" id="form-kirim">
<input type="hidden" name="status" value="<?= $status; ?>">
<table border="1px" id="example" class="table table-striped table-bordered data" style="font-size: 13px; width: 100%">
  <thead>
    <tr>
      <th class="tengah theader" style="background: #254681"><input type="checkbox" id="check-all"></th>
      <th class="tengah theader" style="background: #254681"  ><center>CUSTOMER</center></th>
      <th class="tengah theader" style="background: #254681"  ><center>ORC</center></th>
      <th class="tengah theader" style="background: #254681" ><center>NO PO</center></th>
      <th class="tengah theader" style="background: #254681" ><center>STYLE</center></th>
      <th class="tengah theader" style="background: #254681" ><center>LABEL</center></th>
      <th class="tengah theader" style="background: #254681" ><center>COLOR</center></th>
      <th class="tengah theader" style="background: #254681" ><center>QTY ORDER</center></th>
      <th class="tengah theader" style="width: 2%; background: #254681" ><center>STATUS</center></th>
      <th class="tengah theader" style="width: 17%; background: #254681" ><center>Action</center></th>
    </tr>
  </thead>
  <tbody>
   
  </tbody>  
  <tfoot>
            <tr>
                <th colspan="7" class="theader" style="text-align: right">  TOTAL</th>
               
             
                <th class="theader" style="text-align: center"></th>
                <th colspan="2" class="theader"></th>
            </tr>
  </tfoot>
</table>
<center>
<button id="status_ubah" type="submit" class="btn btn-md btn-success"><?php if($status == 'close'){ echo 'OPEN'; }else{ echo 'CLOSE'; } ?> ORDER TERPILIH</button>
</center>
  </form>
</div>
<!-- Modal Detail Data data kelas-->
<div id="myDetail" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>DETAIL MASTER ORDER</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body"> 
        <div class="lihat-data"></div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal Detail data kelas-->

<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>EDIT MASTER ORDER</b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Detail data kelas-->

<script type="text/javascript">
  
    $(document).ready(function() {
    var status = $('#status').val();
    var costomer = $('#costomer').val();
    var orc = $('#orc3').val();
    var po = $('#po').val();
    var style = $('#style2').val();
    $('#example').DataTable({
      "processing": true,
      "serverSide": true,
      "columnDefs": [ {
      "targets": 0,
      "orderable": false
      } ],
      "order": [[9, 'desc']],
      "ajax":{
              "url": "tampil_master_order_ss.php",
              "dataType": "json",
              "type": "POST",
              "data" : {
                 "action" : "table_data",
                 "status" : status,
                 "costomer" : costomer,
                 "orc" : orc,
                 "po" : po,
                 "style" : style,
               },
            },
      "columns": [
        { "data": "check" },
          { "data": "costomer" },
          { "data": "orc" },
          { "data": "no_po" },
          { "data": "style" },
          { "data": "label" },
          { "data": "color" },
          { "data": "total" },
          { "data": "status" },
          { "data": "aksi" },
      ],
      "footerCallback": function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            total = api
                .column(7)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
           
            // Update footer
            $(api.column(7).footer()).html(total);
        },

  });
});  

</script>


<!-- Script ajax menampilkan detail  -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myDetail', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'detail_masterorder.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});

</script> 

<!-- Script ajax menampilkan Edit  -->
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		var rowedit = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'edit_masterorder.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});

function konfirmasi()
{
tanya3 = confirm("Yakin ingin menghapus Master order ini ?");
if (tanya3 == true) return true;
else return false;
}

function konfirmasi_close()
{
tanya3 = confirm("Yakin ingin Meng Close Master order ini ?");
if (tanya3 == true) return true;
else return false;
}


function konfirmasi_open()
{
tanya3 = confirm("Yakin ingin Meng Close Master order ini ?");
if (tanya3 == true) return true;
else return false;
}


function konfirmasi_edit()
{
tanya3 = confirm("Yakin ingin Edit Master order ini ?");
if (tanya3 == true) return true;
else return false;
}

</script>

<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#status_ubah").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin Ingin Mengubah Status Transaksi yang Ter Checklist Ini?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-kirim").submit(); // Submit forM
    });
  });
</script>


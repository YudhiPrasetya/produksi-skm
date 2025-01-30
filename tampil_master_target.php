
<?php
    require_once 'core/init.php';

?>
<style>
  td{
    text-align: center;
  }

  th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
<!-- <div class="container"> -->
<div style="margin: 0 20px">
<form method="post" action="ubah_status_master_order.php" id="form-kirim">

<table border="1px" id="example" class="table table-striped table-bordered data order-column" style="width:100%; font-size: 13px;">
  <thead>
    <tr>
    <th style="text-align: center; background-color: blue; color: white;" rowspan="2">NO</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2">HARI</th>
      <th style="text-align: center; background-color: blue; color: white;" width="10%" rowspan="2">DATE</th>
      <th style="text-align: center; background-color: blue; color: white;" width="10%" rowspan="2">ORC</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2">STYLE</th>
      <th style="text-align: center; background-color: blue; color: white;" width="15%" rowspan="2">COLOR</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2">ORDER</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2">COSTOMER</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2">NO PO</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2">LINE</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2">SMV</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2">% TARGET</th>
      <th style="text-align: center; background-color: blue; color: white;" colspan="2">NORMAL</th>
      <th style="text-align: center; background-color: blue; color: white;" colspan="2">TARGET NORMAL</th>
      <th style="text-align: center; background-color: blue; color: white;" colspan="2">LEMBUR</th>
      <th style="text-align: center; background-color: blue; color: white;" colspan="2">TARGET LEMBUR</th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2"><center>STATUS</center></th>
      <th style="text-align: center; background-color: blue; color: white;" rowspan="2" width="55%"><center>Action</center></th>
    </tr>
      <th style="text-align: center; background-color: blue; color: white;"><i class="glyphicon glyphicon-user"></i> MP</th>
      <th style="text-align: center; background-color: blue; color: white;"><i class="glyphicon glyphicon-time"></i> JK</th>
      <th style="text-align: center; background-color: blue; color: white;">JAM</th>
      <th style="text-align: center; background-color: blue; color: white;">HARI</th>
      <th style="text-align: center; background-color: blue; color: white;"><i class="glyphicon glyphicon-user"></i> MP</th>
      <th style="text-align: center; background-color: blue; color: white;"><i class="glyphicon glyphicon-time"></i> JL</th>
      <th style="text-align: center; background-color: blue; color: white;">JAM</th>
      <th style="text-align: center; background-color: blue; color: white;">LEMBUR</th>
      
      
    </tr>
  </thead>
  <tbody>
   
  </tbody>  

</table>

</div>

<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade"  role="dialog">
<div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><font face="Calibri" color="red"><b>Edit Qty Order</b></font></h4>
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
        var costomer = $('#costomer').val();
        var orc = $('#orc').val();
        var no_po = $('#po').val();
        var status = $('#status').val();
        var line = $('#line').val();
        var style = $('#style').val();
        var check_style = $("#check_style:checked").val();
        if(check_style=='pilih_style'){
          checkstyle = 'iya';
        }else{
          checkstyle = 'tidak';
        }
        var date_target = $('#date_target').val();
        var check_target = $("#check_target:checked").val();
        if(check_target=='pilih_target'){
            checktarget = 'iya';
        }else{
            checktarget = 'tidak';
        }
        
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
                  "left": 6,
                 
                },
                
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "order": [], 
      "ajax":{
              "url": "tampil_master_target_ss.php",
              "dataType": "json",
              "type": "POST",
              "data" : {
                "action" : "table_data",
                        "costomer" : costomer,
                        "orc" : orc,
                        "no_po" : no_po,
                        "style" : style,
                        "status" : status,
                        "line" : line,
                        "date_target" : date_target,
                        "checktarget" : checktarget,
                        "checkstyle" : checkstyle,
               },
            },
      "columns": [
          { "data": "no" },  
          { "data": "hari" },  
          { "data": "date_target" },
          { "data": "orc" },
          { "data": "style" },
          { "data": "color" },
          { "data": "qty_order" },
          { "data": "costomer" },
          { "data": "no_po" },
          { "data": "line" },
          { "data": "nilai_smv" },
          { "data": "persentase_target" },
          { "data": "man_power" },
          { "data": "jml_jam_normal" },
          { "data": "target_jam" },
          { "data": "target_days" },
          { "data": "man_power_lembur" },
          { "data": "jml_lembur" },
          { "data": "target_jam_lembur" },
          { "data": "target_days_lembur" },
          { "data": "status" },
          { "data": "action" },
      ],
     

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
			url	 : 'edit_master_target.php',
			data : 'rowedit='+ rowedit,
			success : function(data) {
			$('.lihat-data').html(data);//menampilkan data ke dalam modal
			}
		});
	});
});


$(document).on('click', '.copy_target', function (e) {
    swal.fire({
        title: "Ingin Input data Target baru dengan orc ini utk tanggal hari ini?",
        text: "Tekan iya jika ingin melanjutkan!",
        type: "info",

        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: "Tidak",
        showCancelButton: true,
        reverseButtons: false,
      }).then((result) => {
        
        if (result.dismiss !== 'cancel') {
            var id = $(this).data('id');
            url = "temp_target_harian_copy.php?id="+id;
            window.location = url;
        }else{
            swal.close();
        }
    });
  });

  $(document).on('click', '.delete_target', function (e) {
    swal.fire({
        title: "Apakah Anda yakin ingin menghapus transaksi ini?",
        text: "Tekan iya jika sudah yakin ingin menghapus data ini!",
        type: "warning",

        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: "Tidak",
        showCancelButton: true,
        reverseButtons: false,
      }).then((result) => {
        
        if (result.dismiss !== 'cancel') {
          var id = $(this).data('id');
          $.ajax({
          method: "POST",
          url: "proses_target_harian.php",
          data: { id : id,
            type : "delete"
          },
          success: function(data){ 
            console.log(data);
            if(data.trim() == "success"){
              swal("Data Berhasil Diedit!", "Klik Ok untuk melanjutkan!", "success");
              $('#example').DataTable().ajax.reload();
            }else if(data.trim() == "errorDb"){
              swal("Gagal Error Penyimpanan Database!", "Hubungi IT", "error");
            }
            
          }
        });
        }else{
            swal.close();
        }
    });
  });
</script>
</script>


<script type="text/javascript">
   $(document).on('click', '#simpan_edit', function () {
    var id = $('#id').val();
    var line = $('#line2').val();
    var man_power = $('#man_power').val();
    var jml_lembur = $('#jml_lembur').val();
    var man_power_lembur = $('#man_power_lembur').val();
    var jml_jam_normal = $('#jml_jam_normal').val();
    var persentase = $('#persentase').val();
  
    $.ajax({
      method: "POST",
      url: "proses_target_harian.php",
      data: { id : id,
        line : line,
        man_power : man_power,
        man_power_lembur : man_power_lembur,
        jml_lembur : jml_lembur, 
        jml_jam_normal : jml_jam_normal,
        persentase : persentase,
        type : "edit"
       },
      success: function(data){ 
        console.log(data);
        if(data.trim() == "success"){
          swal("Data Berhasil Diedit!", "Klik Ok untuk melanjutkan!", "success");
          $('#example').DataTable().ajax.reload();
        }else if(data.trim() == "errorDb"){
          swal("Gagal Error Penyimpanan Database!", "Hubungi IT", "error");
        }else if(data.trim() == "kosong"){
          swal("Gagal Ada Data yang masih kosong!", "Silakan Cek Data Anda", "error");
        }
        
      }
    });
  });

</script>


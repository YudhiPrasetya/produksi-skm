<?php
require_once 'core/init.php'; 


?>
<style>
  td{
    text-align: center;
  }
</style>

<div class="row text-center">
  <div id="loading" style="display: none;">
      Loading...
      <img src="assets/images/loader.gif" alt="Loading" width="142" height="71" />
  </div>
</div>

<h4 style="text-align: center; margin-right: 20px;  color: blue">UPDATE PER <?= date('H:i:s'); ?></h4>
<div style="margin-left: 20px; margin-right: 20px">
  <table border="1px"  class="table table-striped table-bordered row-border order-column display data" id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th width="2%" style="text-align: center; background: #254681; color: white; vertical-align: middle;" rowspan=2>NO</th>
      <th width="15%" style="text-align: center; background: #254681; color: white; vertical-align: middle;" rowspan=2>COSTOMER</th>
      <th width="15%" style="text-align: center; background: #254681; color: white; vertical-align: middle;" rowspan=2>NO PO</th>
      <th width="15%" style="text-align: center; background: #254681; color: white; vertical-align: middle;" rowspan=2>ORC</th>
      <th width="15%" style="text-align: center; background: #254681; color: white; vertical-align: middle;" rowspan=2>STYLE</th>
      <th width="17%" style="text-align: center; background: #254681; color: white; vertical-align: middle;" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #254681; color: white;" colspan=1>QTY</th>
      <th  style="text-align: center; background: #254681; color: white;" colspan=2>QTY TATAMI</th>
      <th  style="text-align: center; background: #254681; color: white;" colspan=3>QTY PACKING</th>
      <th width="9%" style="text-align: left; background: #254681; color: white;" >BUNDLE</th>
    </tr>
    <tr>
    <th width="4%" style="text-align: center; background: #254681; color: white;">ORDER</th>
    <th width="4%" style="text-align: center; background: #254681; color: white;">IN</th>
    <th width="4%" style="text-align: center; background: #254681; color: white;">WIP</th>
    <th width="3%" style="text-align: center; background: #254681; color: white;">DAILY</th>
    <th width="3%" style="text-align: center; background: #254681; color: white;">TOTAL</th>
    <th width="3%" style="text-align: center; background: #254681; color: white;">BALANCE</th>
    <th style="text-align: left; background: #254681; color: white;">RECORD</th>

  </tr>
</thead>
<tbody>
</tbody>
<tfoot>
		<tr>   
            <th colspan=6 style="text-align: right; background: #254681; color: white;"></th>
            <th style="text-align: center; background: #254681; color: white;"></th>
            <th style="text-align: center; background: #254681; color: white;"></th>
            <th style="text-align: center; background: #254681; color: white;"></th>
            <th style="text-align: center; background: #254681; color: white;"></th>
            <th style="text-align: center; background: #254681; color: white;"></th>
            <th style="text-align: center; background: #254681; color: white;"></th>
            <th style="text-align: center; background: #254681; color: white;"></th>
        </tr>
	</tfoot>
</table>

<script>
     $(document).ready(function() {
       
        var tgl = $('#tanggal').val();
        var no_po = $('#no_po').val();
        var orc = $('#orc').val();
        var style = $('#style').val();
        var status = $('#status').val();
        var costomer = $('#costomer').val();
        var category = $('#category').val();
        var check_style = $("#check_style:checked").val();
        if(check_style=='pilih_style'){
          checkstyle = 'iya';
        }else{
          checkstyle = 'tidak';
        }
        var line = $('#line').val();
            $('#example').DataTable({
                "colReorder": true,
                "processing": true,
                "serverSide": true,
                "deferRender":    true,
                "scrollY":        600,
                "scrollCollapse": true,
                "scroller":       true,
                "aLengthMenu": [[20, 50, 75, -1], [20, 50, 75, "All"]],
                "order": [], 
                "ajax":{
                        "url": "tampil_laporan_hasil_scan_global_packing_ss.php",
                        "dataType": "json",
                        "type": "POST",
                        "data" : {
                            "action" : "table_data",
                            "tgl" : tgl,
                            "no_po" : no_po,
                            "orc" : orc,
                            "style" : style,
                            "status" : status,
                            "costomer" : costomer,
                            "category" : category,
                            "line" : line,
                            "checkstyle" : checkstyle,
                        },
                      "beforeSend": function(){
                        $('#loading').show();
                        $('#example').hide();
                      },
                      "complete": function(){
                        $('#loading').hide();
                        $('#example').show();                        
                      }
                    },
                   
                "columns": [
                    { "data": "no" },
                    { "data": "costomer" },
                    { "data": "no_po" },
                    { "data": "orc" },
                    { "data": "style" },
                    { "data": "color" },
                    { "data": "qty_order" },
                    { "data" : "qty_tatami"},
                    { "data" : "wip_tatami"},
                    { "data": "daily" },
                    { "data": "total" },
                    { "data": "balance" },
                    { "data": "aksi" },
                ],

                rowCallback: function(row, data, index){
                    if(data["qty_tatami"] == data["qty_order"]){
                        $('td:nth-child(6)', row).css('background-color', '#82F903');
                        $('td:nth-child(7)', row).css('background-color', '#82F903');

                        if(data["wip_tatami"] == 0){
                            $('td:nth-child(8)', row).css('background-color', '#82F903');
                        }
                    }

                    if(data["balance"] == 0){
                        $('td:nth-child(9)', row).css('background-color', '#82F903');
                        $('td:nth-child(10)', row).css('background-color', '#82F903');
                        $('td:nth-child(11)', row).css('background-color', '#82F903');
                    }
                   
                   
                },

                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
                    // converting to interger to find total
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
        
                    // computing column Total the complete result 
                    var qty_order = api
                        .column( 6 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    var qty_tatami = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                    }, 0 );    
                        
                    var wip_tatami = api
                        .column( 8 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var daily = api
                        .column( 9 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var total = api
                        .column( 10 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var balance = api
                        .column( 11 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                    }, 0 );    
                        
                    // Update footer by showing the total with the reference of the column index 
                    $( api.column( 0 ).footer() ).html('Total : ');
                    $( api.column( 6 ).footer() ).html(qty_order);
                    $( api.column( 7 ).footer() ).html(qty_tatami);
                    $( api.column( 8 ).footer() ).html(wip_tatami);
                    $( api.column( 9 ).footer() ).html(daily);
                    $( api.column( 10 ).footer() ).html(total);
                    $( api.column( 11 ).footer() ).html(balance);
                    
                },
            });
            
        });
   
</script>
<!-- Modal Edit Data data kelas-->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
  <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font face="Calibri" color="red"><b>DETAIL SIZE PROSES <?php if($proses == 'sewing'){ echo "INPUT SEWING"; }else{
          echo strtoupper($proses); 
        } ?></b></font></h4>
      </div>
      <!-- body modal -->
      <div class="modal-body">
        <div class="lihat-data"></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit data kelas-->

<script type="text/javascript">
$(document).ready(function() {
	$('body').on('show.bs.modal','#myEdit', function (e) {
		    var rowedit = $(e.relatedTarget).data('id');
        var proses =  $('#proses').val();
        var tanggal = $('#tanggal').val();
		//menggunakan fungsi ajax untuk pengembalian data
		$.ajax({
			type : 'post',
			url	 : 'tampil_laporan_hasil_scan_global_detail.php',
			data: { rowedit : rowedit,
                proses : proses,
                tanggal : tanggal
            },
			success : function(data) {
				setTimeout(function(){$('.lihat-data').html(data);}, 1000);//menampilkan data ke dalam modal
			}
		});
	});
});
</script>
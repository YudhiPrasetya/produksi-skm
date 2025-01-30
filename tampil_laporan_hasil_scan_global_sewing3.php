<?php
require_once 'core/init.php';

?>
<style>
  table#example th{
    text-align: center;
  }

  table#example td{
    text-align: center;
  }
  
</style>
<h4 style="color: blue"><center> UPDATE PER <?= date('H:i:s'); ?></center></h4>
<div style="margin-left: 20px; margin-right: 20px">
  <table border="1px"  class="table table-striped table-bordered row-border order-column display" id="example" style="font-size: 12px;" width="100%">
  
  <thead>
      <tr>
      <th width="2%" style="text-align: center; background: #1E90FF" rowspan=2>NO</th>
      <th width="7%" style="text-align: center; background: #1E90FF" rowspan=2>LINE</th>
      <th width="7%" style="text-align: center; background: #1E90FF" rowspan=2>COSTOMER</th>
      <th width="7%" style="text-align: center; background: #1E90FF" rowspan=2>NO PO</th>
      <th width="9%" style="text-align: center; background: #1E90FF" rowspan=2>ORC</th>
      <th width="9%" style="text-align: center; background: #1E90FF" rowspan=2>STYLE</th> 
      <th width="9%" style="text-align: center; background: #1E90FF" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #1E90FF" colspan=6>QTY SEWING PRODUCTION</th>
    </tr>
    <tr>
    <th width="3%" style="text-align: center; background: #1E90FF">ORDER</th>
    <th width="3%" style="text-align: center; background: #1E90FF">DAILY</th>
    <th width="3%" style="text-align: center; background: #1E90FF">IN</th>
    <th width="3%" style="text-align: center; background: #1E90FF">OUT</th>
    <th width="3%" style="text-align: center; background: #1E90FF">WIP</th>
    <th width="3%" style="text-align: center; background: #1E90FF">BAL</th>
  </tr> 
</thead>
<tbody>

</tbody>
<tfoot>
		<tr>
            
            <th colspan=7 style="text-align: right; background: #1E90FF"></th>
            <th style="text-align: center; background: #1E90FF"></th>
            <th style="text-align: center; background: #1E90FF"></th>
            <th style="text-align: center; background: #1E90FF"></th>
            <th style="text-align: center; background: #1E90FF"></th>
            <th style="text-align: center; background: #1E90FF"></th>
            <th style="text-align: center; background: #1E90FF"></th>
        </tr>
	</tfoot>
</table>
</div>



<script>
     $(document).ready(function() {
        var lantai = $('#lantai').val();
        var costomer = $('#costomer').val();
        var category = $('#category').val();
        var tinggi = window.innerHeight;
        
            $('#example').DataTable({
                "colReorder": true,
                "processing": true,
                "serverSide": true,
                "deferRender":    true,
                "scrollY":        500,
                "scrollCollapse": true,
                "scroller":       true,
                "aLengthMenu": [[20, 50, 75, -1], [20, 50, 75, "All"]],
                "order": [], 
                "ajax":{
                        "url": "tampil_laporan_hasil_scan_global_sewing_ss.php",
                        "dataType": "json",
                        "type": "POST",
                        "data" : {
                            "action" : "table_data",
                            "lantai" : lantai,
                            "costomer" : costomer,
                            "category" : category,
                        },
                    },
                   
                "columns": [
                    { "data": "no" },
                    { "data": "line" },
                    { "data": "costomer" },
                    { "data": "no_po" },
                    { "data": "orc" },
                    { "data": "style" },
                    { "data": "color" },
                    { "data": "qty_order" },
                    { "data": "daily_output" },
                    { "data": "total_sewing_in" },
                    { "data": "total_sewing_out" },
                    { "data": "outstanding" },
                    { "data": "balance_order" },
                ],

                rowCallback: function(row, data, index){
                    if(data["total_sewing_in"] >= data["qty_order"]){
                        $('td:nth-child(10)', row).css('background-color', '#82F903');
                        $('td:nth-child(8)', row).css('background-color', '#82F903');
                    }
                    if(data["outstanding"] == 0){
                        $('td:nth-child(11)', row).css('background-color', '#82F903');
                    }

                    if(data["outstanding"] == 0){
                        $('td:nth-child(12)', row).css('background-color', '#82F903');
                    }

                    if(data["outstanding"] == 0){
                        $('td:nth-child(13)', row).css('background-color', '#82F903');
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
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var daily_output = api
                        .column( 8 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var total_sewing_in = api
                        .column( 9 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var total_sewing_out = api
                        .column( 10 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var outstanding = api
                        .column( 11 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    var balance_order = api
                        .column( 12 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                    }, 0 );
                        
                    // Update footer by showing the total with the reference of the column index 
                    $( api.column( 0 ).footer() ).html('Total : ');
                    $( api.column( 7 ).footer() ).html(qty_order);
                    $( api.column( 8 ).footer() ).html(daily_output);
                    $( api.column( 9 ).footer() ).html(total_sewing_in);
                    $( api.column( 10 ).footer() ).html(total_sewing_out);
                    $( api.column( 11 ).footer() ).html(outstanding);
                    $( api.column( 12 ).footer() ).html(balance_order);
                },

                    });
            
      

        });
   
</script>


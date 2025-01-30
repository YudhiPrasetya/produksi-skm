<b>REMINDER LIST ORDER RUNNING YANG TIDAK MENCAPAI TARGET PER JAM:</b>
    <br><br>
    </div>
    <table border="1px"  class="table table-striped table-bordered row-border order-column display " id="example" style="font-size: 12px;">
  
  <thead>
      <tr>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COSTOMER</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>NO PO</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ITEM</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>ORC</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>STYLE</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>COLOR</th>
      <th  style="text-align: center; background: #1E90FF" rowspan=2>LINE</th>
      <th  style="text-align: center; background: #1E90FF" >JAM </th>
      <th  style="text-align: center; background: #1E90FF" >TARGET </th>
      <th  style="text-align: center; background: #1E90FF" colspan=2>QTY PER JAM</th>

      </tr> 
      <tr>
      
        <th  style="text-align: center; background: #1E90FF" >NORMAL</th>
        <th  style="text-align: center; background: #1E90FF" >@ JAM</th>
        <th  style="text-align: center; background: #1E90FF" >OUTPUT</th>
        <th  style="text-align: center; background: #1E90FF" >BALANCE</th>
      </tr>
</thead>
<tbody>
</tbody>

</table>
<script type="text/javascript">
$(document).ready(function() {
       
       var lantai = $('#lantai').val();

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
                       "url": "tampil_laporan_reminder_qc_endline_ss.php",
                       "dataType": "json",
                       "type": "POST",
                       "data" : {
                           "action" : "table_data",
                           "lantai" : lantai,
                       },
                   },
                  
               "columns": [
                   { "data": "no" },
                   { "data": "costomer" },
                   { "data": "no_po" },
                   { "data": "item" },
                   { "data": "orc" },
                   { "data": "style" },
                   { "data": "color" },
                   { "data": "line" },
                   { "data": "jml_jam_normal" },
                   { "data": "target_jam" },
                   // { "data": "jam_ke" },
                   // { "data": "total_target_jam_ke" },
                   { "data": "total_output" },
                   { "data": "balance_target" },                                                              
                ],                                                                                                                                                    
               });
   });                                                                                                                                                                                                                                                      
</script>
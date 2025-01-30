<?php
require_once 'core/init.php';
$proses = $_GET['proses'];

?>
<style>
   td {
      text-align: center;
   }
</style>

<h4 style="text-align: right; margin-right: 20px; color: blue">UPDATE PER <?= date('H:i:s'); ?></h4>
<button class="row btn btn-success" style="margin-left: 20px; margin-right: 20px; margin-bottom: 10px;" id="exportToExcel">Export To Excel</button>
<div style="margin-left: 20px; margin-right: 20px" id="tableContainer">
   <table border="1px" class="table table-striped table-bordered row-border order-column display " id="example" style="font-size: 12px;">
      <thead>
         <tr>
            <th style="text-align: center; background: #1E90FF" rowspan=2>NO</th>
            <th style="text-align: center; background: #1E90FF" rowspan=2>LINE</th>
            <th style="text-align: center; background: #1E90FF" rowspan=2>COSTOMER</th>
            <th style="text-align: center; background: #1E90FF" rowspan=2>NO PO</th>
            <th style="text-align: center; background: #1E90FF" rowspan=2>ORC</th>
            <th style="text-align: center; background: #1E90FF" rowspan=2>STYLE</th>
            <th style="text-align: center; background: #1E90FF" rowspan=2>COLOR</th>
            <th style="text-align: center; background: #1E90FF" rowspan=2>SHIP DATE</th>
            <th style="text-align: center; background: #1E90FF" colspan=4>QTY</th>
            <th style="text-align: left; background: #1E90FF" width="9%">BUNDLE</th>
         </tr>
         <tr>
            <th width="3%" style="text-align: center; background: #1E90FF">ORDER</th>
            <th width="3%" style="text-align: center; background: #1E90FF">DAILY</th>
            <th width="3%" style="text-align: center; background: #1E90FF">TOTAL</th>
            <th width="3%" style="text-align: center; background: #1E90FF">BAL</th>
            <th style="text-align: left; background: #1E90FF">RECORD</th>
         </tr>
      </thead>
      <tbody id="tContainer">
      </tbody>
      <tfoot>
         <tr>
            <th colspan=8 style="text-align: right; background: #1E90FF"></th>
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
      var proses = $('#proses').val();
      var tgl1 = $('#tanggal').val();
      var tgl2 = $('#tanggal1').val();
      var no_po = $('#no_po').val();
      var orc = $('#orc').val();
      var style = $('#style').val();
      var status = $('#status').val();
      var costomer = $('#costomer').val();
      var category = $('#category').val();
      var line = $('#line').val();
      var check_style = $("#check_style:checked").val();
      if (check_style == 'pilih_style') {
         checkstyle = 'iya';
      } else {
         checkstyle = 'tidak';
      }
      $('#example').DataTable({
         // dom: 'lfr<"pull-left"B>tip',
         // buttons: [{
         //    text: 'Export To Excel',
         //    action: function(e, dt, node, config) {
         //       let file = new Blob([$('#tableContainer').html()], {
         //          type: "application/vnd.ms-excel"
         //       });
         //       let url = URL.createObjectURL(file);
         //       let a = $("<a />", {
         //          href: url,
         //          download: "LaporanHasilProduksi" + ".xls"
         //       }).appendTo("body").get(0).click();
         //       e.preventDefault();
         //    }
         // }],
         "paging": false,
         "colReorder": true,
         "processing": true,
         "serverSide": true,
         "deferRender": true,
         "scrollY": 500,
         "scrollCollapse": true,
         "scroller": true,
         "scrollX": true,

         // "lengthMenu": [
         //    [20, 50, 75, -1],
         //    [20, 50, 75, "All"]
         // ],
         "order": [],
         "ajax": {
            "url": "tampil_laporan_hasil_scan_global_ss.php",
            "dataType": "json",
            "type": "POST",
            "data": {
               "action": "table_data",
               "proses": proses,
               "tgl1": tgl1,
               "tgl2": tgl2,
               "no_po": no_po,
               "orc": orc,
               "style": style,
               "status": status,
               "costomer": costomer,
               "category": category,
               "line": line,
               "checkstyle": checkstyle,
            },
         },

         "columns": [{
               "data": "no"
            },
            {
               "data": "line"
            },
            {
               "data": "costomer"
            },
            {
               "data": "no_po"
            },
            {
               "data": "orc"
            },
            {
               "data": "style"
            },
            {
               "data": "color"
            },
            {
               "data": "shipment_plan"
            },
            {
               "data": "qty_order"
            },
            {
               "data": "daily"
            },
            {
               "data": "total"
            },
            {
               "data": "balance"
            },
            {
               "data": "aksi"
            },
         ],

         rowCallback: function(row, data, index) {
            if (data["balance"] == 0) {
               $('td:nth-child(9)', row).css('background-color', '#82F903');
               $('td:nth-child(10)', row).css('background-color', '#82F903');
               $('td:nth-child(11)', row).css('background-color', '#82F903');

            }

         },

         "footerCallback": function(row, data, start, end, display) {
            var api = this.api(),
               data;
            // converting to interger to find total
            var intVal = function(i) {
               return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '') * 1 :
                  typeof i === 'number' ?
                  i : 0;
            };

            // computing column Total the complete result 
            var qty_order = api
               .column(8)
               .data()
               .reduce(function(a, b) {
                  return intVal(a) + intVal(b);
               }, 0);

            var daily = api
               .column(9)
               .data()
               .reduce(function(a, b) {
                  return intVal(a) + intVal(b);
               }, 0);

            var total = api
               .column(10)
               .data()
               .reduce(function(a, b) {
                  return intVal(a) + intVal(b);
               }, 0);

            var balance = api
               .column(11)
               .data()
               .reduce(function(a, b) {
                  return intVal(a) + intVal(b);
               }, 0);


            // Update footer by showing the total with the reference of the column index 
            $(api.column(0).footer()).html('Total : ');
            $(api.column(8).footer()).html(qty_order);
            $(api.column(9).footer()).html(daily);
            $(api.column(10).footer()).html(total);
            $(api.column(11).footer()).html(balance);

         },

      });

      $('#exportToExcel').click(function(e) {
         var strTgl1 = $('#tanggal').val();
         var strTgl2 = $('#tanggal1').val();
         var tgl1 = strTgl1.split("-").reverse().join("-");
         var tgl2 = strTgl2.split("-").reverse().join("-");
         var fileName = `LaporanHasilProduksi ${tgl1} s/d ${tgl2}`;
         let file = new Blob([$('#tableContainer').html()], {
            type: "application/vnd.ms-excel"
         });
         let url = URL.createObjectURL(file);
         let a = $("<a />", {
            href: url,
            download: fileName + ".xls"
         }).appendTo("body").get(0).click();
         e.preventDefault();
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
            <h4 class="modal-title">
               <font face="Calibri" color="red"><b>DETAIL SIZE PROSES <?php if ($proses == 'sewing') {
                                                                           echo "INPUT SEWING";
                                                                        } else {
                                                                           echo strtoupper($proses);
                                                                        } ?></b></font>
            </h4>
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
      $('body').on('show.bs.modal', '#myEdit', function(e) {
         var rowedit = $(e.relatedTarget).data('id');
         var proses = $('#proses').val();
         var tanggal = $('#tanggal').val();
         //menggunakan fungsi ajax untuk pengembalian data
         $.ajax({
            type: 'post',
            url: 'tampil_laporan_hasil_scan_global_detail.php',
            data: {
               rowedit: rowedit,
               proses: proses,
               tanggal: tanggal
            },
            success: function(data) {
               setTimeout(function() {
                  $('.lihat-data').html(data);
               }, 1000); //menampilkan data ke dalam modal
            }
         });
      });
   });
</script>
<?php
   require_once 'core/init.php';
   require_once 'view/header.php';
?>
<head>
   <link rel="stylesheet" href="assets/Datatables/css/buttons.dataTables.css">
</head>
<style>
   hr {
      display: block;
      margin-top: 0.5em;
      margin-bottom: 0.5em;
      border-style: inset;
      border-width: 1px;
      border-color:blue;
   }
    
    ul.list-unstyled{
      background-color:#eee;
      cursor:pointer;
      position: absolute;
      width:25%;
      padding-left:0px;
      z-index: 2;
   }
   li.po{
      padding:7px;
      border:thin solid #F0F8FF;
      z-index: 2;
      padding-left:15px;
   }
   li.po:hover{
      background-color:#1E90FF;
      z-index: 2;
      padding-left:15px;
   }

   #tableSumProduksi{
      th{
         vertical-align: middle;
         text-align: center;
         /* font-size: .75em; */
      }
      /* td{
         font-size: .75em;
      } */
   }

   /* .center-block{
      display: block;
      margin-left: auto;
      margin-right: auto;
   } */
</style>

<center>
   <title>LAPORAN SEWING PRODUCTION</title>
   <h3>Laporan Summary Produksi (Production Summary Report)</h3>
</center>

</div>

<div class="container-fluid" style="margin: 20px;">
   <!-- <div class="container style="margin-bottom: 10px;"> -->
      <div class="row well" style="margin-bottom: 10px; padding:5px 15px 5px 15px">
         <div class="center-block">
            <div class="col-md-2">
               <div class="form-group">
                  <label for="tgl">s/d Tanggal</label>
                  <input type="date" id="tgl" name="tgl" class="form-control canChange" />
               </div>
            </div>

            <div class="col-md-2">
               <div class="form-group">
                  <label for="category">Category</label>
                  <select id="category" name="category" class="form-control canChange">
                     <option value="">Semua</option>
                     <option value="UNDERWEAR">Underwear</option>
                     <option value="OUTERWEAR">Outerwear</option>
                  </select>
               </div>
            </div>

            <div class="col-md-2">
               <div class="form-group">
                  <label for="customer">Customer</label>
                  <select id="customer" name="customer" class="form-control canChange select2"></select>
               </div>
            </div>

            <div class="col-md-2">
               <div class="form-group">
                  <label for="line">Line</label>
                  <select id="line" name="line" class="form-control canChange select2"></select>
               </div>
            </div>

            <div class="col-md-2">
               <button id="btnFilter" name="btnFilter" class="btn btn-info">Filter</button>
            </div>
         </div>
      </div>
   <!-- </div> -->

   <div class="row">
      <!-- <div class="col-12"> -->
         <button id='btnExportToExcel' class='btn btn-success btn-sm'>Export To Excel</button>
         <div id="tableContainer">
            <table border="1px" class="table table-striped table-bordered row-border order-column compact display nowrap" id="tableSumProduksi" width="100%">
               <thead>
                  <tr>
                     <th style="background: #254681; color: white;" rowspan="2">No.</th>
                     <th style="background: #254681; color: white;" rowspan="2">Line</th>
                     <th style="background: #254681; color: white;" rowspan="2">Buyer</th>
                     <th style="background: #254681; color: white;" rowspan="2">PO</th>
                     <th style="background: #254681; color: white;" rowspan="2">ORC</th>
                     <th style="background: #254681; color: white;" rowspan="2">Style</th>
                     <th style="background: #254681; color: white;" rowspan="2">Color</th>
                     <th style="background: #254681; color: white;" rowspan="2" class="text-center">Size</th>
                     <th style="background: #254681; color: white;" rowspan="2" class="text-center">Qty Order</th>
                     <th style="background: #254681; color: white;" rowspan="2">Shipment</th>
                     <th style="background: #254681; color: white;" colspan="2" class="text-center">Trimstores</th>
                     <th style="background: #254681; color: white;" colspan="2" class="text-center">Input Sewing</th>
                     <th style="background: #254681; color: white;" colspan="2" class="text-center">QC Endline</th>
                     <th style="background: #254681; color: white;" colspan="2" class="text-center">Packing</th>
                  </tr>
                  <tr>
                     <th style="background: #254681; color: white;">Input</th>
                     <th style="background: #254681; color: white;">Balance</th>
                     <th style="background: #254681; color: white;">Input</th>
                     <th style="background: #254681; color: white;">Balance</th>
                     <th style="background: #254681; color: white;">Output</th>
                     <th style="background: #254681; color: white;">Balance</th>
                     <th style="background: #254681; color: white;">Output</th>
                     <th style="background: #254681; color: white;">Balance</th>
                  </tr>
               <thead>
            </table>
         </div>
      <!-- </div> -->
   </div>
</div>

<script src="assets/js/select2.min.js"></script>
<script src="assets/DataTables/js/dataTables.buttons.min.js"></script>
<!-- <script src="assets/DataTables/js/buttons.dataTables.js"></script> -->
<script src="assets/DataTables/js/jszip.min.js"></script>


<script>
   $(document).ready(function(){
      const now = new Date();
      const year = now.getFullYear();
      const month = (now.getMonth() + 1).toString().padStart(2, '0');
      const day = now.getDate().toString().padStart(2, '0');
      const strDate = `${year}-${month}-${day}`;

      $('#tgl').val(strDate);

      $('.select2').select2({
         theme: 'bootstrap4',
      });

      var tableSumProduksi = $('#tableSumProduksi').DataTable({
      //   dom: 'Bfrtip',
      //   buttons: [
            // 'copy',
            // 'csv',
            // 'excelHtml5',
            // 'excel',
            // 'pdf',
            // 'print'
      //   ],
         // paging: false,
         deferRender: true,
         scrollY: 490,
         scrollCollapse: true,
         scroller: true,
         searching: false,
         columnDefs: [
            {
               targets: [0,7,8,10,11,12,13,14,15,16,17],
               className: 'dt-center'
            },
         ]
      });

      loadInitializeData();
      function loadInitializeData(){
         $.when(loadCustomer(), loadLine()).done(function(rstCustomer, rstLine){
            if(rstCustomer[0].length > 0){
               $('#customer').empty();
               $('#customer').append($('<option>', {
                  value: "",
                  text: "Semua"
               }));
               $.each(rstCustomer[0], function(i, item) {
                  $('#customer').append($('<option>', {
                     value: item.costomer,
                     text: item.costomer
                  }));
               });
            }

            if(rstLine[0].length > 0){
               $('#line').empty();
               $('#line').append($('<option>', {
                  value: "",
                  text: "Semua"
               }));
               $.each(rstLine[0], function(i, item) {
                  $('#line').append($('<option>', {
                     value: item.nama_line,
                     text: item.nama_line
                  }));
               });
            }
         });

      }

      function loadCustomer(){
         try{
            const dataCust = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               data: {
                  action: 'ajax_getCustomers'
               },
               dataType: 'JSON',
               
            });
            return dataCust;

         }catch(err){
            throw err;
         }
      }

      function loadLine(){
         try{
            const dataLines = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               data: {
                  action: 'ajax_getLines'
               },
               dataType: 'JSON',
               
            });   
            return dataLines;

         }catch(err){
            throw err;
         }
      }

      $('#btnFilter').click(function(){
         let tgl = $('#tgl').val();
         let kategori = $('#category').val();
         let buyer = $('#customer').val();
         let line = $('#line').val();

         let param = {
            'tgl': tgl,
            'kategori': kategori,
            'buyer': buyer,
            'line': line
         };

         $.ajax({
            type: 'GET',
            url: 'functions/ajax_functions_handler.php',
            data: {
               'action': 'ajax_getAllProductionSummary',
               'param': param
            },
            dataType: 'JSON',
         }).done(function(dataReturn){
            tableSumProduksi.clear();
            if(dataReturn.length > 0){
               for(let x = 0; x < dataReturn.length; x++){
                  tableSumProduksi.row.add([
                     x+1,
                     dataReturn[x].line,
                     dataReturn[x].buyer,
                     dataReturn[x].po,
                     dataReturn[x].orc,
                     dataReturn[x].style,
                     dataReturn[x].color,
                     dataReturn[x].size,
                     dataReturn[x].qty_order,
                     dataReturn[x].shipment,
                     parseInt(dataReturn[x].input_trimstore),
                     parseInt(dataReturn[x].balance_trimstore),
                     parseInt(dataReturn[x].input_sewing),
                     parseInt(dataReturn[x].balance_sewing),
                     parseInt(dataReturn[x].output_qcendline),
                     parseInt(dataReturn[x].balance_qcendline),
                     parseInt(dataReturn[x].output_packing),
                     parseInt(dataReturn[x].balance_packing)
                  ]).draw();
               }
            }
            
         })
      })

      $('#btnExportToExcel').click(function(e) {
          // let fileName = '<//?= $data4['no_invoice'] ?>';
          let file = new Blob([$('#tableContainer').html()], {
              type: "application/vnd.ms-excel"
          });
          let url = URL.createObjectURL(file);
          let a = $("<a />", {
              href: url,
              download: "production_summary" + ".xls"
          }).appendTo("body").get(0).click();
          e.preventDefault();
      });
   });
</script>

<script src="assets/DataTables/js/buttons.html5.min.js"></script>


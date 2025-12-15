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

   .center-block{
      display: block;
      margin-left: auto;
      margin-right: auto;
   }
</style>

<center>
   <title>LAPORAN HASIL PRODUKSI PER PERIODE</title>
   <h3>LAPORAN HASIL PRODUKSI PER PERIODE</h3>
</center>

</div>

<div class="container-fluid" style="margin: 20px;">
   <!-- <div class="container style="margin-bottom: 10px;"> -->
      <div class="row well" style="margin-bottom: 10px;">
         <!-- <div class="center-block"> -->
         <div class="row">
            <div class="col-md-2">
               <div class="form-group">
                  <label for="proses" style="margin-bottom: 0px;">Proses</label>
                  <select id="proses" name="proses" class="form-control canChange"></select>
               </div>
            </div>

            <div class="col-md-2">
               <div class="form-group">
                  <label for="dtFrom" style="margin-bottom: 0px;">Dari tanggal</label>
                  <input type="date" id="dtFrom" name="dtFrom" class="form-control canChange" value="<?= date('Y-m-d') ?>" />
               </div>
            </div>

            <div class="col-md-2">
               <div class="form-group">
                  <label for="dtTo" style="margin-bottom: 0px;">Sampai tanggal</label>
                  <input type="date" id="dtTo" name="dtTo" class="form-control canChange" value="<?= date('Y-m-d') ?>" />
               </div>
            </div>

            <div class="col-md-2">
               <div class="form-group">
                  <label for="customer" style="margin-bottom: 0px;">Customer</label>
                  <select id="customer" name="customer" class="form-control canChange select2"></select>
               </div>
            </div>

            <div class="col-md-2">
               <div class="form-group">
                  <label for="line" style="margin-bottom: 0px;">Line</label>
                  <select id="line" name="line" class="form-control canChange select2"></select>
               </div>
            </div>

            <div class="col-md-2">
               <div class="form-group">
                  <label for="orc" style="margin-bottom: 0px;">ORC</label>
                  <input type="text" id="orc" name="orc" class="form-control canChange" />
               </div>
            </div>
         </div>

         <div class="row">
   
            <div class="col-md-2">
               <div class="form-group">
                  <label for="style" style="margin-bottom: 0px;">Style</label>
                  <input type="text" id="style" name="style" class="form-control canChange" />
               </div>
            </div>
   
            <div class="col-md-2">
               <div class="form-group">
                  <label for="po" style="margin-bottom: 0px;">PO</label>
                  <input type="text" id="po" name="po" class="form-control canChange" />
               </div>
            </div>
   
            <div class="col-md-2">
               <button id="btnFilter" name="btnFilter" class="btn btn-info">Filter</button>
            </div>
         </div>

         <!-- </div> -->
      </div>
   <!-- </div> -->

  <div class="row text-center">
    <div id="loading" style="display: none;">
        Loading...
        <img src="assets/images/loader.gif" alt="Loading" width="142" height="71" />
    </div>
  </div> 

   <div class="row well">
      <!-- <div class="col-12"> -->
         <button id='btnExportToExcel' class='btn btn-success btn-sm' style="margin-bottom: 10px;">Export To Excel</button>
         <div id="tableContainer">
            <table border="1px" class="table table-striped table-bordered row-border order-column compact display nowrap" id="tableSumProduksi" width="100%">
               <thead>
                  <tr>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center;" rowspan="2">No.</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">Line</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">Buyer</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">PO</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">ORC</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">Style</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">Color</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">Size</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">Qty Size</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center;" colspan="2">Result</th>
                     <!-- <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center" rowspan="2">Shipment</th> -->
                  </tr>
                  <tr>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center;">Output</th>
                     <th style="background: #254681; color: white; height: 50px; line-height: 50px; text-align: center;">Balance</th>
                  </tr>
               <thead>
            </table>
         </div>
      <!-- </div> -->
   </div>
</div>

<script src="assets/js/select2.min.js"></script>
<!-- <script src="assets/DataTables/js/dataTables.buttons.min.js"></script> -->
<!-- <script src="assets/DataTables/js/buttons.dataTables.js"></script> -->
<!-- <script src="assets/DataTables/js/jszip.min.js"></script> -->


<script>
   $(document).ready(function(){
      const now = new Date();
      const year = now.getFullYear();
      const month = (now.getMonth() + 1).toString().padStart(2, '0');
      const day = now.getDate().toString().padStart(2, '0');
      const strDate = `${year}-${month}-${day}`;

      // $('#tgl').val(strDate);

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
         paging: false,
         destroy: true,
         // deferRender: true,
         scrollY: 490,
         scrollCollapse: true,
         scroller: true,
         // searching: false,
         // columnDefs: [
         //    {
         //       targets: [0,1,2,3,4,5,6,7,8,9,10,11],
         //       className: 'dt-center'
         //    },
         // ]
      });

      loadInitializeData();
      function loadInitializeData(){
         $.when(loadProses(), loadCustomer(), loadLine()).done(function(rstProses, rstCustomer, rstLine,){
            if(rstProses[0].length > 0){
               $('#proses').empty();
               $.each(rstProses[0], function(i, item){
                  let valTransaksi = item.nama_transaksi;
                  let txtTransaksi = '';

                  switch(valTransaksi){
                     case 'washing':
                        txtTransaksi = 'F QC';
                        break;
                     case 'qc_buyer':
                        txtTransaksi = 'FURUSHIMA';
                        break;
                     case 'ht':
                        txtTransaksi = 'HT';
                     case 'bemis':
                        txtTransaksi = 'BEMIS';
                     case 'prepartion':
                        txtTransaksi = 'JUWITA';
                        break;
                     default:
                        txtTransaksi = valTransaksi.toUpperCase();
                        break;

                  }
                  $('#proses').append($('<option>', {
                     value: valTransaksi,
                     text: txtTransaksi
                  }));
               });
            }

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

      function loadProses(){
         try{
            const dataProses = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               data: {
                  action: 'ajax_getProses'
               },
               dataType: 'JSON'
            });
            return dataProses;
         }catch(err){
            throw err;
         }
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
         $('#btnFilter').prop('disabled', true);
         $('#loading').show();
         let proses = $('#proses').val();
         let dtFrom = $('#dtFrom').val();
         let dtTo = $('#dtTo').val();
         let buyer = $('#customer').val();
         let line = $('#line').val();
         let orc = $('#orc').val();
         let style = $('#style').val();
         let po = $('#po').val();

         let param = {
            'proses': proses,
            'dtFrom': dtFrom,
            'dtTo': dtTo,
            'buyer': buyer,
            'line': line,
            'orc': orc,
            'style': style,
            'po': po
         };
         let strParam = JSON.stringify(param);

         $.ajax({
            type: 'GET',
            url: 'functions/ajax_functions_handler.php',
            data: {
               'action': 'ajax_getAllProductionSummary',
               'param': strParam
            },
            dataType: 'JSON',
         }).done(function(dataReturn){
            tableSumProduksi.clear().draw();
            if(dataReturn.length > 0){
               for(let x = 0; x < dataReturn.length; x++){
                  tableSumProduksi.row.add([
                     x+1,
                     dataReturn[x].line.toString(),
                     dataReturn[x].buyer.toString(),
                     dataReturn[x].po.toString(),
                     dataReturn[x].orc.toString(),
                     dataReturn[x].style.toString(),
                     dataReturn[x].color.toString(),
                     dataReturn[x].size.toString(),
                     dataReturn[x].qty_order.toString(),
                     // dataReturn[x].shipment,
                     parseInt(dataReturn[x].output),
                     parseInt(dataReturn[x].balance),
                  ]).draw();
               }
            }
            $('#loading').hide();
            $('#btnFilter').prop('disabled', false);
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


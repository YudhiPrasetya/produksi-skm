<?php
   require_once 'core/init.php';
   require_once 'view/header.php';
?>

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

   #tableData{
      th{
         vertical-align: middle;
         text-align: center;
      }
   }
</style>

<center>
   <title>LAPORAN SEWING PRODUCTION</title>
   <h3>Laporan Summary Produksi (Production Summary Report)</h3>
</center>

</div>

<div class="container-fluid" style="margin: 20px;">
   <div class="row" style="margin-bottom: 10px;">
      <div class="col-sm-3">
         <div class="form-group">
            <label for="tgl">s/d Tanggal</label>
            <input type="date" id="tgl" name="tgl" class="form-control canChange" />
         </div>
      </div>

      <div class="col-sm-3">
         <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control canChange">
               <option value="all">Semua</option>
               <option value="UNDERWEAR">Underwear</option>
               <option value="OUTERWEAR">Outerwear</option>
            </select>
         </div>
      </div>

      <div class="col-sm-3">
         <div class="form-group">
            <label for="customer">Customer</label>
            <select id="customer" name="customer" class="form-control canChange select2"></select>
         </div>
      </div>

      <div class="col-sm-3">
         <div class="form-group">
            <label for="line">Line</label>
            <select id="line" name="line" class="form-control canChange select2"></select>
         </div>
      </div>

      
   </div>

   <div class="row">
      <div class="col-12">
         <table class="table table-bordered table-striped table-hover" id="tableData">
            <thead>
               <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">Line</th>
                  <th rowspan="2">Buyer</th>
                  <th rowspan="2">PO</th>
                  <th rowspan="2">ORC</th>
                  <th rowspan="2">Style</th>
                  <th rowspan="2">Color</th>
                  <th rowspan="2">Size</th>
                  <th rowspan="2">Qty Order</th>
                  <th rowspan="2">Shipment</th>
                  <th colspan="2">Trimstores</th>
                  <th colspan="2">Input Sewing</th>
                  <th colspan="2">QC Endline</th>
                  <th colspan="2">Packing</th>
               </tr>
               <tr>
                  <th>Input</th>
                  <th>Balance</th>
                  <th>Input</th>
                  <th>Balance</th>
                  <th>Output</th>
                  <th>Balance</th>
                  <th>Output</th>
                  <th>Balance</th>
               </tr>
            <thead>
         </table>
      </div>
   </div>
</div>

<script src="assets/js/select2.min.js"></script>
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

      var tableData = $('#tableData').DataTable({
         destroy: true
      });

      loadInitializeData();
      function loadInitializeData(){
         $.when(loadCustomer(), loadLine()).done(function(rstCustomer, rstLine){
            console.table(rstCustomer);
            console.table(rstLine);
         });

      }

      function loadCustomer(){
         try{
            const returnData = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               data: {
                  action: 'ajax_getCustomers'
               },
               dataType: 'JSON',
               
            });
            console.log('returnData:', returnData);
            return returnData;

         }catch(err){
            throw err;
         }
      }

      function loadLine(){
         try{
            const returnData = $.ajax({
               type: 'GET',
               url: 'functions/ajax_functions_handler.php',
               data: {
                  action: 'ajax_getLines'
               },
               dataType: 'JSON',
               
            });   
            return returnData;

         }catch(err){
            throw err;
         }
      }

   });
</script>


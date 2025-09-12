<?php
   require_once 'core/init.php';
   require_once 'view/header.php';
   if( !isset($_SESSION['username']) ){
      echo "<script>alert('Silakan Login terlebih dahulu untuk mengakses halaman ini');window.location='index.php'</script>";
  // header('Location: index.php');    
   }
?>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->


   <style>
      tbody{
         cursor: pointer;
      }
      hr {
         display: block;
         margin-top: 0.5em;
         margin-bottom: 0.5em;
         border-style: inset;
         border-width: 1px;
         border-color:blue;
      }
   </style>

   </div>

   <div class="container-fluid">
      <center>
         <h2>.:<strong>LAPORAN W I P</strong>:.</h2>
         <br>
      </center>
      <br>
      <div class="row">
         <div class="col-md-2">
            <div class="form-group">
               <label>Pilih WIP Grup</label>
               <select name="selectWIPGroup" id="selectWIPGroup" class="form-control">
                  <option value="" selected>--Silahkan pilih WIP Grup--</option>
                  <option value="groupCutting">Cutting Grup</option>
                  <option value="groupSewing">Sewing Grup</option>
               </select>
            </div>
         </div>
         <div class="col-md-1">
            <button class="btn btn-success" id="btnTampilkan" disabled>
               <span class="glyphicon glyphicon-print">
               </span>
               &nbsp;Tampilkan
            </button>
         </div>
         <!-- <div class="col-md-1">
            <button class="btn btn-warning" id="btnExportToExcel" disabled>
               <span class="glyphicon glyphicon-excel">
               </span>
               &nbsp;Export To Excel
            </button>
         </div> -->
         <div class="col-md-2">
            <h3 id="keterangan" style="margin-left: 20px;">- (belum/tidak scan)</h3>
         </div>
      </div>

      <div class="row text-center">
         <div id="loading" style="display: none;">
            <h3><strong>Loading...</strong></h3>
            <img src="assets/images/loader.gif" alt="Loading" width="142" height="71" />
         </div>
      </div>

      <div class="row">
         <div class="col-md-12">
            <div class="table-container">
               <div id="tableSewingGroupContainer" style="display: none;">
                  <table id="tableSewingGroup"class="table table-hover table-bordered table-striped compact" width="100%" cellpadding="6">
                     <thead>
                        <tr>
                           <th rowspan="2" style="background-color: #f4f4f4"><center>Style</center></th>
                           <th rowspan="2" style="background-color: #f4f4f4"><center>ORC</center></th>
                           <th rowspan="2" style="background-color: #f4f4f4"><center>Size</center></th>
                           <th rowspan="2" style="background-color: #f4f4f4"><center>Qty</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>IN Sewing</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>Qc Line</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>Packing</center></th>
                        </tr>
                        <tr>
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
                        </tr>
                     </thead>
                  </table>

               </div>

               <div id="tableCuttingGroupContainer" style="display: none;">
                  <table id="tableCuttingGroup"class="table table-hover table-bordered table-striped compact" width="100%" cellpadding="6">
                     <thead>
                        <tr>
                           <th rowspan="2" style="background-color: #f4f4f4"><center>Style</center></th>
                           <th rowspan="2" style="background-color: #f4f4f4"><center>ORC</center></th>
                           <th rowspan="2" style="background-color: #f4f4f4"><center>Size</center></th>
                           <th rowspan="2" style="background-color: #f4f4f4"><center>Qty</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>Cutting</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>Bemis</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>Juwita</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>Press</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>HT</center></th>
                           <th colspan="2" style="background-color: #f4f4f4"><center>Trimstore</center></th>
                        </tr>
                        <tr>
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
   
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
   
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
   
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
   
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
   
                           <th style="background-color: #f4f4f4"><center>Total</center></th>
                           <th style="background-color: #f4f4f4"><center>WIP</center></th>
   
                        </tr>
                     </thead>
                  </table>

               </div>

            </div>
         </div>
      </div>

   </div>


   <script>
      $(document).ready(function(){
         $('#keterangan').hide();

         var selectedWIPGroupVal="";

         var tableSewingGroup = $('#tableSewingGroup').DataTable({
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf'],            
            destroy: true,
            lengthMenu: [[10,25,50,200,250,-1],[10,25,50,200,250,"All"]],
            pageLength: 25
         });

         var tableCuttingGroup = $('#tableCuttingGroup').DataTable({
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf'],            
            destroy: true,
            lengthMenu: [[10,25,50,200,250,-1],[10,25,50,200,250,"All"]],
            pageLength: 25
         });
   
         $('#selectWIPGroup').change(function(){
            selectedWIPGroupVal = $(this).val();
   
            $('#btnTampilkan').prop('disabled', selectedWIPGroupVal == "");
         });
   
         $('#btnTampilkan').click(function(){
            $('#loading').show();

            switch(selectedWIPGroupVal){
               case "groupSewing":
                  loadWIPSewingGroup();
                  break;
               case "groupCutting":
                  lodWIPCuttingGroup();
            }
         });
   
         function loadWIPSewingGroup(){
            $.when(fetchTrimstoreQtySize(), fetchSewingQtySize(), fetchQCQtySize(), fetchPackingQtySize()).done(function(rstTrimstore, rstSewing, rstQc, rstPacking){
               showWIPSewingGroup(rstTrimstore[0], rstSewing[0], rstQc[0], rstPacking[0]);
               $('#loading').hide();
            });
         }
   
         function fetchTrimstoreQtySize(){
            try{
               var respTrimstore = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getTrimstoreQtySize'
                  }
               });
               return respTrimstore;
            }catch(err){
               throw err;
            }
         }
   
         function fetchSewingQtySize(){
            try{
               var respSewing = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getSewingQtySize'
                  }
               });
               return respSewing;
            }catch(err){
               throw err;
            }
         }
   
         function fetchQCQtySize(){
            try{
               var respQc = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getQcEndlineQtySize'
                  }
               });
               return respQc;
            }catch(err){
               throw err;
            }         
         }
   
         function fetchPackingQtySize(){
            try{
               var respPacking = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getPackingQtySize'
                  }
               });
               return respPacking;
            }catch(err){
               throw err;
            }         
         }
   
         function showWIPSewingGroup(rTrimstore, rSewing, rQC, rPacking){
            $('#tableCuttingGroupContainer').slideUp(1000);
            // var dt = '';
            tableSewingGroup.clear().draw();
         
            const arrWIPSewingCombined = rTrimstore.map(function(trimstore, i) {
               const sewingPreference = rSewing.find((sewingPref) => sewingPref.orc == trimstore.orc && sewingPref.size == trimstore.size);
               // console.log('sewingPreference: ', sewingPreference);

               const qcPreference = rQC.find((qcPref) => qcPref.orc == trimstore.orc && qcPref.size == trimstore.size);

               const packingPreference = rPacking.find((packingPref) => packingPref.orc == trimstore.orc && packingPref.size == trimstore.size);

               return {
                  style: trimstore.style,
                  orc: trimstore.orc,
                  size: trimstore.size,
                  qty: trimstore.sum_qty_trimstore,
                  sum_qty_sewing: sewingPreference == undefined ? "-" : sewingPreference.sum_qty_sewing,

                  wip_sewing: sewingPreference == undefined ? "-" : parseInt(trimstore.sum_qty_trimstore) - parseInt(sewingPreference.sum_qty_sewing),

                  sum_qty_qc_endline: qcPreference == undefined ? "-" : qcPreference.sum_qty_qc_endline,

                  wip_qc_endline: qcPreference == undefined ? "-" : parseInt(sewingPreference.sum_qty_sewing) - parseInt(qcPreference.sum_qty_qc_endline),

                  sum_qty_packing: packingPreference == undefined ? "-" : packingPreference.sum_qty_tatami,
                  wip_packing: packingPreference == undefined ? "-" : parseInt(qcPreference.sum_qty_qc_endline) - parseInt(packingPreference.sum_qty_tatami)
               }
            });
            
            $.each(arrWIPSewingCombined, function(i, item){
               tableSewingGroup.row.add([
                  item.style,
                  item.orc,
                  item.size,
                  item.qty,
                  item.sum_qty_sewing,
                  item.wip_sewing,
                  item.sum_qty_qc_endline,
                  item.wip_qc_endline,
                  item.sum_qty_packing,
                  item.wip_packing
               ]).draw();   
            });

            $('#keterangan').show();
            $('#tableSewingGroupContainer').slideDown(3000);
         }

         function lodWIPCuttingGroup(){
            $.when(fetchOrderQtySize(), fetchCuttingQtySize(), fetchBemisQtySize(), fetchJuwitaQtySize(), fetchPressQtySize(), fetchHTQtySize(), fetchTrimstoreQtySize()).done(function(rstOrder, rstCutting, rstBemis, rstJuwita, rstPress, rstHT, rstTrimstore){
               showWIPCuttingGroup(rstOrder[0], rstCutting[0], rstBemis[0], rstJuwita[0], rstPress[0], rstHT[0], rstTrimstore[0]);
               $('#loading').hide();
            });
         }

         function fetchOrderQtySize(){
            try{
               var rspOrder = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getOrderQtySize'
                  }
               });
               return rspOrder;
            }catch(err){
               throw err;
            }
         }

         function fetchCuttingQtySize(){
            try{
               var rspCutting = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getCuttingQtySize'
                  }
               });
               return rspCutting;
            }catch(err){
               throw err;
            }            
         }

         function fetchBemisQtySize(){
            try{
               var rspBemis = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getBemisQtySize'
                  }
               });
               return rspBemis;
            }catch(err){
               throw err;
            }            
         }

         function fetchJuwitaQtySize(){
            try{
               var rspJuwita = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getJuwitaQtySize'
                  }
               });
               return rspJuwita;
            }catch(err){
               throw err;
            }            
         }

         function fetchPressQtySize(){
            try{
               var rspPress = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getPressQtySize'
                  }
               });
               return rspPress;
            }catch(err){
               throw err;
            }            
         }

         function fetchHTQtySize(){
            try{
               var rspHT = $.ajax({
                  type: 'GET',
                  url: 'functions/ajax_functions_handler.php',
                  dataType: 'JSON',
                  data: {
                     'action': 'ajax_getHTQtySize'
                  }
               });
               return rspHT;
            }catch(err){
               throw err;
            }            
         }

         function showWIPCuttingGroup(rOrder, rCutting, rBemis, rJuwita, rPress, rHT, rTrimstore){
            $('#tableSewingGroupContainer').slideUp(1000);
            tableCuttingGroup.clear().draw();

            const arrWIPCuttingCombined = rOrder.map(function(order, i){
               const cuttingPreference = rCutting.find((cuttingPref) => cuttingPref.orc == order.orc && cuttingPref.size == order.size);

               const bemisPreference = rBemis.find((bemisPref) => bemisPref.orc == order.orc && bemisPref.size == order.size);

               const juwitaPreference = rJuwita.find((juwitaPref) => juwitaPref.orc == order.orc && juwitaPref.size == order.size);

               const pressPreference = rPress.find((pressPref) => pressPref.orc == order.orc && pressPref.size == order.size);

               const htPreference = rHT.find((htPref) => htPref.orc == order.orc && htPref.size == order.size);

               const trimstorePreference = rTrimstore.find((trismtorePref) => trismtorePref.orc == order.orc && trismtorePref.size == order.size);

               return {
                  style: order.style,
                  orc: order.orc,
                  size: order.size,
                  qty: order.qty_order,

                  sum_qty_cutting: cuttingPreference == undefined ? "-" : cuttingPreference.sum_qty_cutting,
                  wip_cutting: cuttingPreference == undefined ? "-" : parseInt(order.qty_order) - parseInt(cuttingPreference.sum_qty_cutting),

                  sum_qty_bemis: bemisPreference == undefined ? "-" : bemisPreference.sum_qty_bemis,
                  wip_bemis: bemisPreference == undefined ? "-" : parseInt(order.qty_order) - parseInt(bemisPreference.sum_qty_bemis),

                  sum_qty_juwita: juwitaPreference == undefined ? "-" : juwitaPreference.sum_qty_juwita,
                  wip_juwita: juwitaPreference == undefined ? "-" : parseInt(order.qty_order) - parseInt(juwitaPreference.sum_qty_juwita),

                  sum_qty_press: pressPreference == undefined ? "-" : pressPreference.sum_qty_press,
                  wip_press: pressPreference == undefined ? "-" : parseInt(order.qty_order) - parseInt(pressPreference.sum_qty_press),

                  sum_qty_ht: htPreference == undefined ? "-" : htPreference.sum_qty_ht,
                  wip_ht: htPreference == undefined ? "-" : parseInt(order.qty_order) - parseInt(htPreference.sum_qty_ht),

                  sum_qty_trimstore: trimstorePreference == undefined ? "-" : trimstorePreference.sum_qty_trimstore,
                  wip_trimstore: trimstorePreference == undefined ? "-" : parseInt(order.qty_order) - parseInt(trimstorePreference.sum_qty_trimstore),


               }

               
            });
            
            $.each(arrWIPCuttingCombined, function(i, item){
               tableCuttingGroup.row.add([
                  item.style,
                  item.orc,
                  item.size,
                  item.qty,
                  item.sum_qty_cutting,
                  item.wip_cutting,
                  item.sum_qty_bemis,
                  item.wip_bemis,
                  item.sum_qty_juwita,
                  item.wip_juwita,
                  item.sum_qty_press,
                  item.wip_press,
                  item.sum_qty_ht,
                  item.wip_ht,
                  item.sum_qty_trimstore,
                  item.wip_trimstore
               ]).draw();
            });
            $('#keterangan').show();
            $('#tableCuttingGroupContainer').slideDown(3000);            
         }
      });
   </script>

   </body>
</html>
